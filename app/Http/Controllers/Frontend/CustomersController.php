<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Frontend\RegisterCustomerRequest;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Contracts\View\View;

class CustomersController extends Controller
{
    public function login(): View
    {
        return $this->authForm();
    }

    public function register(): View
    {
        return $this->authForm();
    }

    public function registerPost(RegisterCustomerRequest $request)
    {
        // Mutator trong model Customer tự hash password, không Hash::make thêm
        Customer::create($request->validated());

        return redirect('customers/login')
            ->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    private function authForm(): View
    {
        return view('frontend.form_customers_login', [
            'provinces' => Province::orderBy('name')->get(['code', 'name']),
        ]);
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