@extends('admin.layouts.admin')

@section('title', 'Danh sách sản phẩm')
@section('page-title', 'Danh sách sản phẩm')

@section('content')
@foreach(['success' => 'success', 'error' => 'danger'] as $key => $class)
    @if(session($key))
        <div class="alert alert-{{ $class }}">{{ session($key) }}</div>
    @endif
@endforeach

<a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Tạo mới sản phẩm</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>SKU</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Tồn kho</th>
        <th>Trạng thái</th>
        <th>Hot</th>
        <th>Actions</th>
    </tr>

    @foreach($data as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->sku }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category ? $product->category->name : '' }}</td>
        <td>{{ number_format($product->price) }}</td>
        <td>{{ $product->discount }}%</td>
        <td>
            @if($product->isConfigurable())
                <span class="text-muted">—</span>
            @elseif($product->stock > 0)
                {{ $product->stock }}
            @else
                <span class="text-danger">Hết hàng</span>
            @endif
        </td>
        <td>
            @if($product->is_active)
                <span class="text-success">Bật</span>
            @else
                <span class="text-secondary">Tắt</span>
            @endif
        </td>
        <td>{{ $product->hot ? 'Yes' : 'No' }}</td>
        <td>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
            @unless($product->isConfigurable())
                <a href="{{ route('admin.products.stock', $product->id) }}" class="btn btn-info">Kho</a>
            @endunless
            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Xóa luôn?')">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $data->links() }}
@endsection