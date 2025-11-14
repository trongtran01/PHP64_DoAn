<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class ManageCustomersController extends Controller
{
    // Hiển thị danh sách khách hàng
    public function index() {
        $customers = Customer::orderBy('id','desc')->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    // Form chỉnh sửa
    public function edit($id) {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.form', compact('customer'));
    }

    // Cập nhật khách hàng
    public function update(Request $request, $id) {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['name','email','phone','address']);
        if($request->filled('password')){
            $data['password'] = $request->password;
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')->with('success', 'Cập nhật thành công.');
    }

    // Xóa khách hàng
    public function destroy($id) {
        Customer::destroy($id);
        return redirect()->route('admin.customers.index')->with('success', 'Xóa thành công.');
    }
}
