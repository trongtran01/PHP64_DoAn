<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin controllers
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ManageCustomersController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\StoreRegionController;
use App\Http\Controllers\Admin\UsersController;

// Frontend controllers
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CustomersController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\IntroduceController;
use App\Http\Controllers\Frontend\NewsController as NewsFrontend;
use App\Http\Controllers\Frontend\ProductsController as ProductsFrontend;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Bố cục file:
|   1. Admin - đăng nhập / đăng xuất (CÔNG KHAI, không có check_login)
|   2. Admin - toàn bộ trang quản trị (BẮT BUỘC đăng nhập: check_login)
|   3. Frontend
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| 1. Admin: đăng nhập / đăng xuất
|--------------------------------------------------------------------------
| Phải nằm NGOÀI group check_login, nếu không sẽ bị redirect lặp vô hạn.
*/
Route::get('backend/login', function () {
    return view('admin.login.form_login');
})->name('admin.login');

Route::post('backend/login-post', function (Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        // Tạo session id mới để chống session fixation
        $request->session()->regenerate();

        return redirect(url('backend'));
    }

    return redirect(url('backend/login?notify=invalid'));
})->name('admin.login-post');

// Đăng xuất: hủy session thật sự.
// TẠM THỜI cho phép cả GET để nút đăng xuất cũ (thẻ <a>) vẫn chạy.
// Sau khi đổi nút trong layout admin sang form POST + @csrf thì XÓA dòng GET.
$adminLogout = function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(url('backend/login'));
};
Route::post('backend/logout', $adminLogout)->name('admin.logout');
Route::get('backend/logout', $adminLogout);

/*
|--------------------------------------------------------------------------
| 2. Admin: trang quản trị (check_login)
|--------------------------------------------------------------------------
| Tên route giữ nguyên như cũ (admin.categories.*, admin.orders.*, ...).
*/
Route::prefix('backend')
    ->name('admin.')
    ->middleware('check_login')
    ->group(function () {

        // Trang chủ admin: /backend
        Route::get('/', function () {
            return view('admin.home.read');
        })->name('home');

        // CRUD cơ bản
        Route::resource('categories', CategoriesController::class);
        Route::resource('products', ProductsController::class)->except(['show']);
        Route::resource('news', NewsController::class)->except(['show']);
        Route::resource('users', UsersController::class);
        Route::resource('banner', BannerController::class)->except(['show']);

        // Địa chỉ cửa hàng (route toggle khai báo TRƯỚC resource)
        Route::patch('store-regions/{store_region}/toggle', [StoreRegionController::class, 'toggle'])->name('store-regions.toggle');
        Route::patch('stores/{store}/toggle', [StoreController::class, 'toggle'])->name('stores.toggle');
        Route::resource('store-regions', StoreRegionController::class)->except(['show']);
        Route::resource('stores', StoreController::class)->except(['show']);

        // Đơn hàng
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [OrdersController::class, 'index'])->name('index');
            Route::get('{id}', [OrdersController::class, 'show'])->name('show');
            Route::get('{id}/deliver', [OrdersController::class, 'markAsDelivered'])->name('deliver');
        });

        // Khách hàng
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [ManageCustomersController::class, 'index'])->name('index');
            Route::get('edit/{id}', [ManageCustomersController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ManageCustomersController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [ManageCustomersController::class, 'destroy'])->name('destroy');
        });
    });

/*
|--------------------------------------------------------------------------
| 3. Frontend
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Sản phẩm
Route::prefix('products')->name('products.')->group(function () {
    Route::get('category/{category_id}', [ProductsFrontend::class, 'category'])->name('category');
    Route::get('detail/{id}', [ProductsFrontend::class, 'detail'])->name('detail');
    Route::get('search', [ProductsFrontend::class, 'search'])->name('search');
    Route::get('ajax-search', [ProductsFrontend::class, 'ajax'])->name('ajax-search');
    Route::get('rating/{id}', [ProductsFrontend::class, 'rating'])->name('rating');
});

// Tin tức
Route::get('news', [NewsFrontend::class, 'index'])->name('news.index');
Route::get('news/detail/{id}', [NewsFrontend::class, 'detail'])->name('news.detail');

// Khách hàng
// Lưu ý: cần có method profile() và forgotPassword() trong CustomersController.
Route::prefix('customers')->name('customers.')->group(function () {
    Route::get('login', [CustomersController::class, 'login'])->name('login');
    Route::post('login-post', [CustomersController::class, 'loginPost'])->name('login-post');
    Route::get('register', [CustomersController::class, 'register'])->name('register');
    Route::post('register-post', [CustomersController::class, 'registerPost'])->name('register-post');
    Route::get('logout', [CustomersController::class, 'logout'])->name('logout');
    Route::get('profile', [CustomersController::class, 'profile'])->name('profile');
    Route::get('forgot-password', [CustomersController::class, 'forgotPassword'])->name('forgot-password');
});

// Giỏ hàng
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('cart/buy/{id}', [CartController::class, 'buy'])->name('cart.buy');          // thêm vào giỏ
Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete'); // xóa 1 sản phẩm
Route::get('cart/destroy', [CartController::class, 'destroy']);                         // xóa toàn bộ giỏ
Route::post('cart/update', [CartController::class, 'update']);                          // cập nhật số lượng
Route::post('cart/order', [CartController::class, 'order'])->name('cart.order');        // đặt hàng
Route::get('cart/success', [CartController::class, 'success'])->name('success');        // đặt hàng thành công
Route::post('cart/update-shipping', [CartController::class, 'updateShipping']);
Route::post('cart/set-shipping-session', [CartController::class, 'updateShipping'])->name('cart.setShippingSession');

// Thanh toán khách vãng lai
Route::get('checkout/guest', [CartController::class, 'guestCheckout'])->name('guest.checkout');
Route::post('checkout/guest', [CartController::class, 'guestOrder'])->name('guest.order.post');

// Stripe
Route::get('stripe/success', [CartController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('stripe/cancel', [CartController::class, 'stripeCancel'])->name('stripe.cancel');

// Trang tĩnh
Route::get('contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('introduce', [IntroduceController::class, 'index'])->name('introduce');