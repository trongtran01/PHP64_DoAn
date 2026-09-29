@extends('admin.layouts.admin')

@section('title', isset($customer) ? 'Sửa thông tin khách hàng' : 'Thêm khách hàng')
@section('page-title', isset($customer) ? 'Sửa thông tin khách hàng' : 'Thêm khách hàng')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ $action }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name', $customer->name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $customer->email ?? '') }}" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                    value="{{ old('phone', $customer->phone ?? '') }}">
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control"
                    value="{{ old('address', $customer->address ?? '') }}">
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu mới</label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    autocomplete="new-password"
                    class="form-control"
                >

                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    autocomplete="new-password"
                    class="form-control"
                >
            </div>

            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div>
</div>
@endsection
