<?php
namespace App\MyCustomClass;
use DB;
use Request;

class Banner{
    public function modelRead(){
        $data = DB::table("banners")->orderBy("id","desc")->paginate(50);
        return $data;
    }

    public function modelGetRow($id){
        $record = DB::table("banners")->where("id","=",$id)->first();
        return $record;
    }

    public function modelUpdate($id){
        $name = Request::get("name");
        $display_at_home_page = Request::get("display_at_home_page") != "" ? 1 : 0;

        // Cập nhật bản ghi
        DB::table("banners")->where("id","=",$id)->update([
            "name" => $name,
            "display_at_home_page" => $display_at_home_page
        ]);

        // Kiểm tra và thực hiện upload ảnh mới nếu có
        if(Request::hasFile("photo")){
            $record = DB::table("banners")->where("id","=",$id)->first();

            if ($record && $record->photo) {
                $old_photo_path = 'upload/banners/' . $record->photo;

                // Kiểm tra và xóa tập tin cũ
                if (file_exists($old_photo_path) && is_file($old_photo_path)) {
                    unlink($old_photo_path);
                }
            }

            $file_name = Request::file("photo")->getClientOriginalName();
            $file_name = time()."_".$file_name;
            Request::file("photo")->move("upload/banners", $file_name);

            // Cập nhật tên ảnh mới vào cơ sở dữ liệu
            DB::table("banners")->where("id","=",$id)->update(["photo"=>$file_name]);
        }
    }

    public function modelCreate(){
        $name = Request::get("name");
        $display_at_home_page = Request::get("display_at_home_page") != "" ? 1 : 0;
        $photo = "";

        // Nếu có upload ảnh
        if(Request::hasFile("photo")){
            $file_name = Request::file("photo")->getClientOriginalName();
            $photo = time()."_".$file_name;
            Request::file("photo")->move("upload/banners",$photo);
        }

        // Create bản ghi
        DB::table("banners")->insert([
            "name" => $name,
            "display_at_home_page" => $display_at_home_page,
            "photo" => $photo
        ]);
    }

    public function modelDelete($id){
        // Lấy ảnh cũ để xóa
        $record = DB::table("banners")->where("id", $id)->first();

        if ($record) {
            $photoPath = 'upload/banners/'.$record->photo;
            if (file_exists($photoPath)) {
                if (is_file($photoPath)) {
                    unlink($photoPath); // Xóa tệp tin ảnh
                }
            }
        }

        // Xóa bản ghi
        DB::table("banners")->where("id", $id)->delete();
    }
}
