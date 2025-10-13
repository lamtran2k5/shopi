<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;



class Authenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem user đã login chưa
        if (!session()->has('user_id')) {
            // Chưa login → redirect về trang login
            return redirect()->route('login.form');
        }

        // Đã login → cho request đi tiếp
        return $next($request);
    }
}
