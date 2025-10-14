<?php
namespace Solutions\Media\Providers;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'media');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'media');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
    }
}
