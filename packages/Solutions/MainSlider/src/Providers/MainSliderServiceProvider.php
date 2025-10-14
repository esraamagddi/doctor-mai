<?php
namespace Solutions\MainSlider\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Solutions\Core\Facades\SidebarCollector;

class MainSliderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'main_slider');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'main_slider');
    }

    public function register(): void
    {
    }
}
