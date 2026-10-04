<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $map = trim((string) $this->input('map_embed_url'));
        if ($map !== '' && preg_match('/src\s*=\s*["\']([^"\']+)["\']/i', $map, $m)) {
            $map = html_entity_decode($m[1]);
        }

        $this->merge([
            'map_embed_url' => $map !== '' ? $map : null,
            'sort_order'    => $this->input('sort_order', 0) ?: 0,
        ]);
    }

    public function rules(): array
    {
        return [
            'store_region_id' => ['required', 'exists:store_regions,id'],
            'ward'    => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'name'            => ['required', 'string', 'max:255'],
            'phone'           => ['nullable', 'string', 'max:50'],
            'opening_hours'   => ['nullable', 'string', 'max:50'],
            'note'            => ['nullable', 'string', 'max:255'],
            'sort_order'      => ['integer', 'min:0'],
            'map_embed_url' => ['nullable', 'url', 'max:2000', 'starts_with:https://www.google.com/maps/embed'],
        ];
    }

    public function messages(): array
    {
        return [
            'map_embed_url.starts_with' => 'Link bản đồ phải là mã nhúng Google Maps (https://www.google.com/maps/embed...).',
        ];
    }
}