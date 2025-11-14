@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật sản phẩm' : 'Tạo sản phẩm')
@section('page-title', isset($record) ? 'Cập nhật sản phẩm' : 'Tạo sản phẩm')

@section('content')
<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input name="name" class="form-control" value="{{ $record->name ?? old('name') }}">
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <select name="category_id" class="form-control">
            <option value="0">Không có</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @if(isset($record) && $record->category_id == $c->id) selected @endif>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Giá</label>
        <input name="price" type="number" class="form-control" value="{{ $record->price ?? old('price') }}">
    </div>

    <div class="mb-3">
        <label>Giảm giá</label>
        <input name="discount" type="number" class="form-control" value="{{ $record->discount ?? old('discount') }}">
    </div>

    <div class="mb-3">
        <label>Tiêu đề sản phẩm</label>
        <textarea name="description" class="form-control">{{ $record->description ?? old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Mô tả sản phẩm</label>
        <textarea name="content" class="form-control">{{ $record->content ?? old('content') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Ảnh</label>
        <input type="file" name="photo" class="form-control">
        @if(isset($record) && $record->photo)
            <img src="{{ asset('storage/products/'.$record->photo) }}" alt="" width="100">
        @endif
    </div>

    <div class="mb-3">
        <label>
            <input type="checkbox" name="hot" @if(isset($record) && $record->hot) checked @endif>
            Là sản phẩm hot
        </label>
    </div>

    <button class="btn btn-primary">Lưu</button>
</form>
@endsection
