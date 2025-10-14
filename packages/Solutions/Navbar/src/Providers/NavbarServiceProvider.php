<?php
namespace Solutions\Navbar\Providers;

use Illuminate\Support\ServiceProvider;

class NavbarServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'navbar');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'navbar');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
    }
}
