@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật Tin tức' : 'Tạo Tin tức')
@section('page-title', isset($record) ? 'Cập nhật Tin tức' : 'Tạo Tin tức')

@section('content')
<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Tên Tin tức</label>
        <input name="name" class="form-control" value="{{ $record->name ?? old('name') }}" required>
    </div>

    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control" id="description-editor">{{ $record->description ?? old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Nội dung</label>
        <textarea name="content" class="form-control" id="content-editor" rows="5">{{ $record->content ?? old('content') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Ảnh đại diện</label>
        <input type="file" name="photo" class="form-control">
        @if(isset($record) && $record->photo)
            <img src="{{ asset('storage/news/'.$record->photo) }}" alt="photo" width="120" class="mt-2">
        @endif
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" name="hot" @if(isset($record) && $record->hot) checked @endif>
        <label class="form-check-label" for="hotCheck">Tin hot</label>
    </div>
    <button class="btn btn-primary">Lưu</button>
</form>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description-editor'))
        .catch(error => { console.error(error); });

    ClassicEditor
        .create(document.querySelector('#content-editor'))
        .catch(error => { console.error(error); });
</script>
@endsection
