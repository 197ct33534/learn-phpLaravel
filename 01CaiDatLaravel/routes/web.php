<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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

Route::get('/AE', function () {
    return "HELLO ANH EM";
    // return view('home');
});
Route::get('laptrinh',function(){
    
    return "phương thức get của path/laptrinh";
});
Route::get('show', function(){
    return view('form');
});
Route::post('laptrinh',function(){
    return "phương thức POst của path/laptrinh";
});

Route::put('laptrinh',function(){
    return "phương thức put của path/laptrinh";
});