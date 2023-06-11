<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductsController extends Controller
{
    public function category($category_id){
        // Có thể dùng query builder, Eloquent, MVC để truy vấn dữ liệu
        $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("id", "desc")->paginate(12);

        // lấy giá trị truyền từ url
        $order = request('order');
        switch ($order) {
            case 'nameAsc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("name", "asc")->paginate(12);
                break;
            case 'nameDesc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("name", "desc")->paginate(12);
                break;
            case 'priceAsc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("price", "asc")->paginate(12);
                break;
            case 'priceDesc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("price", "desc")->paginate(12);
                break;
        }
        return view("frontend.product_category",["category_id"=> $category_id, "data"=>$data, "order"=>$order]);
    }
    public function detail($id){
        $record = DB::table("products")->where("id","=",$id)->first();
        return view("frontend.product_detail",["record"=> $record]);
    }
}
