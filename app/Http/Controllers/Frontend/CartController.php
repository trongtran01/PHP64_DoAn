<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// Kế thừa class Cart
use \App\Http\ShoppingCart\Cart;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CartController extends Controller
{

    // Thêm sản phẩm  vào giỏ hàng
    public function buy(Request $request, $id)
    {
        // Gọi hàm là cartAdd từ class Cart
        $quantity = $request->input('quantity', 1);
        Cart::cartAdd($id, $quantity);
        return redirect(url("cart"));
    }
    // Hiển thị danh sách giỏ hàng
    public function index()
    {
        // Lấy giỏ hàng
        $cart = Cart::cartList();
        return view("frontend.cart", ["cart" => $cart]);
    }
    // Xóa sản phẩm khỏi giỏ hàng
    public function delete($id)
    {
        Cart::cartDelete($id);
        return redirect(url("cart"));
    }
    // Xóa toàn bộ sản phẩm khỏi giỏ hàng
    public function destroy()
    {
        Cart::cartDestroy();
        return redirect(url("cart"));
    }
    // Cập nhật số lượng sản phẩm
    public function update()
    {
        // Lấy giỏ hàng
        $cart = Cart::cartList();
        // Duyệt các phần tử trong mảng sesion cart
        foreach ($cart as $product) {
            $name = "product_" . $product['id'];
            $new_quantity = $_POST[$name];
            // Gọi hàm cartUpdate để update lại số lượng sản phẩm
            Cart::cartUpdate($product['id'], $new_quantity);
        }
        return redirect(url("cart"));
    }
    // Form checkout cho khách vãng lai
    public function guestCheckout()
    {
        $customer_id = session()->get("customer_id");

        // Nếu đã đăng nhập thì redirect về order bình thường
        if (isset($customer_id)) {
            return redirect()->route("cart.order");
        }

        // Kiểm tra có shipping method trong session không
        $shipping_method = session('cart_shipping_method', null);
        $shipping_price = session('cart_shipping_price', 0);

        // Nếu chưa có shipping method, redirect về cart
        if (!$shipping_method) {
            return redirect(url("cart"))->with("error", "Vui lòng chọn phương thức vận chuyển trước!");
        }

        return view("frontend.guest_checkout", compact('shipping_method', 'shipping_price'));
    }

    public function guestOrder(Request $request)
    {
        $cart = \App\Http\ShoppingCart\Cart::cartList();

        if (empty($cart)) {
            return redirect(url("cart"))->with("error", "Giỏ hàng trống!");
        }

        // Validate thông tin khách vãng lai
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:1000',
        ]);

        // LẤY SHIPPING TỪ SESSION (đã được lưu từ trang cart)
        $shipping_method = session('cart_shipping_method');
        $shipping_price = session('cart_shipping_price', 0);

        // Nếu không có shipping trong session, redirect về cart
        if (!$shipping_method) {
            return redirect(url("cart"))->with('error', 'Vui lòng chọn phương thức vận chuyển!');
        }

        // Lưu thông tin khách vãng lai
        $guestId = DB::table('guest_customers')->insertGetId([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tạo đơn hàng
        $payment_method = $request->input('payment_method', 'cod');

        $orderId = $this->createOrder(
            null,
            $guestId,
            $cart,
            $shipping_method,
            $shipping_price,
            $payment_method
        );

        // Xóa giỏ hàng và session shipping
        if ($payment_method === 'stripe') {
            return $this->createStripeSession($cart, $shipping_price, $orderId);
        }

        /* COD */
        Cart::cartDestroy();
        session()->forget(['cart_shipping_method', 'cart_shipping_price']);

        return redirect(route("success"))->with('cartUrl', url("cart"));
    }

    public function updateShipping(Request $request)
    {
        $shipping_method = $request->input('shipping_method');
        $shipping_price = $request->input('shipping_price', 0);

        // Lưu vào session để backend tính tổng khi order
        session([
            'cart_shipping_method' => $shipping_method,
            'cart_shipping_price' => $shipping_price,
        ]);

        return response()->json(['success' => true]);
    }

    // Thanh toán đơn hàng
    public function order(Request $request)
    {
        $customer_id = session()->get("customer_id");

        if (!isset($customer_id)) {
            return redirect()->route("guest.checkout");
        }

        $cart = Cart::cartList();

        if (empty($cart)) {
            return redirect(url("cart"))->with("error", "Giỏ hàng trống!");
        }

        $payment_method = $request->input('payment_method', 'cod');
        $shipping_method = session('cart_shipping_method');
        $shipping_price = session('cart_shipping_price', 0);

        if (!$shipping_method) {
            return redirect(url("cart"))->with("error", "Vui lòng chọn phương thức vận chuyển!");
        }

        $orderId = $this->createOrder(
            $customer_id,
            null,
            $cart,
            $shipping_method,
            $shipping_price,
            $payment_method
        );

        if ($payment_method === 'stripe') {
            return $this->createStripeSession($cart, $shipping_price, $orderId);
        }

        Cart::cartDestroy();
        session()->forget(['cart_shipping_method', 'cart_shipping_price']);

        return redirect(route("success"));
    }
    public function success()
    {
        // Xử lý trang thanh toán thành công ở đây và trả về view tương ứng
        return view('frontend.success');
    }

    public function stripeSuccess(Request $request)
    {
        $orderId = $request->order_id;

        DB::table('orders')->where('id', $orderId)->update([
            'payment_status' => 'paid',
            'status' => 1
        ]);

        Cart::cartDestroy();
        session()->forget(['cart_shipping_method', 'cart_shipping_price']);

        return redirect(route("success"));
    }

    private function createOrder($customerId, $guestId, $cart, $shipping_method, $shipping_price, $payment_method)
    {
        return DB::transaction(function () use ($customerId, $guestId, $cart, $shipping_method, $shipping_price, $payment_method) {

            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => $customerId,
                'guest_customer_id' => $guestId,
                'date' => now(),
                'price' => Cart::cartTotal() + $shipping_price,
                'shipping_method' => $shipping_method,
                'shipping_price' => $shipping_price,
                'status' => 0,
                'payment_method' => $payment_method,
                'payment_status' => $payment_method === 'cod' ? 'cod' : 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($cart as $product) {
                $price = $product['price'] - ($product['price'] * $product['discount']) / 100;

                DB::table('orderdetails')->insert([
                    'order_id' => $orderId,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return $orderId;
        });
    }


    /*
    |--------------------------------------------------------------------------
    | PRIVATE: TẠO STRIPE SESSION
    |--------------------------------------------------------------------------
    */
    private function createStripeSession($cart, $shipping_price, $orderId)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // 1. Lấy tỷ giá realtime USD -> VND
        // $response = Http::get('https://open.er-api.com/v6/latest/USD');

        // if (!$response->ok()) {
        //     throw new \Exception('Cannot get exchange rate');
        // }

        // $rate = $response['rates']['VND'];

        $lineItems = [];

        foreach ($cart as $product) {
            $price = $product['price'] - ($product['price'] * $product['discount']) / 100;

            $vndPrice = round($price);

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'vnd',
                    'product_data' => [
                        'name' => $product['name'],
                    ],
                    'unit_amount' => $vndPrice,
                ],
                'quantity' => $product['quantity'],
            ];
        }

        if ($shipping_price > 0) {
            $vndShipping = round($shipping_price);

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'vnd',
                    'product_data' => [
                        'name' => 'Shipping',
                    ],
                    'unit_amount' => $vndShipping,
                ],
                'quantity' => 1,
            ];
        }

        $checkoutSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('stripe/success?order_id=' . $orderId),
            'cancel_url' => url('cart'),
        ]);

        DB::table('orders')->where('id', $orderId)->update([
            'stripe_session_id' => $checkoutSession->id
        ]);

        return redirect($checkoutSession->url);
    }
}
