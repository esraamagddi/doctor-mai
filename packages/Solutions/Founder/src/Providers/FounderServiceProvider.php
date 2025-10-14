<?php

namespace Solutions\Founder\Providers;

use Illuminate\Support\ServiceProvider;

class FounderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'founder');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'founder');
    }

    public function register(): void
    {
        //
    }
}
