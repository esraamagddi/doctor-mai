<?php

namespace Solutions\AccessControl\Providers;

use Illuminate\Support\ServiceProvider;

class AccessControlServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'acl');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'acl');
    }
        public function register(): void
    {
        //
    }
}
