@extends('admin.layouts.admin')

@section('title', 'Danh sách Tin tức')
@section('page-title', 'Danh sách Tin tức')

@section('content')
<a href="{{ route('admin.news.create') }}" class="btn btn-success mb-3">Tạo mới Tin tức</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Hot</th>
        <th>Ảnh</th>
        <th>Actions</th>
    </tr>

    @foreach($data as $news)
    <tr>
        <td>{{ $news->id }}</td>
        <td>{{ $news->name }}</td>
        <td>{{ $news->hot ? 'Yes' : 'No' }}</td>
        <td>
            @if($news->photo)
                <img src="{{ asset('storage/news/'.$news->photo) }}" width="100" alt="photo">
            @endif
        </td>
        <td>
            <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-warning">Sửa</a>
            <form method="POST" action="{{ route('admin.news.destroy', $news->id) }}" style="display:inline-block;">
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
