<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegionRequest;
use App\Models\StoreRegion;
use Illuminate\Support\Facades\Storage;

class StoreRegionController extends Controller
{
    public function index()
    {
        $regions = StoreRegion::withCount('stores')->ordered()->paginate(20);

        return view('admin.store_regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.store_regions.form', [
            'action' => route('admin.store-regions.store'),
        ]);
    }

    public function edit(StoreRegion $store_region)
    {
        return view('admin.store_regions.form', [
            'action' => route('admin.store-regions.update', $store_region->id),
            'record' => $store_region,
        ]);
    }

    public function store(StoreRegionRequest $request)
    {
        $data = $request->validated();
        unset($data['banner_image'], $data['remove_banner']);

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('regions', 'public');
        }

        StoreRegion::create($data);

        return redirect()->route('admin.store-regions.index')->with('success', 'Đã thêm khu vực.');
    }

    public function update(StoreRegionRequest $request, StoreRegion $store_region)
    {
        $data = $request->validated();
        unset($data['banner_image'], $data['remove_banner']);

        if ($request->hasFile('banner_image')) {
            $this->deleteImage($store_region->banner_image);
            $data['banner_image'] = $request->file('banner_image')->store('regions', 'public');
        } elseif ($request->boolean('remove_banner')) {
            $this->deleteImage($store_region->banner_image);
            $data['banner_image'] = null;
        }

        $store_region->update($data);

        return redirect()->route('admin.store-regions.index')->with('success', 'Đã cập nhật khu vực.');
    }

    public function destroy(StoreRegion $store_region)
    {
        if ($store_region->stores()->exists()) {
            return back()->with('error', 'Khu vực còn địa chỉ bên trong. Hãy xóa các địa chỉ trước hoặc chuyển sang trạng thái ẩn.');
        }

        $this->deleteImage($store_region->banner_image);
        $store_region->delete();

        return redirect()->route('admin.store-regions.index')->with('success', 'Đã xóa khu vực.');
    }

    public function toggle(StoreRegion $store_region)
    {
        $store_region->update(['is_active' => ! $store_region->is_active]);

        return back()->with('success', 'Đã cập nhật trạng thái.');
    }

    private function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}