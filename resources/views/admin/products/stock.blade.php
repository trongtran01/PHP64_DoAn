@extends('admin.layouts.admin')

@section('title', 'Kho: ' . $record->name)
@section('page-title', 'Điều chỉnh kho')

@php
    $reasons = [
        'initial'         => 'Tồn kho ban đầu',
        'order_placed'    => 'Đặt hàng',
        'order_cancelled' => 'Hủy đơn (hoàn kho)',
        'admin_adjust'    => 'Admin điều chỉnh',
    ];
@endphp

@section('content')
@foreach(['success' => 'success', 'error' => 'danger'] as $key => $class)
    @if(session($key))
        <div class="alert alert-{{ $class }}">{{ session($key) }}</div>
    @endif
@endforeach
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card mb-3">
    <div class="card-header">
        {{ $record->name }} @if($record->sku) <small class="text-muted">({{ $record->sku }})</small> @endif
    </div>
    <div class="card-body">
        <p class="mb-3">Tồn kho hiện tại: <strong style="font-size:1.4em">{{ $record->stock }}</strong></p>

        <form method="POST" action="{{ route('admin.products.stock.adjust', $record->id) }}" class="row g-2 align-items-end">
            @csrf
            <div class="col-md-3">
                <label>Thay đổi (+ cộng / − trừ)</label>
                <input type="number" name="delta" step="1" class="form-control" value="{{ old('delta') }}" placeholder="vd: 20 hoặc -3" required>
            </div>
            <div class="col-md-6">
                <label>Lý do (bắt buộc)</label>
                <input type="text" name="note" maxlength="500" class="form-control" value="{{ old('note') }}" placeholder="vd: Nhập hàng đợt 3, kiểm kê lệch, hàng hỏng..." required>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Cập nhật kho</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Lịch sử kho</div>
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>Thời gian</th>
                    <th>Loại</th>
                    <th>Thay đổi</th>
                    <th>Tồn sau</th>
                    <th>Tham chiếu</th>
                    <th>Ghi chú</th>
                    <th>Người thực hiện</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movements as $m)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($m->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $reasons[$m->reason] ?? $m->reason }}</td>
                        <td class="{{ $m->quantity_change > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $m->quantity_change > 0 ? '+' : '' }}{{ $m->quantity_change }}
                        </td>
                        <td>{{ $m->stock_after }}</td>
                        <td>
                            @if($m->reference_type === 'order' && $m->reference_id)
                                <a href="{{ route('admin.orders.show', $m->reference_id) }}">Đơn #{{ $m->reference_id }}</a>
                            @else
                                —
                            @endif
                        </td>
                        <td class="text-start">{{ $m->note }}</td>
                        <td>{{ $m->created_by ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-muted">Chưa có biến động kho nào.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $movements->links() }}
    </div>
</div>
@endsection