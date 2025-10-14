<?php

namespace Solutions\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class UsersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'users');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'users');
        $this->publishes([__DIR__.'/../Resources/sidebar.php' => base_path('packages/Solutions/Users/sidebar.php')], 'users');
    }
}
