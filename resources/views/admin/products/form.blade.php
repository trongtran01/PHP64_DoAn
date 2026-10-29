@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật sản phẩm' : 'Tạo sản phẩm')
@section('page-title', isset($record) ? 'Cập nhật sản phẩm' : 'Tạo sản phẩm')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input name="name" class="form-control" value="{{ old('name', $record->name ?? '') }}">
    </div>

    <div class="mb-3">
        <label>SKU</label>
        <input name="sku" class="form-control" maxlength="64" value="{{ old('sku', $record->sku ?? '') }}">
        <small class="text-muted">Mã sản phẩm, không được trùng. Có thể để trống.</small>
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <select name="category_id" class="form-control">
            <option value="0">Không có</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id', $record->category_id ?? null) == $c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Giá (VND)</label>
        <input name="price" type="number" min="0" step="1" class="form-control" value="{{ old('price', $record->price ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Giảm giá (%)</label>
        <input name="discount" type="number" min="0" max="100" class="form-control" value="{{ old('discount', $record->discount ?? 0) }}">
    </div>

    {{-- Tồn kho --}}
    <div class="mb-3">
        <label>Tồn kho</label>
        @if(isset($record))
            <div>
                <strong>{{ $record->stock }}</strong>
                @if($record->isConfigurable())
                    <span class="text-muted">(sản phẩm configurable không có tồn kho riêng)</span>
                @else
                    <a href="{{ route('admin.products.stock', $record->id) }}" class="btn btn-sm btn-outline-primary ms-2">Điều chỉnh kho / Lịch sử</a>
                @endif
            </div>
        @else
            <input name="stock" type="number" min="0" step="1" class="form-control" value="{{ old('stock', 0) }}">
            <small class="text-muted">Số lượng nhập ban đầu. Sau khi tạo, chỉ đổi được qua "Điều chỉnh kho".</small>
        @endif
    </div>

    <div class="mb-3">
        <label>Tiêu đề sản phẩm</label>
        <textarea name="description" class="form-control" id="description-editor">{{ old('description', $record->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Mô tả sản phẩm</label>
        <textarea name="content" class="form-control" id="content-editor">{{ old('content', $record->content ?? '') }}</textarea>
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
            <input type="checkbox" name="hot" @checked(old('hot', $record->hot ?? false))>
            Là sản phẩm hot
        </label>
    </div>

    <div class="mb-3">
        <input type="hidden" name="is_active" value="0">
        <label>
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $record->is_active ?? true))>
            Bật sản phẩm (hiển thị trên website)
        </label>
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