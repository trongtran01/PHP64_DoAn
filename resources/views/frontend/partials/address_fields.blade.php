<div class="address-row"
    data-address-select
    data-wards-url="{{ route('locations.wards', ['province' => '__CODE__']) }}">

    <div class="input-group">
        <select name="province_code" data-province-select aria-label="Tỉnh / Thành phố"
            class="@error('province_code', 'register') input-error @enderror">
            <option value="">Tỉnh / Thành phố</option>

            @foreach ($provinces as $province)
                <option value="{{ $province->code }}"
                    @selected((string) old('province_code') === (string) $province->code)>
                    {{ $province->name }}
                </option>
            @endforeach
        </select>

        @error('province_code', 'register')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="input-group">
        <select name="ward_code" data-ward-select data-old="{{ old('ward_code') }}" disabled
            aria-label="Phường / Xã"
            class="@error('ward_code', 'register') input-error @enderror">
            <option value="">Phường / Xã</option>
        </select>

        @error('ward_code', 'register')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>
</div>