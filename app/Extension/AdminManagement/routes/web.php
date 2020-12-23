<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::resource('/management/product', Extension\AdminManagement\Controllers\ProductController::class, ['as' => 'management'])->except(['show']);
});