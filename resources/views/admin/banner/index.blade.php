@extends('admin.layouts.admin')

@section('title', 'Danh sách Banner')
@section('page-title', 'Danh sách Banner')

@section('content')
<a href="{{ route('admin.banner.create') }}" class="btn btn-success mb-3">Tạo mới Banner</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Mô tả</th>
        <th>URL button</th>
        <th>Ảnh</th>
        <th>Hiển thị home</th>
        <th>Actions</th>
    </tr>

    @foreach($data as $banner)
    <tr>
        <td>{{ $banner->id }}</td>
        <td>{{ $banner->title }}</td>
        <td>{{ $banner->short_description }}</td>
        <td>{{ $banner->button_url }}</td>
        <td>
            @if($banner->photo)
                <img src="{{ asset('storage/banner/'.$banner->photo) }}" width="100" alt="photo">
            @endif
        </td>
        <td>{{ $banner->display_at_home_page ? 'Yes' : 'No' }}</td>
        <td>
            <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-warning">Sửa</a>
            <form method="POST" action="{{ route('admin.banner.destroy', $banner->id) }}" style="display:inline-block;">
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
