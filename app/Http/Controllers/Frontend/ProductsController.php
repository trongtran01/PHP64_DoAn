<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Search\ProductSearchService;
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
    public function search(Request $request){
            //lấy biến key truyền từ url
            $key = request('key');//hoặc $key = $request->get('key');
            $data = DB::table("products")->where("name","like",'%'.$key.'%')->orWhere("description","like",'%'.$key.'%')->orWhere("content","like",'%'.$key.'%')->paginate(40);
            //print_r($data);
            return view("frontend.product_search",["key"=>$key,"data"=>$data]);
        }

        // Dropdown tìm kiếm ở header: trả về HTML đã render từ blade, kết quả gom nhóm theo danh mục.
        // Logic tìm nằm trong ProductSearchService, sau này đổi engine chỉ cần sửa ở đó.
        public function ajax(Request $request, ProductSearchService $searchService){
            $result = $searchService->search($request->get('key'));
            return view('frontend.partials.header.search-results', $result);
        }
        //đánh giá sao sản phẩm
        public function rating($id){
            $star = request('star');
            //cập nhật bản ghi vào table rating
            DB::table("rating")->insert(["product_id"=>$id,'star'=>$star]);
            //quay trở lại trang chi tiết sản phẩm
            return redirect(url('products/detail/'.$id));
        }
}