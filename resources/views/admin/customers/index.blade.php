@extends('admin.layouts.admin')

@section('title', 'Khách hàng')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Tên</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone ?? '-' }}</td>
                    <td>{{ $customer->address ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Chưa có khách hàng nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $customers->links() }}
    </div>
</div>
@endsection
