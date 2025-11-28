<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Danh sách banner
     */
    public function index()
    {
        $data = Banner::getAllPaginated(10);
        return view('admin.banner.index', compact('data'));
    }

    /**
     * Form tạo mới banner
     */
    public function create()
    {
        return view('admin.banner.form', [
            'action' => route('admin.banner.store'),
            'record' => null,
        ]);
    }

    /**
     * Lưu banner mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'photo' => 'required|image|max:2048',
            'display_at_home_page' => 'nullable',
        ]);

        $data = $request->only(['title', 'short_description', 'button_url']);
        $data['display_at_home_page'] = $request->has('display_at_home_page') ? 1 : 0;

        Banner::saveBanner($data, $request->file('photo'));

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Form chỉnh sửa banner
     */
    public function edit($id)
    {
        $record = Banner::findOrFail($id);
        return view('admin.banner.form', [
            'record' => $record,
            'action' => route('admin.banner.update', $id),
        ]);
    }

    /**
     * Cập nhật banner
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'photo' => 'nullable|image|max:2048',
            'display_at_home_page' => 'nullable',
        ]);

        $data = $request->only(['title', 'short_description', 'button_url']);
        $data['display_at_home_page'] = $request->has('display_at_home_page') ? 1 : 0;

        Banner::saveBanner($data, $request->file('photo'), $id);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Xóa banner
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->deleteBanner();

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
