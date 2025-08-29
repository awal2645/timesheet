<?php

namespace Modules\Newsletter\App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class NewsletterServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path('Newsletter', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Modules\Newsletter\App\Providers\RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Newsletter', 'Config/config.php') => config_path('newsletter.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Newsletter', 'Config/config.php'), 'newsletter'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/newsletter');
        $sourcePath = module_path('Newsletter', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'newsletter-module-views']);

        $this->loadViewsFrom($sourcePath, 'newsletter');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/newsletter');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'newsletter');
        } else {
            $this->loadTranslationsFrom(module_path('Newsletter', 'Resources/lang'), 'newsletter');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
