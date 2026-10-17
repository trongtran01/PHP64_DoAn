<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Province;
use App\Rules\PasswordRules;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;

class ManageCustomersController extends Controller
{
    public function index(): View
    {
        $customers = Customer::with(['province', 'ward'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function edit($id): View
    {
        $customer = Customer::findOrFail($id);
        $action = route('admin.customers.update', $customer->id);
        $provinces = Province::orderBy('name')->get(['code', 'name']);

        return view('admin.customers.form', compact('customer', 'action', 'provinces'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'unique:customers,email,' . $customer->id,
            ],
            'password' => [
                'nullable',
                'confirmed',
                PasswordRules::strong(),
            ],
            'phone' => ['nullable', 'string', 'max:50'],
            'province_code' => ['required', 'integer', 'exists:provinces,code'],
            'ward_code' => [
                'required',
                'integer',
                Rule::exists('wards', 'code')
                    ->where('province_code', $request->input('province_code')),
            ],
            'address' => ['required', 'string', 'max:255'],
        ], [
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'province_code.required' => 'Vui lòng chọn Tỉnh / Thành phố.',
            'province_code.exists' => 'Tỉnh / Thành phố không hợp lệ.',
            'ward_code.required' => 'Vui lòng chọn Phường / Xã.',
            'ward_code.exists' => 'Phường / Xã không thuộc Tỉnh / Thành phố đã chọn.',
            'address.required' => 'Vui lòng nhập số nhà, tên đường.',
        ]);

        $data = Arr::except($validated, ['password']);

        if (filled($validated['password'] ?? null)) {
            $data['password'] = $validated['password'];
        }

        $customer->update($data);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id): RedirectResponse
    {
        Customer::destroy($id);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Xóa thành công.');
    }
}