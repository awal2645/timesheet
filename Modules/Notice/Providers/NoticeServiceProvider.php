<?php

namespace Modules\Notice\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Notice\App\Observers\NoticeObserver;
use Modules\Notice\App\Models\Notice;
use Modules\Notice\App\Console\Commands\UpdateExpiredNotices;
use Illuminate\Console\Scheduling\Schedule;

class NoticeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->commands([
            UpdateExpiredNotices::class,
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Notice::observe(NoticeObserver::class);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('notices:update-expired')->daily();
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Notice', 'Config/config.php') => config_path('notice.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Notice', 'Config/config.php'), 'notice'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/notice');
        $sourcePath = module_path('Notice', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'notice-module-views']);

        $this->loadViewsFrom($sourcePath, 'notice');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/notice');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'notice');
        } else {
            $this->loadTranslationsFrom(module_path('Notice', 'Resources/lang'), 'notice');
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