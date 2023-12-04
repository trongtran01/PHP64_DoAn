<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NewsController extends Controller

{
    public static function getAllNews()
    {
        $news = DB::table("news")->orderBy("id", "desc")->paginate(50);
        return $news;
    }
    public static function hotNews(){
        $news = DB::table("news")->where("hot","=",1)->orderBy("id", "desc")->skip(0)->take(10)->get();
        return $news;
    }
    public function index()
    {
        $news = DB::table('news')->orderBy("id","desc")->paginate(50);
        return view('frontend.news', ['news' => $news]);
    }
    public function detail($id){
        $record = DB::table("news")->where("id","=",$id)->first();
        return view("frontend.news_detail",["record"=> $record]);
    }
}
