<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $data = Banner::getAllPaginated(10);
        return view('admin.banner.index', compact('data'));
    }

    public function create()
    {
        $action = route('admin.banner.store');
        return view('admin.banner.form', compact('action'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'photo' => 'required|image|max:2048',
            'display_at_home_page' => 'nullable|boolean',
        ]);

        Banner::saveBanner($request->only(['title','short_description','button_url','display_at_home_page']), $request->file('photo'));

        return redirect()->route('admin.banner.index')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $record = Banner::findOrFail($id);
        $action = route('admin.banner.update', $id);
        return view('admin.banner.form', compact('record', 'action'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'photo' => 'nullable|image|max:2048',
            'display_at_home_page' => 'nullable|boolean',
        ]);

        Banner::saveBanner($request->only(['title','short_description','button_url','display_at_home_page']), $request->file('photo'), $id);

        return redirect()->route('admin.banner.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->deleteBanner();

        return redirect()->route('admin.banner.index')->with('success', 'Banner deleted successfully.');
    }
}
