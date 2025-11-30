<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// Kế thừa class Cart
use \App\Http\ShoppingCart\Cart;

class CartController extends Controller
{

    // Thêm sản phẩm  vào giỏ hàng
    public function buy(Request $request, $id){
        // Gọi hàm là cartAdd từ class Cart
        $quantity = $request->input('quantity', 1);
        Cart::cartAdd($id, $quantity);
        return redirect(url("cart"));
    }
    // Hiển thị danh sách giỏ hàng
    public function index(){
        // Lấy giỏ hàng
        $cart = Cart::cartList();
        return view("frontend.cart",["cart"=>$cart]);
    }
    // Xóa sản phẩm khỏi giỏ hàng
    public function delete($id){
        Cart::cartDelete($id);
        return redirect(url("cart"));
    }
    // Xóa toàn bộ sản phẩm khỏi giỏ hàng
    public function destroy(){
        Cart::cartDestroy();
        return redirect(url("cart"));
    }
    // Cập nhật số lượng sản phẩm
    public function update(){
        // Lấy giỏ hàng
        $cart = Cart::cartList();
        // Duyệt các phần tử trong mảng sesion cart
        foreach($cart as $product){
            $name = "product_".$product['id'];
            $new_quantity = $_POST[$name];
            // Gọi hàm cartUpdate để update lại số lượng sản phẩm
            Cart::cartUpdate($product['id'], $new_quantity);
        }
        return redirect(url("cart"));
    }
    // Form checkout cho khách vãng lai
    public function guestCheckout()
    {
        return view("frontend.guest_checkout");
    }

    // Xử lý đặt hàng của khách vãng lai
    public function guestOrder(Request $request)
    {
        $cart = \App\Http\ShoppingCart\Cart::cartList();

        if (empty($cart)) {
            return redirect(url("cart"))->with("error", "Giỏ hàng trống!");
        }

        // Validate input khách vãng lai
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:1000',
        ]);

        // Lưu thông tin khách vãng lai vào bảng guest_customers
        $guestId = DB::table('guest_customers')->insertGetId([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tạo đơn hàng và liên kết với guest_customer_id
        $orderId = DB::table('orders')->insertGetId([
            'customer_id' => null,                  // Khách vãng lai
            'guest_customer_id' => $guestId,
            'date' => now(),
            'price' => \App\Http\ShoppingCart\Cart::cartTotal(),
            'status' => 0,                           // trạng thái mặc định
        ]);

        // Lưu chi tiết sản phẩm vào orderdetails
        foreach ($cart as $product) {
            $price = $product['price'] - ($product['price'] * $product['discount']) / 100;
            DB::table('orderdetails')->insert([
                'order_id' => $orderId,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $price,
            ]);
        }

        // Xóa giỏ hàng
        \App\Http\ShoppingCart\Cart::cartDestroy();

        return redirect(route("success"))->with('cartUrl', url("cart"));
    }

    // Thanh toán đơn hàng
    public function order()
    {
        $customer_id = session()->get("customer_id");

        if (!isset($customer_id)) {
            // Chuyển sang checkout guest
            return redirect()->route("guest.checkout");
        }

        // Nếu là khách đã đăng nhập → xử lý như cũ
        Cart::cartOrder();
        return redirect(route("success"))->with('cartUrl', url("cart"));
    }

    public function success()
    {
        // Xử lý trang thanh toán thành công ở đây và trả về view tương ứng
        return view('frontend.success');
    }
}
