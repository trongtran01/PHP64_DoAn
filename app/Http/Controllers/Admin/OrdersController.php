<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrdersController extends Controller
{
    // Danh sách đơn hàng
    public function index()
    {
        $orders = DB::table('orders')->orderBy('id', 'desc')->paginate(50);
        return view('admin.orders.index', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function show($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        if (!$order) {
            abort(404);
        }

        $customer = DB::table('customers')->where('id', $order->customer_id)->first();

        $products = DB::table('orderdetails')
            ->join('products', 'products.id', '=', 'orderdetails.product_id')
            ->select('products.name', 'products.photo', 'products.discount', 'orderdetails.quantity', 'orderdetails.price')
            ->where('orderdetails.order_id', $id)
            ->get();

        return view('admin.orders.show', compact('order', 'customer', 'products'));
    }

    // Cập nhật trạng thái đơn hàng: chưa giao → đã giao
    public function markAsDelivered($id)
    {
        DB::table('orders')->where('id', $id)->update(['status' => 1]);
        return redirect()->route('admin.orders.show', $id);
    }
}
