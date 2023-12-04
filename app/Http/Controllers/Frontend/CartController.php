<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Kế thừa class Cart
use \App\Http\ShoppingCart\Cart;

class CartController extends Controller
{

    // Thêm sản phẩm  vào giỏ hàng
    public function buy(Request $request, $id){
        // Gọi hàm là cartAdd từ class Cart
        Cart::cartAdd($id);
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
    // Thanh toán đơn hàng
    public function order(){
        // Kiểm tra xem user đăng nhập chưa, nếu chưa thì đề nghị đăng nhập
        $customer_id = session()->get("customer_id");
        if(isset($customer_id)){
            // Gọi hàm cartOrder để thanh toán đơn hàng và xóa toàn bộ giỏ hàng
            Cart::cartOrder();
            return redirect(route("success"))->with('cartUrl', url("cart"));
        }
        else
            return redirect(url("customers/login"));
    }
    public function success()
    {
        // Xử lý trang thanh toán thành công ở đây và trả về view tương ứng
        return view('frontend.success');
    }
}
