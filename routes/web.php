<?php

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

    Route::group(['middleware' => ['role:admin']], function () {
        Route::group(['prefix' => '/parsing-sources', 'as' => 'source'], function () {
            Route::resource('vk', VkController::class)->only(['create', 'store']);
        });
    });
});

require __DIR__ . '/auth.php';
