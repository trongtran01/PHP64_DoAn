<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function login()
    {
        return view('frontend.form_customers_login');
    }

    public function loginPost(Request $request)
    {
        $validated = $request->validateWithBag('login', [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $customer = DB::table('customers')
            ->where('email', $validated['email'])
            ->first();

        if (!$customer || !Hash::check($validated['password'], $customer->password)) {
            return back()
                ->withErrors([
                    'credentials' => 'Email hoặc mật khẩu không chính xác.',
                ], 'login')
                ->onlyInput('email');
        }

        // Đổi session ID sau khi đăng nhập thành công
        // để hạn chế session fixation.
        $request->session()->regenerate();

        $request->session()->put([
            'customer_id' => $customer->id,
            'customer_email' => $customer->email,
            'customer_name' => $customer->name,
        ]);

        return redirect('/')
            ->with('success', 'Đăng nhập thành công.');
    }

    public function register()
    {
        return view('frontend.form_customers_login');
    }

    public function registerPost(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:100'],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:customers,email',
                ],
                'address' => ['nullable', 'string', 'max:255'],
                'phone' => ['nullable', 'string', 'max:20'],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                ],
            ],
            [
                'name.required' => 'Vui lòng nhập họ và tên.',
                'name.max' => 'Họ và tên không được vượt quá 100 ký tự.',

                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'email.unique' => 'Email này đã được sử dụng.',

                'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
                'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'register')
                ->withInput()
                ->with('active_form', 'register');
        }

        $validated = $validator->validated();

        DB::table('customers')->insert([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect('customers/login')
            ->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'customer_id',
            'customer_email',
            'customer_name',
        ]);

        $request->session()->regenerate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}