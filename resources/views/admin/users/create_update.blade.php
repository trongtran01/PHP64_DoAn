@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật Admin' : 'Thêm Admin')
@section('page-title', isset($record) ? 'Cập nhật Admin' : 'Thêm Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ isset($record) ? 'Cập nhật Admin' : 'Thêm Admin' }}</h4>
    </div>

    <div class="card-body">
        <form method="post" action="{{ $action }}">
            @csrf
            @if(isset($record))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input 
                    type="text" 
                    name="name"
                    class="form-control"
                    value="{{ old('name', $record->name ?? '') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email"
                    class="form-control"
                    value="{{ old('email', $record->email ?? '') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Password ({{ isset($record) ? 'Để trống nếu không đổi' : 'Bắt buộc' }})</label>
                <input 
                    type="password" 
                    name="password"
                    class="form-control"
                    {{ isset($record) ? '' : 'required' }}
                >
            </div>

            <button class="btn btn-success">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
        </form>
    </div>
</div>
@endsection
