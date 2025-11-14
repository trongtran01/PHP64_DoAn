<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use DB;

class HomeController extends Controller
{
    // Hàm index duy nhất để render home page
    public function index()
    {
        // Lấy tất cả banner hiển thị ở home page
        $banners = Banner::where('display_at_home_page', 1)
                        ->orderBy('id', 'desc')
                        ->get();

        // Truyền banners ra view cùng các dữ liệu khác nếu cần
        return view('frontend.home', compact('banners'));
    }

    // Các hàm static vẫn giữ nguyên
    public static function hotProducts()
    {
        $products = DB::table("products")
                    ->where("hot","=",1)
                    ->orderBy("id", "desc")
                    ->skip(0)->take(10)
                    ->get();
        return $products;
    }

    public static function getCategories()
    {
        $categories = DB::table("categories")
                        ->where("display_at_home_page","=",1)
                        ->orderBy("id", "desc")
                        ->get();
        return $categories;
    }

    public static function getProductsInCategory($category_id)
    {
        $products = DB::table("products")
                    ->where("category_id","=",$category_id)
                    ->orderBy("id", "desc")
                    ->skip(0)->take(10)
                    ->get();
        return $products;
    }

    public static function hotNews()
    {
        $news = DB::table("news")
                  ->where("hot","=",1)
                  ->orderBy("id", "desc")
                  ->skip(0)->take(10)
                  ->get();
        return $news;
    }
}
