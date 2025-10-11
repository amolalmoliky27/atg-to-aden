<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccess
{
    public function handle(Request $request, Closure $next)
    {
        // إذا كان مسجل دخول أو زائر، اتركه يتابع
        if (Auth::check() || session('guest_mode')) {
            return $next($request);
        }

        // إذا لم يسجل دخول ولم يدخل كزائر، أحوله للصفحة الترحيبية
        return redirect()->route('welcome');
    }
}