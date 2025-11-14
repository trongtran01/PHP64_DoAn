@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật danh mục' : 'Tạo danh mục')
@section('page-title', isset($record) ? 'Cập nhật danh mục' : 'Tạo danh mục')

@section('content')
<form action="{{ $action }}" method="post">
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Tên danh mục</label>
        <input name="name" class="form-control" value="{{ $record->name ?? old('name') }}">
    </div>

    <div class="mb-3">
        <label>Danh mục cha</label>
        <select name="parent_id" class="form-control">
            <option value="0">Không có</option>
            @foreach($parents as $p)
                <option value="{{ $p->id }}"
                    @if(isset($record) && $record->parent_id == $p->id) selected @endif>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>
            <input type="checkbox" name="display_at_home_page"
                @if(isset($record) && $record->display_at_home_page) checked @endif>
            Hiển thị ở trang chủ
        </label>
    </div>

    <button class="btn btn-primary">Lưu</button>
</form>
@endsection
