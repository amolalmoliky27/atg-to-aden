<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        // لا تعيد توجيه أي مستخدم (يترك الجميع يدخلون)
        return $next($request);
    }
}