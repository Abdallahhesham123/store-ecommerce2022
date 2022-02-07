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

define('PAGINATION_COUNT',10);

Route::group(
    [
        'middleware'=>'auth:admin',
        // 'name'=>'admin.'
    ],function () {

        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/trash', [App\Http\Controllers\Admin\AdminController::class, 'usersTrashed'])->name('admin.trash');

        Route::resource('/admin',App\Http\Controllers\Admin\AdminController::class);
        Route::get('/admin/restore/{id}', [App\Http\Controllers\Admin\AdminController::class, 'restore'])->name('admin.restore');
        Route::delete('/admin/hdelete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'hdelete'])->name('admin.hdelete');



        ##################### begin languages

        Route::group(['prefix'=>'Langs'],function () {


            Route::get('/', [App\Http\Controllers\Admin\LangController::class, 'index'])->name('admin.lang');
            Route::get('/create', [App\Http\Controllers\Admin\LangController::class, 'create'])->name('admin.lang.create');
            Route::post('/store', [App\Http\Controllers\Admin\LangController::class, 'store'])->name('admin.lang.store');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\LangController::class, 'edit'])->name('admin.lang.edit');
            Route::PUT('/update/{id}', [App\Http\Controllers\Admin\LangController::class, 'update'])->name('admin.lang.update');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\LangController::class, 'destroy'])->name('admin.lang.destroy');


            });
        ##################### end languages




               ##################### begin Category

               Route::group(['prefix'=>'main_category'],function () {


                Route::get('/', [App\Http\Controllers\Admin\MaincategoryController::class, 'index'])->name('admin.maincat');
                Route::get('/create', [App\Http\Controllers\Admin\MaincategoryController::class, 'create'])->name('admin.maincat.create');
                Route::post('/store', [App\Http\Controllers\Admin\MaincategoryController::class, 'store'])->name('admin.maincat.store');
                Route::get('/edit/{id}', [App\Http\Controllers\Admin\MaincategoryController::class, 'edit'])->name('admin.maincat.edit');
                Route::PUT('/update/{id}', [App\Http\Controllers\Admin\MaincategoryController::class, 'update'])->name('admin.maincat.update');
                Route::delete('/delete/{id}', [App\Http\Controllers\Admin\MaincategoryController::class, 'destroy'])->name('admin.maincat.destroy');


                });
            ##################### end Category


});


// Auth::routes();

Route::group(
    [

        'middleware'=>'guest:admin',

    ],function () {

    Route::get('/login', [App\Http\Controllers\Admin\LoginController::class, 'getlogin'])->name('get.admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');



});