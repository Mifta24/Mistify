<?php

namespace App\Providers;

use App\Services\MidtransService;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register MidtransService
        $this->app->singleton(MidtransService::class, function ($app) {
            return new MidtransService();
        });

        // Register OrderService
        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService();
        });
    }

    public function boot(): void
    {
        //
    }
}
