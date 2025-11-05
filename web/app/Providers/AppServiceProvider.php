<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
 public function register()
{
    if ($this->app->runningInConsole()) {
        $this->app->register(\Laravel\Breeze\BreezeServiceProvider::class);
    }
}

    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
