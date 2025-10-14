<?php

namespace Solutions\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Solutions\Core\Support\SidebarCollector;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'core');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'core');
        $this->loadPermissionsFromPackages();
        $this->loadSidebarsFromPackages();
        $this->publishPackageAssets();
        $this->app->singleton('sidebar-collector', function () {
            return new \Solutions\Core\Support\SidebarCollector();
        });
            $this->app->singleton('core.permissions.collector', function () {
        return new \Solutions\Core\Support\PermissionsCollector;
    });
        // Register your bindings or config here
    }

    public function boot()
    {
        // Boot any services or publishing here
    }

    protected function loadSidebarsFromPackages()
    {
        $basePath = base_path('packages/Solutions');


        $packages = scandir($basePath);

        foreach ($packages as $package) {
            if ($package === '.' || $package === '..')
                continue;

            $sidebarPath = $basePath . '/' . $package . '/src/Resources/sidebar.php';
            if (file_exists($sidebarPath)) {
                SidebarCollector::add($sidebarPath);
            }
        }
    }
    protected function publishPackageAssets()
{
    $basePath = base_path('packages/Solutions');

    if (!is_dir($basePath)) {
        return;
    }

    $packages = scandir($basePath);

    foreach ($packages as $package) {
        if ($package === '.' || $package === '..') {
            continue;
        }

        $packagePath = $basePath . '/' . $package;
        $publicPath = $packagePath . '/public';

        if (is_dir($publicPath)) {
            $this->publishes([
                $publicPath => public_path("vendor/" . strtolower($package)),
            ], 'auto-assets');
        }
    }
}

   protected function loadPermissionsFromPackages()
{
        $basePath = base_path('packages/Solutions');
    $packages = scandir($basePath);


    foreach ($packages as $package) {
        if ($package === '.' || $package === '..') {
            continue;
        }

        $permissionsFile = $basePath . '/' . $package . '/src/Resources/permissions.php';

        if (file_exists($permissionsFile)) {
            $packagePermissions = require $permissionsFile;

            if (is_array($packagePermissions)) {
                \Solutions\Core\Support\PermissionsCollector::add($packagePermissions);
            }
        }
    }
}

}
