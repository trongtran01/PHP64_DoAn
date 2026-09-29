<?php

namespace App\View\Composers;

use App\Models\Categories;
use App\Http\ShoppingCart\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

/**
 * Cung cấp dữ liệu chung cho partials.header — tự động chạy trước khi view
 * này render, không cần Controller nào tự truyền $categories, $cartCount xuống.
 *
 * Lưu ý: đăng nhập khách hàng trong CustomersController hiện đang set session
 * thủ công (không dùng Auth::guard), nên ở đây đọc thẳng session cho khớp.
 * Nếu sau này chuyển CustomersController sang dùng Auth::guard('customer'),
 * chỉ cần sửa lại 2 dòng $customerEmail / $customerName bên dưới.
 */
class HeaderComposer
{
    public function compose(View $view): void
    {
        // Cache 60 phút — cây category ít đổi, tránh query DB mỗi request.
        // Nhớ gọi Cache::forget('categories.tree') mỗi khi tạo/sửa/xoá category
        // (vd trong Admin\CategoriesController@store/update/destroy).
        $categoriesByParent = Cache::remember('categories.tree', 3600, function () {
            return Categories::orderBy('id', 'desc')->get()->groupBy('parent_id');
        });

        $cartCount = Cart::cartNumber();

        $view->with([
            'rootCategories' => $categoriesByParent->get(0, collect()),
            'categoriesByParent' => $categoriesByParent,
            'customerEmail' => Session::get('customer_email'),
            'customerName' => Session::get('customer_name'),
            'cartCount' => $cartCount,
            'cartItems' => $cartCount > 0 ? Cart::cartList() : [],
        ]);
    }
}