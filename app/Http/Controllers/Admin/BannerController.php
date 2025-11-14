<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Khai báo class Banner
use App\MyCustomClass\Banner;

class BannerController extends Controller{
    // Tạo biến $model (là một biến của class BannerController)
    public $model;

    // Hàm tạo
    public function __construct(){
        // Khởi tạo object của class Banner, sau đó gán vào biến $model
        $this->model = new Banner();
    }

    public function read(){
        $data = $this->model->modelRead();
        return view("admin.banner.read",["data"=>$data]);
    }

    public function update($id){
        $record = $this->model->modelGetRow($id);
        // Tạo biến $action để đưa vào thuộc tính action của thẻ form
        $action = url("backend/banner/update-post/$id");
        return view("admin.banner.create_update",["record"=>$record,"action"=>$action]);
    }

    public function updatePost($id){
        $this->model->modelUpdate($id);
        return redirect(url("backend/banner"));
    }

    public function create(){
        // Tạo biến $action để đưa vào thuộc tính action của thẻ form
        $action = url("backend/banner/create-post/");
        return view("admin.banner.create_update",["action"=>$action]);
    }

    public function createPost(){
        $this->model->modelCreate();
        return redirect(url("backend/banner"));
    }

    public function delete($id){
        $this->model->modelDelete($id);
        return redirect(url("backend/banner"));
    }
}
