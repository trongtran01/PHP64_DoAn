@extends('admin.layouts.admin')

@section('title', 'Danh sách sản phẩm')
@section('page-title', 'Danh sách sản phẩm')

@section('content')
<a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Tạo mới sản phẩm</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Hot</th>
        <th>Actions</th>
    </tr>

    @foreach($data as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category ? $product->category->name : '' }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->discount }}</td>
        <td>{{ $product->hot ? 'Yes' : 'No' }}</td>
        <td>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
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
