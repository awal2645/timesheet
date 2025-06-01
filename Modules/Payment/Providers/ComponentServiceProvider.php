<?php

namespace Modules\Payment\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register components
        Blade::component('payment::components.admin-plan-card', \Modules\Payment\View\Components\AdminPlanCard::class);
        Blade::component('payment::components.employer-plan-card', \Modules\Payment\View\Components\EmployerPlanCard::class);
    }
} 