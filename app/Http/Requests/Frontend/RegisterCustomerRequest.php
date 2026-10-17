<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterCustomerRequest extends FormRequest
{
    // Giữ nguyên error bag 'register' để Blade hiện lỗi như cũ
    protected $errorBag = 'register';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'province_code' => ['required', 'integer', 'exists:provinces,code'],
            'ward_code' => [
                'required',
                'integer',
                // Phường/xã phải thuộc đúng tỉnh đã chọn
                Rule::exists('wards', 'code')
                    ->where('province_code', $this->input('province_code')),
            ],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'name.max' => 'Họ và tên không được vượt quá 100 ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',

            'province_code.required' => 'Vui lòng chọn Tỉnh / Thành phố.',
            'province_code.exists' => 'Tỉnh / Thành phố không hợp lệ.',

            'ward_code.required' => 'Vui lòng chọn Phường / Xã.',
            'ward_code.exists' => 'Phường / Xã không thuộc Tỉnh / Thành phố đã chọn.',

            'address.required' => 'Vui lòng nhập số nhà, tên đường.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ];
    }
}