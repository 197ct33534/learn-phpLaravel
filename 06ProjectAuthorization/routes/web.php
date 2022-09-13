<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
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

Auth::routes(['register' => false]);


// admin route

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('index');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [UsersController::class, 'index'])->name('index');
        Route::get('add', [UsersController::class, 'add'])->name('add');
        Route::post('add', [UsersController::class, 'postAdd'])->name('postAdd');
    });
});
