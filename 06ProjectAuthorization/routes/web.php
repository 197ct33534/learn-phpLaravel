<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use  App\Http\Controllers\Admin\GroupsController;
use  App\Http\Controllers\Admin\PostsController;
use App\Models\Posts;
use App\Models\User;
use App\Models\Groups;

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
    Route::prefix('users')->middleware('can:users')->name('users.')->group(function () {
        Route::get('', [UsersController::class, 'index'])->name('index');
        Route::get('add', [UsersController::class, 'add'])->name('add')->can('create', User::class);
        Route::post('add', [UsersController::class, 'postAdd'])->name('postAdd')->can('create', User::class);
        Route::get('edit/{user}', [UsersController::class, 'edit'])->name('edit')->can('users.edit');
        Route::post('edit/{user}', [UsersController::class, 'postEdit'])->name('postedit')->can('users.edit');
        Route::get('delete/{user}', [UsersController::class, 'delete'])->name('delete')->can('users.delete');
    });

    // group user
    Route::prefix('groups')->middleware('can:groups')->name('groups.')->group(function () {
        Route::get('', [GroupsController::class, 'index'])->name('index');
        Route::get('add', [GroupsController::class, 'add'])->name('add')->can('create', Groups::class);
        Route::post('add', [GroupsController::class, 'postAdd'])->name('postAdd')->can('create', Groups::class);
        Route::get('edit/{group}', [GroupsController::class, 'edit'])->name('edit')->can('groups.edit');
        Route::post('edit/{group}', [GroupsController::class, 'postEdit'])->name('postedit')->can('groups.edit');
        Route::get('delete/{group}', [GroupsController::class, 'delete'])->name('delete')->can('groups.delete');

        Route::get('permissions/{group}', [GroupsController::class, 'permissions'])->name('permissions')->can('groups.permission');
        Route::post('permissions/{group}', [GroupsController::class, 'postPermissions'])->can('groups.permission');
    });

    // post route
    Route::prefix('posts')->middleware('can:posts')->name('posts.')->group(function () {
        Route::get('', [PostsController::class, 'index'])->name('index');
        Route::get('add', [PostsController::class, 'add'])->name('add')->can('create', Posts::class);
        Route::post('add', [PostsController::class, 'postAdd'])->name('postAdd')->can('create', Posts::class);
        Route::get('edit/{post}', [PostsController::class, 'edit'])->name('edit')->can('posts.edit');
        Route::post('edit/{post}', [PostsController::class, 'postEdit'])->name('postedit')->can('posts.edit');
        Route::get('delete/{post}', [PostsController::class, 'delete'])->name('delete')->can('posts.delete');
    });
});
