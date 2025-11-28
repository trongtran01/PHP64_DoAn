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
                    value="{{ $customer->name ?? old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ $customer->email ?? old('email') }}" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                    value="{{ $customer->phone ?? old('phone') }}">
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control"
                    value="{{ $customer->address ?? old('address') }}">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                @if(isset($customer))
                    <small>Bỏ trống nếu không muốn đổi mật khẩu</small>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div>
</div>
@endsection
