<?php

use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Hash;
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
    $user = DB::table('users')->insert([
        'name' => 'trần trung nghĩa',
        'email' => 'trantrungnghia07122001@gmail.com',
        'password' => Hash::make('123456'),

    ]);
    dd($user);
    return view('welcome');
});
Route::get('chinh-sach-rieng-tu', function () {
    return '<h1>Chính sách riêng tư</h1>';
});

Route::prefix('facebook')->name('facebook.')->group(function () {
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});

Route::prefix('google')->name('google.')->group(function () {
    Route::get('auth', [GoogleController::class, 'loginUsingGoogle'])->name('login');
    Route::get('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});
