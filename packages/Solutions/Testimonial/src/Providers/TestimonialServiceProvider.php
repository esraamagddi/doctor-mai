<?php
namespace Solutions\Testimonial\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Solutions\Core\Facades\SidebarCollector;

class TestimonialServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'testimonial');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'testimonial');
    }

    public function register(): void
    {
        //
    }
}
