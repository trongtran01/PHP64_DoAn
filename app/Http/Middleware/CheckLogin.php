<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
    // Kiểm tra session admin_email có tồn tại không, nếu không tồn tại thì quay đến trang login
    if (!Auth::check() || Auth::user()->email == "") 
        {
            return redirect(url('backend/login'));
        }
        return $next($request);
    }
}