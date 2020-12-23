<?php

use Viandwi24\LaravelExtension\Facades\Hook;

Hook::addFilter('system', 'admin.sidebar.render.other', function ($title, $url, $icon) {
    return compact('title', 'url', 'icon');
}, SYSTEM_PRIORITY);
Hook::addFilter('system', 'admin.sidebar.render.main', function ($title, $url, $icon) {
    return compact('title', 'url', 'icon');
}, SYSTEM_PRIORITY);
Hook::addFilter('system', 'admin.sidebar.render', function ($type, $title, $url, $icon) {
    return compact('type', 'title', 'url', 'icon');
}, SYSTEM_PRIORITY);