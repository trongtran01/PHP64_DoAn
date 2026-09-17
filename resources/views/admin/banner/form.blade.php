@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật Banner' : 'Tạo Banner')
@section('page-title', isset($record) ? 'Cập nhật Banner' : 'Tạo Banner')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Không thể lưu banner.</strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ $action }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                @isset($record)
                    @method('PUT')
                @endisset

                <div class="mb-3">
                    <label for="title" class="form-label">
                        Tiêu đề
                    </label>

                    <input
                        id="title"
                        type="text"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $record->title ?? '') }}"
                        maxlength="255"
                    >

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="short-description" class="form-label">
                        Mô tả ngắn
                    </label>

                    <textarea
                        id="short-description"
                        name="short_description"
                        rows="4"
                        maxlength="500"
                        class="form-control @error('short_description') is-invalid @enderror"
                    >{{ old('short_description', $record->short_description ?? '') }}</textarea>

                    @error('short_description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="button-url" class="form-label">
                        Đường dẫn button
                    </label>

                    <input
                        id="button-url"
                        type="text"
                        name="button_url"
                        class="form-control @error('button_url') is-invalid @enderror"
                        value="{{ old('button_url', $record->button_url ?? '') }}"
                        placeholder="/products hoặc https://example.com/products"
                        maxlength="255"
                    >

                    @error('button_url')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <small class="form-text text-muted">
                        Có thể nhập đường dẫn nội bộ hoặc URL đầy đủ.
                    </small>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">
                        Ảnh banner
                        @if (!isset($record))
                            <span class="text-danger">*</span>
                        @endif
                    </label>

                    <input
                        id="photo"
                        type="file"
                        name="photo"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="form-control @error('photo') is-invalid @enderror"
                    >

                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <small class="form-text text-muted">
                        Hỗ trợ JPG, PNG, WEBP. Dung lượng tối đa 5MB.
                    </small>

                    @if (isset($record) && $record->photo)
                        <div class="mt-3">
                            <p class="mb-2">Ảnh hiện tại:</p>

                            <img
                                src="{{ asset('storage/banner/' . $record->photo) }}"
                                alt="{{ $record->title ?: 'Banner' }}"
                                style="
                                    width: 100%;
                                    max-width: 500px;
                                    height: 180px;
                                    object-fit: cover;
                                    border-radius: 8px;
                                "
                            >
                        </div>
                    @endif
                </div>

                <div class="mb-4 form-check">
                    <input
                        id="display-at-home-page"
                        type="checkbox"
                        name="display_at_home_page"
                        value="1"
                        class="form-check-input"
                        @checked(old(
                            'display_at_home_page',
                            $record->display_at_home_page ?? false
                        ))
                    >
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($record) ? 'Cập nhật' : 'Tạo banner' }}
                    </button>

                    <a
                        href="{{ route('admin.banner.index') }}"
                        class="btn btn-secondary"
                    >
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection