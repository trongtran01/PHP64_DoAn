@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật khu vực' : 'Thêm khu vực')
@section('page-title', isset($record) ? 'Cập nhật khu vực' : 'Thêm khu vực')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Không thể lưu khu vực.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($record)
                    @method('PUT')
                @endisset

                <div class="mb-3">
                    <label for="name" class="form-label">Tên khu vực <span class="text-danger">*</span></label>
                    <input id="name" type="text" name="name" maxlength="255"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $record->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input id="slug" type="text" name="slug" maxlength="100"
                        class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug', $record->slug ?? '') }}"
                        placeholder="hcm, dalat, hanoi...">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Để trống sẽ tự tạo từ tên. Dùng làm id của tab ở trang giới thiệu.
                    </small>
                </div>

                <div class="mb-3">
                    <label for="banner_image" class="form-label">Ảnh banner</label>
                    <input id="banner_image" type="file" name="banner_image"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="form-control @error('banner_image') is-invalid @enderror">
                    @error('banner_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Hỗ trợ JPG, PNG, WEBP. Tối đa 2MB.</small>

                    @if (isset($record) && $record->banner_image)
                        <div class="mt-3">
                            <p class="mb-2">Ảnh hiện tại:</p>
                            <img src="{{ asset('storage/' . $record->banner_image) }}"
                                alt="{{ $record->name }}"
                                style="width: 100%; max-width: 500px; height: 180px; object-fit: cover; border-radius: 8px;">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="map_embed_url" class="form-label">Bản đồ Google Maps</label>
                    <textarea id="map_embed_url" name="map_embed_url" rows="4"
                        class="form-control @error('map_embed_url') is-invalid @enderror"
                        placeholder='Dán nguyên thẻ <iframe src="https://www.google.com/maps/embed?..."></iframe>'>{{ old('map_embed_url', $record->map_embed_url ?? '') }}</textarea>
                    @error('map_embed_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Thứ tự hiển thị</label>
                    <input id="sort_order" type="number" min="0" name="sort_order"
                        class="form-control @error('sort_order') is-invalid @enderror"
                        value="{{ old('sort_order', $record->sort_order ?? 0) }}">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($record) ? 'Cập nhật' : 'Tạo khu vực' }}
                    </button>
                    <a href="{{ route('admin.store-regions.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection