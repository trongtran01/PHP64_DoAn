@extends('admin.layouts.admin')

@section('title', 'Danh mục')
@section('page-title', 'Danh mục')

@section('content')
<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">Tạo mới danh mục</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Hiển thị</th>
        <th>Actions</th>
    </tr>

    @foreach($data as $parent)
    <tr>
        <td>{{ $parent->id }}</td>
        <td>{{ $parent->name }}</td>
        <td>{{ $parent->display_at_home_page ? 'Yes' : 'No' }}</td>
        <td>
            <a href="{{ route('admin.categories.edit', $parent->id) }}" class="btn btn-warning">Sửa</a>
            <form method="POST"
                  action="{{ route('admin.categories.destroy', $parent->id) }}"
                  style="display:inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"
                        onclick="return confirm('Xóa luôn?')">Xóa</button>
            </form>
        </td>
    </tr>

        {{-- Hiển thị category con --}}
        @foreach(\App\Models\Categories::where('parent_id', $parent->id)->get() as $child)
        <tr>
            <td>{{ $child->id }}</td>
            <td style="padding-left: 30px;">-- {{ $child->name }}</td>
            <td>{{ $child->display_at_home_page ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $child->id) }}" class="btn btn-warning">Sửa</a>
                <form method="POST"
                      action="{{ route('admin.categories.destroy', $child->id) }}"
                      style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"
                            onclick="return confirm('Xóa luôn?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach

    @endforeach
</table>

{{ $data->links() }}
@endsection
