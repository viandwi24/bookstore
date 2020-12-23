<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Viandwi24\LaravelExtension\Facades\Menu;
use Viandwi24\LaravelExtension\Facades\Hook;

class AppAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadHook();
        $this->prepareAdminSidebar();
        $this->renderAdminSidebar();
        // dd(Hook::getFacadeRoot());
    }

    /**
     * Load System Hook
     * 
     * @return void
     */
    private function loadHook()
    {
        $hooks = [
            'AdminSidebar'
        ];
        HookLoad($hooks, app_path('Hooks'));
    }

    /**
     * Adding Basic Menu to Sidebar
     * 
     * @return void
     */
    private function prepareAdminSidebar()
    {
        $this->app->booted(function () {
            Menu::add('admin.navbar.main', 'Dashboard', route('admin.home'), 'fas fa-th');
            Menu::add('admin.navbar.other', 'Extension', route('admin.extension'), 'fas fa-plug');
        });
    }

    /**
     * Render Admin Sidebar
     * 
     * @return void
     */
    private function renderAdminSidebar() {
        $render = function ($type, $params = []) {
            if ($type == 'header') {
                return '<li class="nav-header">'.@$params['title'].'</li>';
            } else if ($type == 'item') {
                $active = (@$params['url'] == Request::url());
                return '<li class="nav-item">
                  <a href="'.@$params['url'].'" class="nav-link '.($active ? 'active' : '').'">
                    <i class="nav-icon '.@$params['icon'].'"></i>
                    <p>'.@$params['title'].'</p>
                  </a>
                </li>';
            } else {
                return '';
            }
        };
        $this->app->bind('admin.sidebar.render', function () use ($render) {
            $menuOthGroup = Menu::render('admin.navbar.other', function ($title, $url = '', $icon = '') use ($render) {
                $params = Hook::applyFilter('admin.sidebar.render.other', $title, $url, $icon);
                return $render('item', $params);
            });
            $menuMainGroup = Menu::render('admin.navbar.main', function ($title, $url = '', $icon = '') use ($render) {
                $params = Hook::applyFilter('admin.sidebar.render.main', $title, $url, $icon);
                return $render('item', $params);
            });
            $menuExtGroup = Menu::render('admin.navbar', function ($type, $title, $url = '', $icon = '') use ($render) {
                $params = Hook::applyFilter('admin.sidebar.render', $type, $title, $url, $icon);
                return $render($type, $params);
            });
            return [
                'menuOthGroup' => $menuOthGroup,
                'menuMainGroup' => $menuMainGroup,
                'menuExtGroup' => $menuExtGroup
            ];
        });
    }
}
