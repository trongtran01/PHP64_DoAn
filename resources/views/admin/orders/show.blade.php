@extends('admin.layouts.admin')

@section('title', 'Chi tiết đơn hàng')
@section('page-title', 'Chi tiết đơn hàng')

@section('content')
<div class="content">
    <div class="mb-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
        @if($order->status == 0)
            <a href="{{ route('admin.orders.deliver', $order->id) }}" class="btn btn-success">Đánh dấu đã giao hàng</a>
        @endif
    </div>

    <div class="card mb-3">
        <div class="card-header">Thông tin đơn hàng</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Tên khách hàng</td>
                    <td>{{ $customer->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $customer->email ?? '' }}</td>
                </tr>
                <tr>
                    <td>Ngày mua</td>
                    <td>{{ date('d/m/Y', strtotime($order->date)) }}</td>
                </tr>
                <tr>
                    <td>Giá sản phẩm</td>
                    <td>{{ number_format($order->price - ($order->shipping_price ?? 0)) }} đ</td>
                </tr>
                <tr>
                    <td>Phí vận chuyển</td>
                    <td>{{ number_format($order->shipping_price ?? 0) }} đ</td>
                </tr>
                <tr>
                    <td>Tổng giá</td>
                    <td>{{ number_format($order->price ?? 0) }} đ</td>
                </tr>
                <tr>
                    <td>Trạng thái giao hàng</td>
                    <td>{{ $order->status == 1 ? 'Đã giao hàng' : 'Chưa giao hàng' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Chi tiết đơn hàng</div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Giảm giá</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ number_format($p->price) }} đ</td>
                            <td>{{ $p->discount }}%</td>
                            <td>{{ $p->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
