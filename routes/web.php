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

//---
//để sử dụng Controller thì phải khai báo ở đây
use App\Http\Controllers\Admin\ProductsController;
//read
Route::get('backend/products',[ProductsController::class,'read']);
//create
Route::get('backend/products/create',[ProductsController::class,'create']);
//create post
Route::post('backend/products/create-post',[ProductsController::class,'createPost']);
//update
Route::get('backend/products/update/{id}',[ProductsController::class,'update']);
//update post
Route::post('backend/products/update-post/{id}',[ProductsController::class,'updatePost']);
//delete
Route::get('backend/products/delete/{id}',[ProductsController::class,'delete']);
//---

//---
//để sử dụng Controller thì phải khai báo ở đây
use App\Http\Controllers\Admin\NewsController;
//read
Route::get('backend/news',[NewsController::class,'read']);
//create
Route::get('backend/news/create',[NewsController::class,'create']);
//create post
Route::post('backend/news/create-post',[NewsController::class,'createPost']);
//update
Route::get('backend/news/update/{id}',[NewsController::class,'update']);
//update post
Route::post('backend/news/update-post/{id}',[NewsController::class,'updatePost']);
//delete
Route::get('backend/news/delete/{id}',[NewsController::class,'delete']);
//---

//--
// Route::get('backend/backend', function () {
//     return view('admin.home.read');
// });
// // Thêm cái này thì khi ra trang backend/backend lại mất ảnh?
//--

//--
//frontend
//Sử dụng HomeController
use \App\Http\Controllers\Frontend\HomeController;
Route::get("", [HomeController::class, 'index']);

// Sử dụng ProductsController. Do ở bên trên đã khai báo ProductsController thực hiện tác vụ backend, vì vậy nếu khai báo lại ProductsController ở đây thì hệ thống sẽ báo lỗi. Xử lý bằng cách: đăth name cho controller
use \App\Http\Controllers\Frontend\ProductsController as ProductsFrontend;
Route::get('products/category/{category_id}',[ProductsFrontend::class,'category']);
Route::get('products/detail/{id}',[ProductsFrontend::class,'detail']);

use \App\Http\Controllers\Frontend\CustomersController;
Route::get('customers/login',[CustomersController::class,'login']);
Route::post('customers/login-post',[CustomersController::class,'loginPost']);
Route::get('customers/register',[CustomersController::class,'register']);
Route::post('customers/register-post',[CustomersController::class,'registerPost']);
Route::get('customers/logout',[CustomersController::class,'logout']);
