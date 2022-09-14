<?php

use App\Http\Controllers\MemeController;
use App\Http\Controllers\ParsingSource\VkController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::resource('memes', MemeController::class)->only('index');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::group(['prefix' => '/parsing-sources', 'as' => 'parsing-source.'], function () {
            Route::resource('vk', VkController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        });
    });
});

require __DIR__ . '/auth.php';
