<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\StoreRegion;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $regions = StoreRegion::ordered()->get();

        $stores = Store::with('region')
            ->when($request->filled('region_id'), fn ($q) => $q->where('store_region_id', $request->region_id))
            ->orderBy('store_region_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(30)
            ->withQueryString();

        return view('admin.stores.index', compact('stores', 'regions'));
    }

    public function create(Request $request)
    {
        return view('admin.stores.form', [
            'action'           => route('admin.stores.store'),
            'regions'          => StoreRegion::ordered()->get(),
            'selectedRegionId' => $request->query('region_id'),
        ]);
    }

    public function edit(Store $store)
    {
        return view('admin.stores.form', [
            'action'           => route('admin.stores.update', $store->id),
            'record'           => $store,
            'regions'          => StoreRegion::ordered()->get(),
            'selectedRegionId' => $store->store_region_id,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $store = Store::create($request->validated());

        return redirect()
            ->route('admin.stores.index', ['region_id' => $store->store_region_id])
            ->with('success', 'Đã thêm địa chỉ.');
    }

    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->validated());

        return redirect()
            ->route('admin.stores.index', ['region_id' => $store->store_region_id])
            ->with('success', 'Đã cập nhật địa chỉ.');
    }

    public function destroy(Store $store)
    {
        $regionId = $store->store_region_id;
        $store->delete();

        return redirect()
            ->route('admin.stores.index', ['region_id' => $regionId])
            ->with('success', 'Đã xóa địa chỉ.');
    }

    public function toggle(Store $store)
    {
        $store->update(['is_active' => ! $store->is_active]);

        return back()->with('success', 'Đã cập nhật trạng thái.');
    }
}