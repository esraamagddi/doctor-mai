<?php
namespace Solutions\SectionHeaders\Providers;

use Illuminate\Support\ServiceProvider;

class SectionHeadersServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'sectionheaders');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'sectionheaders');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
    }
}
