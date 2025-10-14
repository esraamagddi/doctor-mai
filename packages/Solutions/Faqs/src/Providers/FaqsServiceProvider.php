<?php
namespace Solutions\Faqs\Providers;

use Illuminate\Support\ServiceProvider;

class FaqsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'faqs');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'faqs');
    }
}
