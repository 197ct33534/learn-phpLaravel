<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sanpham', [HomeController::class, 'product'])->name('product');
Route::get('/add', [HomeController::class, 'getAdd'])->name('getadd');
Route::post('/add', [HomeController::class, 'postAdd'])->name('postadd');
Route::put('/add', [HomeController::class, 'putAdd'])->name('putadd');
