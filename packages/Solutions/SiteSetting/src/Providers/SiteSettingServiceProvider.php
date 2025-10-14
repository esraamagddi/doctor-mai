<?php

namespace Solutions\SiteSetting\Providers;

use Illuminate\Support\ServiceProvider;

class SiteSettingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $base = __DIR__ . '/..';

        // Routes
        $this->loadRoutesFrom($base . '/Routes/web.php');

        // Views
        $this->loadViewsFrom($base . '/Resources/views', 'sitesetting');

        // Translations
        $this->loadTranslationsFrom($base . '/Resources/lang', 'sitesetting');

        // Migrations
        $this->loadMigrationsFrom($base . '/Database/migrations');
    }
}
