<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
   use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

public function boot()
{
    Gate::define('admin', function(User $user) {
        return $user->email === 'amol2@almoliky.com'; // استبدل بالإيميل الخاص بك
    });
}}