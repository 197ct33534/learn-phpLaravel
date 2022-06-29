<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
Route::get('/demo-response', function (){
    // $content = json_encode([
    //     'item1',
    //     'item2',
    //     'item3',
    // ]);
    // $res = (new Response($content,201))->header("Content-Type","application/json");
    // $res = new Response();
    // $res = response();

    $res = (new Response())->cookie("devnghia","nghĩa đang học laravel với cookie 30 phút",30);
    return $res;
});

Route::get('/demo-response-2', function (Request $request){
    return $request->cookie("devnghia");
});
Route::get('/demo-response-3', function (){
    $res = response()->view('demoRes',[
        'title'=>"nghĩa nè"
    ])->header('Content-Type', 'application/json')->header('API-key',123456);
    return $res;

});
