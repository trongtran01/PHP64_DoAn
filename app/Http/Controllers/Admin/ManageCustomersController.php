<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Rules\PasswordRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageCustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $action = route('admin.customers.update', $customer->id);

        return view('admin.customers.form', compact('customer', 'action'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
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
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        $data = $request->only([
            'name',
            'email',
            'phone',
            'address',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        Customer::destroy($id);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Xóa thành công.');
    }
}