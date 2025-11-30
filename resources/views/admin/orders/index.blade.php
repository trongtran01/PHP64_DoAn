@extends('admin.layouts.admin')

@section('title', 'Đơn hàng')
@section('page-title', 'Danh sách đơn hàng')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Danh sách đơn hàng</h4></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Thời gian</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Phí vận chuyển</th>
                                    <th>Tổng cộng</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @php
                                        // Lấy thông tin khách hàng
                                        if($order->customer_id) {
                                            $customer = DB::table('customers')->where('id', $order->customer_id)->first();
                                        } else {
                                            $customer = DB::table('guest_customers')->where('id', $order->guest_customer_id)->first();
                                        }

                                        // Tính tổng tiền: price trong DB đã bao gồm sản phẩm, thêm shipping_price
                                        $productPrice = $order->price - ($order->shipping_price ?? 0);
                                        $shippingPrice = $order->shipping_price ?? 0;
                                        $total = $productPrice + $shippingPrice;
                                    @endphp
                                    <tr>
                                        <td>{{ $customer->name ?? 'N/A' }}</td>
                                        <td>{{ $customer->email ?? 'N/A' }}</td>
                                        <td>{{ date('d/m/Y', strtotime($order->date)) }}</td>
                                        <td>{{ number_format($productPrice) }} đ</td>
                                        <td>{{ number_format($shippingPrice) }} đ</td>
                                        <td>{{ number_format($total) }} đ</td>
                                        <td>
                                            @if($order->status == 1)
                                                <span class="text-success">Đã giao hàng</span>
                                            @else
                                                <span class="text-danger">Chưa giao hàng</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Chi tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
