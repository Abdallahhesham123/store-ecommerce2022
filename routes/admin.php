<?php

use Illuminate\Support\Facades\Auth;
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



Route::group(
    [
        'middleware'=>'auth:admin',
        // 'name'=>'admin.'
    ],function () {

        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

});


// Auth::routes();

Route::group(
    [

        'middleware'=>'guest:admin',

    ],function () {

    Route::get('/login', [App\Http\Controllers\Admin\LoginController::class, 'getlogin'])->name('get.admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');