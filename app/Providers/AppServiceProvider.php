<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);

        // ROL ADMINISTRADOR 
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // ROL FARMACIA 
        Gate::define('farmacia', function ($user) {
            return $user->role === 'farmacia';
        });
    }
}
