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
                                    <th>Thời gian</th>
                                    <th>Giá tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @php
                                        $customer = DB::table('customers')->where('id', $order->customer_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $customer->name ?? '' }}</td>
                                        <td>{{ date('d/m/Y', strtotime($order->date)) }}</td>
                                        <td>{{ number_format($order->price) }} đ</td>
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
