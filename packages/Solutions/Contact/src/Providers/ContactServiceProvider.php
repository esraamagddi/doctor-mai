<?php

namespace Solutions\Contact\Providers;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'contact');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'contact');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->publishes([__DIR__.'/../Resources/lang' => resource_path('lang/vendor/contact')], 'contact-lang');
        $this->publishes([__DIR__.'/../Resources/views' => resource_path('views/vendor/contact')], 'contact-views');
    }
}
