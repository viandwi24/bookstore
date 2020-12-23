<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    // extension management
    Route::get('/extension', [\App\Http\Controllers\Admin\ExtensionController::class, 'index'])->name('extension');
    Route::get('/extension/update', [\App\Http\Controllers\Admin\ExtensionController::class, 'update'])->name('extension.update');
    Route::get('/extension/enable/{name}', [\App\Http\Controllers\Admin\ExtensionController::class, 'enable'])->name('extension.enable');
    Route::get('/extension/disable/{name}', [\App\Http\Controllers\Admin\ExtensionController::class, 'disable'])->name('extension.disable');
    Route::get('/extension/inspect/{name}', [\App\Http\Controllers\Admin\ExtensionController::class, 'inspect'])->name('extension.inspect');
});

