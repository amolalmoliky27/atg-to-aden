<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {if(!Auth::check()){
        abort(403,'لايمكنك الدخول هنا');

    }
    if(Auth::user()->is_admin != 1){
        abort(403, 'هذه صفحة للمشرفين فقط ');
    }
        return $next($request);
    }
}
