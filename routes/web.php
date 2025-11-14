<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrdersController;
use \App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CustomersController;
use App\Http\Controllers\Admin\ManageCustomersController;


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


// Controller route
Route::prefix('backend')->name('admin.')->group(function () {
    Route::resource('categories', CategoriesController::class);
});

// Products route
Route::prefix('backend')->name('admin.')->group(function () {
    Route::resource('products', ProductsController::class)->except(['show']);
});

// News route
Route::prefix('backend')->name('admin.')->group(function () {
    Route::resource('news', NewsController::class)->except(['show']);
});

// Order route
Route::prefix('backend')->name('admin.orders.')->group(function () {
    Route::get('orders', [OrdersController::class, 'index'])->name('index');
    Route::get('orders/{id}', [OrdersController::class, 'show'])->name('show');
    Route::get('orders/{id}/deliver', [OrdersController::class, 'markAsDelivered'])->name('deliver');
});

// Banner route
Route::prefix('backend')->name('admin.')->group(function () {
    Route::resource('banner', BannerController::class)->except(['show']);
});

// Customer route
Route::prefix('backend/customers')->name('admin.customers.')->group(function() {
    Route::get('/', [ManageCustomersController::class, 'index'])->name('index');
    Route::get('/edit/{id}', [ManageCustomersController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ManageCustomersController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ManageCustomersController::class, 'destroy'])->name('destroy');
});


//--
//frontend
//Home route
Route::get("/", [HomeController::class, 'index'])->name('home');


// Sử dụng ProductsController. Do ở bên trên đã khai báo ProductsController thực hiện tác vụ backend, vì vậy nếu khai báo lại ProductsController ở đây thì hệ thống sẽ báo lỗi. Xử lý bằng cách: đăth name cho controller
use \App\Http\Controllers\Frontend\ProductsController as ProductsFrontend;
Route::get('products/category/{category_id}',[ProductsFrontend::class,'category']);
Route::get('products/detail/{id}',[ProductsFrontend::class,'detail']);
//tìm kiếm
Route::get('products/search',[ProductsFrontend::class,'search']);
Route::get('products/ajax-search',[ProductsFrontend::class,'ajax']);
Route::get('products/rating/{id}',[ProductsFrontend::class,'rating']);

//Frontend New
use \App\Http\Controllers\Frontend\NewsController as NewsFrontend;

Route::get('/news', [App\Http\Controllers\Frontend\NewsController::class, 'index']);
Route::get('news/detail/{id}',[NewsFrontend::class,'detail']);

Route::get('customers/login',[CustomersController::class,'login']);
Route::post('customers/login-post',[CustomersController::class,'loginPost']);
Route::get('customers/register',[CustomersController::class,'register']);
Route::post('customers/register-post',[CustomersController::class,'registerPost']);
Route::get('customers/logout',[CustomersController::class,'logout']);

// Cart
use \App\Http\Controllers\Frontend\CartController;
// Danh sách giỏ hàng
Route::get('cart',[CartController::class,'index']);
// Thêm sản phẩm vào giỏ hàng
Route::get('cart/buy/{id}',[CartController::class,'buy']);
// Xóa sản phẩm khỏi giỏ hàng
Route::get('cart/delete/{id}',[CartController::class,'delete']);
// Xóa toàn bộ sản phẩm khỏi giỏ hàng
Route::get('cart/destroy',[CartController::class,'destroy']);
// Cập nhật số lượng sản phẩm trong giỏ hàng
Route::post('cart/update',[CartController::class,'update']);
// Thanh toán đơn hàng
Route::get('cart/order',[CartController::class,'order']);
// Chuyển đến trang thanh toán thành công
Route::get('cart/success', [CartController::class, 'success'])->name('success');


//contact
Route::get('contact',function(){
    return view('frontend.contact');
});

//introduce
Route::get('introduce',function(){
    return view('frontend.introduce');
});

