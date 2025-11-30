<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ManageCustomersController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CustomersController;
use App\Http\Controllers\Frontend\ProductsController as ProductsFrontend;
use App\Http\Controllers\Frontend\NewsController as NewsFrontend;
use App\Http\Controllers\Frontend\CartController;



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

// Admin Home route
Route::get('backend/login', function () {
    return view('admin.login.form_login');
});
Route::post('backend/login-post', function () {
    $email = Request::get("email");
    $password = Request::get("password");
    // Sử dụng đối tượng Auth để kiểm tra đăng nhập
    if(Auth::attempt(["email"=>$email, "password"=>$password]))
        return redirect(url('backend'));
    else
        return redirect(url('backend/login?notify=invalid'));

});
Route::get('backend/logout', function () {
    return view('admin.login.form_login');
});
Route::get('backend', function () {
    return view('admin.home.read');
})->middleware("check_login");

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

// User route
Route::prefix('backend')->name('admin.')->group(function () {
    Route::resource('users', UsersController::class);
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

//Frontend Home
Route::get("/", [HomeController::class, 'index'])->name('home');

//Frontend Products
Route::get('products/category/{category_id}',[ProductsFrontend::class,'category']);
Route::get('products/detail/{id}',[ProductsFrontend::class,'detail']);
Route::get('products/search',[ProductsFrontend::class,'search']);
Route::get('products/ajax-search',[ProductsFrontend::class,'ajax']);
Route::get('products/rating/{id}',[ProductsFrontend::class,'rating']);

//Frontend New
Route::get('/news', [App\Http\Controllers\Frontend\NewsController::class, 'index']);
Route::get('news/detail/{id}',[NewsFrontend::class,'detail']);
Route::get('customers/login',[CustomersController::class,'login']);
Route::post('customers/login-post',[CustomersController::class,'loginPost']);
Route::get('customers/register',[CustomersController::class,'register']);
Route::post('customers/register-post',[CustomersController::class,'registerPost']);
Route::get('customers/logout',[CustomersController::class,'logout']);

//Frontend Cart
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
Route::post('cart/order', [CartController::class, 'order'])->name('cart.order');
// Chuyển đến trang thanh toán thành công
Route::get('cart/success', [CartController::class, 'success'])->name('success');
Route::post('cart/update-shipping', [CartController::class, 'updateShipping']);
Route::post('cart/set-shipping-session', [CartController::class, 'updateShipping'])->name('cart.setShippingSession');

//contact
Route::get('contact',function(){
    return view('frontend.contact');
});

//introduce
Route::get('introduce',function(){
    return view('frontend.introduce');
});

// Trang checkout cho guest
Route::get('/checkout/guest', [CartController::class, 'guestCheckout'])->name('guest.checkout');

// Submit đơn hàng guest
Route::post('/checkout/guest', [CartController::class, 'guestOrder'])->name('guest.order.post');

