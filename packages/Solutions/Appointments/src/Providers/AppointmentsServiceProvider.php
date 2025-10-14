<?php
namespace Solutions\Appointments\Providers;

use Illuminate\Support\ServiceProvider;

class AppointmentsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $base = __DIR__.'/..';
        $this->loadRoutesFrom($base.'/Routes/web.php');
        $this->loadViewsFrom($base.'/Resources/views', 'appointments');
        $this->loadTranslationsFrom($base.'/Resources/lang', 'appointments');
        $this->loadMigrationsFrom($base.'/Database/migrations');
    }
}
