<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
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

// client routes

Route::prefix('category')->group(function (){
    Route::get('/',[CategoriesController::class,'index'])->name('categories.list');
    // lấy chi tiết 1 chuyên mục show form sửa chuyên mục
    Route::get('/edit/{id}',[CategoriesController::class,'getCategory'])->name('categories.edit');
    // post update giữ liệu
    Route::post('/edit/{id}',[CategoriesController::class,'updateCategory']);
    Route::get('/add',[CategoriesController::class,'showCategory'])->name('categories.add');
    Route::post('/add',[CategoriesController::class,'handleAddCategory']);
    Route::delete('/delete',[CategoriesController::class,'deleteCategory'])->name('categories.delete');

});

Route::middleware('auth.admin')->prefix('admin')->group(function(){
    Route::get('/',[DashboardController::class,'index']);
    Route::middleware('auth.admin.products')->resource('products',ProductsController::class);

});
Route::get('error', function (){
    return '<h1>lỗi rồi</h1>';
})->name('error');

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/sanpham/{id}',[HomeController::class,'getProductDetail']);
