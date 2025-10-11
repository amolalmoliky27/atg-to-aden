<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthOrGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
   
    if (auth()->check() || session('guest_mode')) {
        return $next($request);
    }

    return redirect('/')->with('error', 'يجب تسجيل الدخول أو الدخول كزائر');
}
    
}
