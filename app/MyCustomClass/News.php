<?php 
namespace App\MyCustomClass;
use DB;
use Request;
class News{
	public function modelRead(){
		$data = DB::table("news")->orderBy("id","desc")->paginate(50);
		return $data;
	}
	public function modelGetRow($id){
		$record = DB::table("news")->where("id","=",$id)->first();
		return $record;
	}
	public function modelUpdate($id){
		$name = Request::get("name");//có thể sử dụng hàm request("name")
		$hot = Request::get("hot") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		//update bản ghi
		DB::table("news")->where("id","=",$id)->update(["name"=>$name,"description"=>$description,"content"=>$content,"hot"=>$hot]);
		//nếu có upload ảnh thì update
		if(Request::hasFile("photo")){
			//---
			//lấy ảnh cũ để xóa
			$record = DB::table("news")->where("id","=",$id)->first();
			if(file_exists('upload/news/'.$record->photo))
				unlink('upload/news/'.$record->photo);//xóa ảnh
			//---
			$file_name = Request::file("photo")->getClientOriginalName();
			$file_name = time()."_".$file_name;
			Request::file("photo")->move("upload/news",$file_name);
			DB::table("news")->where("id","=",$id)->update(["photo"=>$file_name]);
		}
	}
	public function modelCreate(){
		$name = Request::get("name");//có thể sử dụng hàm request("name")
		$hot = Request::get("hot") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		$photo = "";
		//nếu có upload ảnh
		if(Request::hasFile("photo")){
			$file_name = Request::file("photo")->getClientOriginalName();
			$photo = time()."_".$file_name;
			Request::file("photo")->move("upload/news",$photo);
		}
		//create bản ghi
		DB::table("news")->insert(["name"=>$name,"description"=>$description,"content"=>$content,"hot"=>$hot,"photo"=>$photo]);
		
	}
	public function modelDelete($id){
		    //lấy ảnh cũ để xóa
		    $record = DB::table("news")->where("id", $id)->first();

		    if ($record) {
		        $photoPath = 'upload/news/'.$record->photo;
		        if (file_exists($photoPath)) {
		            if (is_file($photoPath)) {
		                unlink($photoPath);//xóa tệp tin ảnh
		            } elseif (is_dir($photoPath)) {
		                // Nếu là thư mục, bạn có thể sử dụng hàm rmdir() để xóa thư mục
		                // Hoặc bạn có thể sử dụng phương pháp khác để xóa các tệp tin trong thư mục trước khi xóa thư mục chính nếu cần thiết.
		            }
		        }
		    }

		    //xóa bản ghi
		    DB::table("news")->where("id", $id)->delete();
		}
}