<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

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

        URL::forceRootUrl(config('app.url'));

        // ROL ADMINISTRADOR 
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // ROL FARMACIA 
        Gate::define('farmacia', function ($user) {
            return $user->role === 'farmacia';
        });

        // ROL RECEPCION 
        Gate::define('recepcion', function ($user) {
            return $user->role === 'recepcion';
        });

        // ROL MEDICO CONSULA EXTERNA
        Gate::define('consultaExternaMedico', function ($user) {
            return $user->role === 'consultaExternaMedico';
        });

        // ROL CENTRAL DE ENFERMERIA CONSULTA EXTERNA
        Gate::define('consultaExternaEnfermeria', function ($user) {
            return $user->role === 'consultaExternaEnfermeria';
        }); 
    }
}
