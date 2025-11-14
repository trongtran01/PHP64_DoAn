<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Danh sách Category
     */
    public function index()
    {
        $data = Categories::where('parent_id', 0)
            ->orderByDesc('id')
            ->paginate(50);

        return view('admin.categories.index', compact('data'));
    }

    /**
     * Form tạo mới Category
     */
    public function create()
    {
        $parents = Categories::where('parent_id', 0)->get();
        return view('admin.categories.form', [
            'action' => route('admin.categories.store'),
            'record' => null,
            'parents' => $parents,
        ]);
    }

    /**
     * Xử lý lưu Category mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
        ]);

        Categories::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? 0,
            'display_at_home_page' => $request->has('display_at_home_page') ? 1 : 0
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Tạo category thành công');
    }

    /**
     * Form sửa Category
     */
    public function edit($id)
    {
        $record = Categories::findOrFail($id);
        $parents = Categories::where('parent_id', 0)
                     ->where('id', '!=', $id)
                     ->get();

        return view('admin.categories.form', [
            'action' => route('admin.categories.update', $id),
            'record' => $record,
            'parents' => $parents,
        ]);
    }

    /**
     * Xử lý cập nhật Category
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
        ]);

        $record = Categories::findOrFail($id);

        $record->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? 0,
            'display_at_home_page' => $request->has('display_at_home_page') ? 1 : 0
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Cập nhật category thành công');
    }

    /**
     * Xóa Category + Category con
     */
    public function destroy($id)
    {
        // Xóa category con trước
        Categories::where('parent_id', $id)->delete();

        // Xóa cha
        Categories::where('id', $id)->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa category thành công');
    }
}
