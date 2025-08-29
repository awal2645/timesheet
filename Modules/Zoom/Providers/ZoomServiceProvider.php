<?php

namespace Modules\Zoom\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ZoomServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Zoom', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        
        // Register commands
        $this->commands([
            \Modules\Zoom\App\Console\Commands\UpdateExpiredMeetings::class,
        ]);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Zoom', 'Config/config.php') => config_path('zoom.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Zoom', 'Config/config.php'), 'zoom'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/zoom');
        $sourcePath = module_path('Zoom', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'zoom-module-views']);

        $this->loadViewsFrom($sourcePath, 'zoom');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/zoom');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'zoom');
        } else {
            $this->loadTranslationsFrom(module_path('Zoom', 'Resources/lang'), 'zoom');
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/zoom')) {
                $paths[] = $path . '/modules/zoom';
            }
        }
        return $paths;
    }
} 