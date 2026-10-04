<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreRegionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // quyền đã được chặn bởi middleware của group admin
    }

    protected function prepareForValidation(): void
    {
        // Admin có thể dán cả thẻ <iframe ...> hoặc chỉ dán URL -> chỉ lấy src
        $map = trim((string) $this->input('map_embed_url'));
        if ($map !== '' && preg_match('/src\s*=\s*["\']([^"\']+)["\']/i', $map, $m)) {
            $map = html_entity_decode($m[1]);
        }

        $this->merge([
            'map_embed_url' => $map !== '' ? $map : null,
            'slug'          => Str::slug($this->filled('slug') ? $this->input('slug') : $this->input('name')),
            'sort_order'    => $this->input('sort_order', 0) ?: 0,
            'remove_banner' => $this->boolean('remove_banner'),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required', 'string', 'max:100',
                Rule::unique('store_regions', 'slug')->ignore($this->route('store_region')),
            ],
            'banner_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_banner' => ['boolean'],
            'map_embed_url' => ['nullable', 'url', 'max:2000', 'starts_with:https://www.google.com/maps/embed'],
            'sort_order'    => ['integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'map_embed_url.starts_with' => 'Link bản đồ phải là mã nhúng Google Maps (https://www.google.com/maps/embed...).',
            'slug.unique'               => 'Slug đã tồn tại, vui lòng chọn slug khác.',
        ];
    }
}