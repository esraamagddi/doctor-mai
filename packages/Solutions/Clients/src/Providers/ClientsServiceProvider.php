<?php
namespace Solutions\Clients\Providers;

use Illuminate\Support\ServiceProvider;

class ClientsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $base = __DIR__.'/..';
        $this->loadRoutesFrom($base.'/Routes/web.php');
        $this->loadViewsFrom($base.'/Resources/views', 'clients');
        $this->loadTranslationsFrom($base.'/Resources/lang', 'clients');
        $this->loadMigrationsFrom($base.'/Database/migrations');
    }
}
