<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;

class ProductsController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index()
    {
        $data = Products::getAllPaginated(); // Phân trang 50 bản ghi
        return view('admin.products.index', compact('data'));
    }

    /**
     * Hiển thị form tạo sản phẩm
     */
    public function create()
    {
        $categories = Categories::all(); // Lấy tất cả category
        $action = route('admin.products.store'); // route resource chuẩn
        return view('admin.products.form', compact('categories', 'action'));
    }

    /**
     * Xử lý tạo sản phẩm
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name','category_id','price','discount','hot','description','content']);
        $file = $request->file('photo');

        Products::saveProduct($data, $file);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Hiển thị form cập nhật sản phẩm
     */
    public function edit($id)
    {
        $record = Products::findOrFail($id);
        $categories = Categories::all(); // Lấy category để select
        $action = route('admin.products.update', $id); // route resource chuẩn
        return view('admin.products.form', compact('record', 'categories', 'action'));
    }

    /**
     * Xử lý cập nhật sản phẩm
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name','category_id','price','discount','hot','description','content']);
        $file = $request->file('photo');

        Products::saveProduct($data, $file, $id);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->deleteProduct();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
