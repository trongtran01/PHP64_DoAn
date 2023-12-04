<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class OrdersController extends Controller
{
    //danh sách đơn hàng
    public function read(){
        $data = DB::table("orders")->orderBy("id","desc")->paginate(50);
        return view("admin.orders.read",["data"=>$data]);
    }
    //chi tiết đơn hàng
    public function detail($id){
        //lấy đơn hàng
        $order = DB::table("orders")->where("id","=",$id)->first();
        //lấy thông tin khách hàng
        $customer = DB::table("customers")->where("id","=",$order->customer_id)->first();
        //lấy danh sách các sản phẩm thuộc đơn hàng
        $products = DB::table("orderdetails")->where("order_id","=",$id)->get();
        return view("admin.orders.detail",["order_id"=>$id]);
    }
    //cập nhật tình trạng đơn hàng từ chưa giao hàng thành đã giao hàng
    public function update($id){
        DB::table("orders")->where("id","=",$id)->update(["status"=>1]);
        return redirect(url('backend/orders/detail/'.$id));
    }
}
