<?php

namespace App\Http\ShoppingCart;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

trait Cart {

    public static function cartAdd($id, $quantity = 1){
        $cart = Session::get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $quantity; // Cộng thêm quantity
        } else {
            $product = DB::table("products")->find($id);
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'photo' => $product->photo,
                'quantity' => $quantity, // Dùng quantity truyền vào
                'price' => $product->price,
                'discount' => $product->discount
            ];
        }
        Session::put('cart', $cart);
    }

    public static function cartUpdate($id, $quantity){
        $cart = Session::get('cart');
        if($quantity == 0){
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity'] = $quantity;
        }
        Session::put('cart', $cart);
    }

    public static function cartDelete($id){
        $cart = Session::get('cart');
        unset($cart[$id]);
        Session::put('cart', $cart);
    }

    public static function cartTotal(){
        $cart = Session::get('cart');
        $total = 0;
        if($cart != ""){
            foreach($cart as $product){
                $total += ($product['price']-$product['price']*$product['discount']/100) * $product['quantity'];
            }
        }
        return $total;
    }

    public static function cartNumber(){
        $cart = Session::get('cart');
        $number = 0;
        if(isset($cart)){
            foreach($cart as $product){
                $number += $product['quantity'];
            }
        }
        return $number;
    }

    public static function cartList(){
        $cart = Session::get('cart');
        return $cart;
    }

    public static function cartDestroy(){
        Session::forget('cart');
    }

    public static function cartOrder($shipping_method = null, $shipping_price = 0){
        $customer_id = Session::get('customer_id');
        $cart = Session::get('cart');

        // Nếu không truyền, lấy từ session
        if(!$shipping_method) {
            $shipping_method = Session::get('cart_shipping_method');
            $shipping_price = Session::get('cart_shipping_price', 0);
        }

        $orderId = DB::table('orders')->insertGetId([
            'customer_id' => $customer_id,
            'price' => self::cartTotal() + $shipping_price,  // tổng cộng
            'shipping_method' => $shipping_method,
            'shipping_price' => $shipping_price,
            'status' => 0,
            'date' => now(),
        ]);

        foreach ($cart as $product) {
            $price = $product['price'] - ($product['price'] * $product['discount'])/100;
            DB::table('orderdetails')->insert([
                'order_id' => $orderId,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $price,
            ]);
        }

        Session::forget('cart');
        Session::forget('cart_shipping_method');
        Session::forget('cart_shipping_price');
    }

}       
