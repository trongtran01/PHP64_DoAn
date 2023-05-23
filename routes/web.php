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

//--
//frontend
//--
Route::get('/', function () {
    // Mã hóa passworld
    echo Hash::make("123");
    return view('welcome');
});
