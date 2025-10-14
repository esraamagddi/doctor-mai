<?php

namespace Solutions\Seo\Providers;

use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'seo');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'seo');

        $this->publishes([
            __DIR__.'/../Resources/lang' => resource_path('lang/vendor/seo'),
        ], 'seo-lang');

        $this->publishes([
            __DIR__.'/../Resources/views' => resource_path('views/vendor/seo'),
        ], 'seo-views');
    }
}
