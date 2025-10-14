<?php
namespace Solutions\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'blog');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'blog');
        $this->publishes([__DIR__ . '/../Resources/sidebar.php' => base_path('resources/solutions/blog/sidebar.php')], 'blog-sidebar');
    }
}