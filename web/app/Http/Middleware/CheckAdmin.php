<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is admin
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user && $user->isAdmin()) {
            return $next($request);
        }
        // Redirect to home with error message
        abort(403, 'Bạn không có quyền truy cập trang này.');
    }
}
