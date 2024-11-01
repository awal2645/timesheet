<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Dashboard\TimeReportRepository;
use App\Repositories\Dashboard\EarningRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TimeReportRepository::class, function ($app) {
            return new TimeReportRepository();
        });

        $this->app->singleton(EarningRepository::class, function ($app) {
            return new EarningRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
