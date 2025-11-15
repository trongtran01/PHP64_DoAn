@extends('admin.layouts.admin')

@section('title', 'Quản lý Admin')
@section('page-title', 'Danh sách Admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Admin</h4>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Thêm Admin</a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="50">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="120" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><b>{{ $user->name }}</b></td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.users.edit', $user->id) }}">Sửa</a>
                        |
                        <a href="{{ route('admin.users.destroy', $user->id) }}"
                           onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection
