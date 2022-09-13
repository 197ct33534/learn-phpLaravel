<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use  App\Http\Controllers\Admin\GroupsController;
use  App\Http\Controllers\Admin\PostsController;
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
    // users rotue
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [UsersController::class, 'index'])->name('index');
        Route::get('add', [UsersController::class, 'add'])->name('add');
        Route::post('add', [UsersController::class, 'postAdd'])->name('postAdd');
        Route::get('edit/{user}', [UsersController::class, 'edit'])->name('edit');
        Route::post('edit/{user}', [UsersController::class, 'postEdit'])->name('postedit');
        Route::get('delete/{user}', [UsersController::class, 'delete'])->name('delete');
    });

    // group user
    Route::prefix('groups')->name('groups.')->group(function () {
        Route::get('', [GroupsController::class, 'index'])->name('index');
        Route::get('add', [GroupsController::class, 'add'])->name('add');
        Route::post('add', [GroupsController::class, 'postAdd'])->name('postAdd');
        Route::get('edit/{group}', [GroupsController::class, 'edit'])->name('edit');
        Route::post('edit/{group}', [GroupsController::class, 'postEdit'])->name('postedit');
        Route::get('delete/{group}', [GroupsController::class, 'delete'])->name('delete');

        Route::get('permissions/{group}', [GroupsController::class, 'permissions'])->name('permissions');
        Route::post('permissions/{group}', [GroupsController::class, 'postPermissions']);
    });

    // post route
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('', [PostsController::class, 'index'])->name('index');
        Route::get('add', [PostsController::class, 'add'])->name('add');
        Route::post('add', [PostsController::class, 'postAdd'])->name('postAdd');
        Route::get('edit/{post}', [PostsController::class, 'edit'])->name('edit');
        Route::post('edit/{post}', [PostsController::class, 'postEdit'])->name('postedit');
        Route::get('delete/{post}', [PostsController::class, 'delete'])->name('delete');
    });
});
