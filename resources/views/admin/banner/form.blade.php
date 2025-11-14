@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật Banner' : 'Tạo Banner')
@section('page-title', isset($record) ? 'Cập nhật Banner' : 'Tạo Banner')

@section('content')
<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="{{ $record->title ?? old('title') }}">
    </div>

    <div class="mb-3">
        <label>Mô tả ngắn</label>
        <textarea name="short_description" class="form-control">{{ $record->short_description ?? old('short_description') }}</textarea>
    </div>

    <div class="mb-3">
        <label>URL button</label>
        <input type="url" name="button_url" class="form-control" value="{{ $record->button_url ?? old('button_url') }}">
    </div>

    <div class="mb-3">
        <label>Ảnh banner</label>
        <input type="file" name="photo" class="form-control">
        @if(isset($record) && $record->photo)
            <img src="{{ asset('storage/banners/'.$banner->photo) }}" alt="{{ $banner->title }}">
        @endif
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="display_at_home_page" @if(isset($record) && $record->display_at_home_page) checked @endif>
        <label class="form-check-label">Hiển thị ở trang chủ</label>
    </div>

    <button class="btn btn-primary">Lưu</button>
</form>
@endsection
