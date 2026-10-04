@extends('admin.layouts.admin')

@section('title', 'Địa chỉ cửa hàng')
@section('page-title', 'Địa chỉ cửa hàng')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="{{ route('admin.stores.create', request('region_id') ? ['region_id' => request('region_id')] : []) }}"
           class="btn btn-success">Thêm địa chỉ</a>

        <a href="{{ route('admin.store-regions.index') }}" class="btn btn-outline-secondary">Quản lý khu vực</a>

        <form method="GET" action="{{ route('admin.stores.index') }}" class="d-flex gap-2 ms-auto">
            <select name="region_id" class="form-select" onchange="this.form.submit()">
                <option value="">Tất cả khu vực</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" @selected((string) request('region_id') === (string) $region->id)>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <table class="table table-bordered align-middle">
        <tr>
            <th>Tên</th>
            <th>Phường</th>
            <th>Địa chỉ</th>
            <th>Ghi chú</th>
            <th>SĐT</th>
            <th>Giờ mở cửa</th>
            <th>Thứ tự hiển thị</th>
            <th>Trạng thái</th>
            <th>Actions</th>
        </tr>

        @forelse ($stores as $store)
            <tr>
                <td>
                    {{ $store->name }}
                    <div class="small text-muted">{{ $store->region->name ?? '—' }}</div>
                </td>
                <td>{{ $store->ward }}</td>
                <td>{{ $store->address }}</td>
                <td>{{ $store->note }}</td>
                <td>{{ $store->phone }}</td>
                <td>{{ $store->opening_hours }}</td>
                <td>{{ $store->sort_order }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.stores.toggle', $store->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $store->is_active ? 'btn-success' : 'btn-secondary' }}">
                            {{ $store->is_active ? 'Đang hiện' : 'Đang ẩn' }}
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-warning">Sửa</a>
                    <form method="POST" action="{{ route('admin.stores.destroy', $store->id) }}" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Xóa địa chỉ này?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted">Chưa có địa chỉ nào.</td>
            </tr>
        @endforelse
    </table>

    {{ $stores->links() }}
@endsection