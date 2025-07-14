<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
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
        Schema::defaultStringLength(191);
        app(Router::class)->aliasMiddleware('auth', \App\Http\Middleware\CustomAdminRedirect::class);
    }
}
