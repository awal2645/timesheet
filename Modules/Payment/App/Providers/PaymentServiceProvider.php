<?php

namespace Modules\Payment\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Payment\App\Services\PaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PaymentService::class, function ($app) {
            return new PaymentService();
        });
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../Resources/views', 'payment');
    }
} 