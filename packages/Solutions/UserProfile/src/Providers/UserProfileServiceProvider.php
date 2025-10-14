<?php

namespace Solutions\UserProfile\Providers;

use Illuminate\Support\ServiceProvider;

class UserProfileServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'userprofile');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'userprofile');
    }
}