<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//--
// url: /public/admin/login
Route::get('backend/login', function () {
    return view('admin.login.form_login');
});
// url: /public/admin/login-post
Route::post('backend/login-post', function () {
    $email = Request::get("email");
    $password = Request::get("password");
    // Sử dụng đối tượng Auth để kiểm tra đăng nhập
    if(Auth::attempt(["email"=>$email, "password"=>$password]))
        return redirect(url('backend'));
    else
        return redirect(url('backend/login?notify=invalid'));

});
// url: /public/admin/logout
Route::get('backend/logout', function () {
    return view('admin.login.form_login');
});
//admin
//url: /public/backend -> khi đó sẽ load Controller HomeController
Route::get('backend', function () {
    return view('admin.home.read');
})->middleware("check_login");
//--

//---
//để sử dụng Controller thì phải khai báo ở đây
use App\Http\Controllers\Admin\UsersController;
//read
Route::get('backend/users',[UsersController::class,'read']);
//create
Route::get('backend/users/create',[UsersController::class,'create']);
//create post
Route::post('backend/users/create-post',[UsersController::class,'createPost']);
//update
Route::get('backend/users/update/{id}',[UsersController::class,'update']);
//update post
Route::post('backend/users/update-post/{id}',[UsersController::class,'updatePost']);
//delete
Route::get('backend/users/delete/{id}',[UsersController::class,'delete']);
//---


//để sử dụng Controller thì phải khai báo ở đây
use App\Http\Controllers\Admin\CategoriesController;
//read
Route::get('backend/categories',[CategoriesController::class,'read']);
//create
Route::get('backend/categories/create',[CategoriesController::class,'create']);
//create post
Route::post('backend/categories/create-post',[CategoriesController::class,'createPost']);
//update
Route::get('backend/categories/update/{id}',[CategoriesController::class,'update']);
//update post
Route::post('backend/categories/update-post/{id}',[CategoriesController::class,'updatePost']);
//delete
Route::get('backend/categories/delete/{id}',[CategoriesController::class,'delete']);
//---


//--
// Route::get('backend/backend', function () {
//     return view('admin.home.read');
// });
// // Thêm cái này thì khi ra trang backend/backend lại mất ảnh?
//--

//--
//frontend
//--
Route::get('/', function () {
    // Mã hóa passworld
    echo Hash::make("123");
    return view('welcome');
});
