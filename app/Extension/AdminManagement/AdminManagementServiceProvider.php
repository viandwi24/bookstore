<?php

namespace Extension\AdminManagement;

use Viandwi24\LaravelExtension\Facades\Hook;
use Viandwi24\LaravelExtension\Support\ServiceProvider;
use Viandwi24\LaravelExtension\Facades\Menu;
use Viandwi24\LaravelExtension\Facades\Extension;

class AdminManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // load routes
        $this->loadRoutesFrom("{$this->path}/routes/web.php");

        // load views
        $this->loadViewsFrom("{$this->path}/views", 'AdminManagement');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            // add menu to admin sidebar
            Menu::add('admin.navbar', 'header', 'Management');
            Menu::add('admin.navbar', 'item', 'Product', route('admin.management.product.index'), 'fas fa-square');
        });

        // Add Hook
        $hooks = [
            'AdminProduct'
        ];
        HookLoad($hooks, "{$this->path}/hooks", ['ext' => $this]);
    }
}