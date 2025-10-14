<?php

namespace Solutions\AboutUs\Providers;

use Illuminate\Support\ServiceProvider;

class AboutUsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'aboutus');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'aboutus');
    }

    public function register(): void
    {
        //
    }
}
