<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    public function boot()
    {

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
                
            // إضافة هذا لمنع إعادة التوجيه التلقائي
            if (request()->is('login') && auth()->check()) {
            return redirect()->route('home');
            }
            Route::middleware('api')->prefix('api')->group(base_path('routes/api.php'));
        });}};
