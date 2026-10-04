@extends('admin.layouts.admin')

@section('title', isset($record) ? 'Cập nhật địa chỉ' : 'Thêm địa chỉ')
@section('page-title', isset($record) ? 'Cập nhật địa chỉ' : 'Thêm địa chỉ')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Không thể lưu địa chỉ.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $action }}" method="POST">
                @csrf
                @isset($record)
                    @method('PUT')
                @endisset

                <div class="mb-3">
                    <label for="store_region_id" class="form-label">Khu vực <span class="text-danger">*</span></label>
                    <select id="store_region_id" name="store_region_id"
                        class="form-select @error('store_region_id') is-invalid @enderror">
                        <option value="">-- Chọn khu vực --</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}"
                                @selected((string) old('store_region_id', $selectedRegionId ?? '') === (string) $region->id)>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('store_region_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Tên<span class="text-danger">*</span></label>
                    <input id="name" type="text" name="name" maxlength="255"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $record->name ?? '') }}"
                        >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ward" class="form-label">Phường</label>
                    <input id="ward" type="text" name="ward" maxlength="255"
                        class="form-control @error('ward') is-invalid @enderror"
                        value="{{ old('ward', $record->ward ?? '') }}"
                        >
                    @error('ward')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input id="address" type="text" name="address" maxlength="255"
                        class="form-control @error('address') is-invalid @enderror"
                        value="{{ old('address', $record->address ?? '') }}"
                        >
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label">Ghi chú</label>
                    <input id="note" type="text" name="note" maxlength="255"
                        class="form-control @error('note') is-invalid @enderror"
                        value="{{ old('note', $record->note ?? '') }}">
                    @error('note')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Để trống nếu không có.</small>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input id="phone" type="text" name="phone" maxlength="50"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $record->phone ?? '') }}"
                        >
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="opening_hours" class="form-label">Giờ mở cửa</label>
                    <input id="opening_hours" type="text" name="opening_hours" maxlength="50"
                        class="form-control @error('opening_hours') is-invalid @enderror"
                        value="{{ old('opening_hours', $record->opening_hours ?? '') }}"
                        >
                    @error('opening_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="map_embed_url" class="form-label">Bản đồ Google Maps của địa chỉ này</label>
                    <textarea id="map_embed_url" name="map_embed_url" rows="4"
                        class="form-control @error('map_embed_url') is-invalid @enderror">{{ old('map_embed_url', $record->map_embed_url ?? '') }}</textarea>
                    @error('map_embed_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Google Maps &rarr; Chia sẻ &rarr; Nhúng bản đồ &rarr; Sao chép HTML. Để trống sẽ dùng bản đồ của khu vực.
                    </small>
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
                        {{ isset($record) ? 'Cập nhật' : 'Thêm địa chỉ' }}
                    </button>
                    <a href="{{ route('admin.stores.index', isset($record) ? ['region_id' => $record->store_region_id] : []) }}"
                       class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection