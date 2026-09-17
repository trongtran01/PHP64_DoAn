<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $data = Banner::query()
            ->latest()
            ->paginate(10);

        return view('admin.banner.index', compact('data'));
    }

    public function create(): View
    {
        return view('admin.banner.form', [
            'action' => route('admin.banner.store'),
            'record' => null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        // Mặc định banner luôn hiển thị ở trang chủ.
        $validated['display_at_home_page'] = 1;

        Banner::saveBanner(
            $validated,
            $request->file('photo')
        );

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Tạo banner thành công.');
    }
    public function edit(int $id): View
    {
        $record = Banner::findOrFail($id);

        return view('admin.banner.form', [
            'record' => $record,
            'action' => route('admin.banner.update', $record->id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        // Banner sau khi cập nhật vẫn luôn hiển thị.
        $validated['display_at_home_page'] = 1;

        Banner::saveBanner(
            $validated,
            $request->file('photo'),
            $id
        );

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Cập nhật banner thành công.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $banner = Banner::findOrFail($id);

        if (
            $banner->photo
            && Storage::disk('public')->exists('banner/' . $banner->photo)
        ) {
            Storage::disk('public')->delete(
                'banner/' . $banner->photo
            );
        }

        $banner->delete();

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Xóa banner thành công.');
    }
}