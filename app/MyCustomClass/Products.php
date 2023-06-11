<?php 
    namespace App\MyCustomClass;
    use DB;
    use Request;
    class Products{
        public function modelRead(){
            $data = DB::table("products")->orderBy("id", "desc")->paginate(50);
            return $data;
        }
        // Tạo hàm static để gọi trực tiếp bằng tên class mà không cần khởi tạo project
        public static function getCategoryName($category_id){
        	$record = DB::table("categories")->where("id","=","$category_id")->first();
        	return isset($record->name) ? $record->name : "";
        }
        public function modelGetRow($id){
        	$record = DB::table("products")->where("id","=",$id)->first();
        	return $record;
        }
        public function modelUpdate($id){
		$name = Request::get("name");//có thể sử dụng hàm request("name")
		$category_id = Request::get("category_id");
		$price = Request::get("price");
		$discount = Request::get("discount");
		$hot = Request::get("hot") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		//update bản ghi
		DB::table("products")->where("id","=",$id)->update(["name"=>$name,"category_id"=>$category_id,"description"=>$description, "price"=>$price, "discount"=>$discount,"content"=>$content,"hot"=>$hot]);
		//nếu có upload ảnh thì update
		if(Request::hasFile("photo")){
			//---
			//lấy ảnh cũ để xóa
			$record = DB::table("products")->where("id","=",$id)->first();
			if(file_exists('upload/products/'.$record->photo))
				unlink('upload/products/'.$record->photo);//xóa ảnh
			//---
			$file_name = Request::file("photo")->getClientOriginalName();
			$file_name = time()."_".$file_name;
			Request::file("photo")->move("upload/products",$file_name);
			DB::table("products")->where("id","=",$id)->update(["photo"=>$file_name]);
		}
		}
		public function modelCreate(){
		$name = Request::get("name");//có thể sử dụng hàm request("name")
		$category_id = Request::get("category_id");
		$price = Request::get("price");
		$discount = Request::get("discount");
		$hot = Request::get("hot") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		$photo = "";
		//nếu có upload ảnh
		if(Request::hasFile("photo")){
			$file_name = Request::file("photo")->getClientOriginalName();
			$photo = time()."_".$file_name;
			Request::file("photo")->move("upload/products",$photo);
		}
		//create bản ghi
		DB::table("products")->insert(["name"=>$name,"category_id"=>$category_id,"description"=>$description,"content"=>$content,"hot"=>$hot,"photo"=>$photo,"price"=>$price,"discount"=>$discount]);
		
	}
		public function modelDelete($id){
		    //lấy ảnh cũ để xóa
		    $record = DB::table("products")->where("id", $id)->first();

		    if ($record) {
		        $photoPath = 'upload/products/'.$record->photo;
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
		    DB::table("products")->where("id", $id)->delete();
		}

}