<?php

namespace Solutions\Transformation\Providers;

use Illuminate\Support\ServiceProvider;

class TransformationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'transformation');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'transformation');
    }

    public function register(): void
    {
        //
    }
}
