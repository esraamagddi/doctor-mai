<?php
namespace Solutions\Pages\Providers;

use Illuminate\Support\ServiceProvider;

class PagesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'pages');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'pages');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
    }
}
