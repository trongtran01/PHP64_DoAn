@extends('admin.layouts.admin')

@section('title', 'Khu vực cửa hàng')
@section('page-title', 'Khu vực cửa hàng')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.store-regions.create') }}" class="btn btn-success mb-3">Thêm khu vực</a>

    <table class="table table-bordered align-middle">
        <tr>
            <th>Banner</th>
            <th>Tên</th>
            <th>Slug</th>
            <th>Số cửa hàng</th>
            <th>Thứ tự hiển thị</th>
            <th>Trạng thái</th>
            <th>Actions</th>
        </tr>

        @forelse ($regions as $region)
            <tr>
                <td>
                    @if ($region->banner_image)
                        <img src="{{ asset('storage/' . $region->banner_image) }}" width="100" alt="{{ $region->name }}">
                    @endif
                </td>
                <td>{{ $region->name }}</td>
                <td>{{ $region->slug }}</td>
                <td>{{ $region->stores_count }}</td>
                <td>{{ $region->sort_order }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.store-regions.toggle', $region->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $region->is_active ? 'btn-success' : 'btn-secondary' }}">
                            {{ $region->is_active ? 'Đang hiện' : 'Đang ẩn' }}
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.stores.index', ['region_id' => $region->id]) }}" class="btn btn-info">Địa chỉ</a>
                    <a href="{{ route('admin.store-regions.edit', $region->id) }}" class="btn btn-warning">Sửa</a>
                    <form method="POST" action="{{ route('admin.store-regions.destroy', $region->id) }}" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button
                            class="btn btn-danger"
                            onclick="return confirm('Xóa khu vực này?')"
                            @disabled($region->stores_count > 0)
                            @if ($region->stores_count > 0) title="Còn địa chỉ bên trong, hãy xóa hoặc ẩn thay vì xóa" @endif
                        >Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">Chưa có khu vực nào.</td>
            </tr>
        @endforelse
    </table>

    {{ $regions->links() }}
@endsection