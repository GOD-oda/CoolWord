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

/**
 * Admin
 */
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('cool_words')->name('cool_words.')->group(function () {
        Route::get('/', \App\Http\Controllers\Web\CoolWord\Admin\IndexController::class)->name('index');
        Route::get('/new', \App\Http\Controllers\Web\CoolWord\Admin\NewController::class)->name('new');
        Route::post('/create', \App\Http\Controllers\Web\CoolWord\Admin\CreateController::class)->name('create');
        Route::get('/{id}', \App\Http\Controllers\Web\CoolWord\Admin\EditController::class)->name('show');
        Route::put('/{id}', \App\Http\Controllers\Web\CoolWord\Admin\UpdateController::class)->name('update');
    });
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::controller(\App\Http\Controllers\LoginController::class)->group(function () {
        Route::get('/login', 'show')->name('login-show');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(\App\Http\Controllers\RegisterController::class)->group(function () {
        Route::get('/register', 'show')->name('register-show');
        Route::post('/register', 'register')->name('register');
    });
});


/**
 * Public
 */
Route::prefix('cool_word')->name('cool_word.')->group(function () {
    Route::get('/', \App\Http\Controllers\Web\CoolWord\Public\IndexController::class)->name('index');
    Route::get('/{id}', \App\Http\Controllers\Web\CoolWord\Public\ShowController::class)->name('show');
});


