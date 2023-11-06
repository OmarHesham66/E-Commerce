<?php

namespace App\Providers;

use App\Repository\Cart\IRepositoryCart;
use App\Repository\Cart\ModelCart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(IRepositoryCart::class, ModelCart::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
