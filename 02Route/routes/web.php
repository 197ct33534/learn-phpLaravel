<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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


// Route::get('/',function(){
//     $html = 'return ra biến nè';
//     return $html;
// });
// Route::get('/',function(){
//     $html = 'nhận cái nào';
//     return $html;
// });
Route::get('/form',function(){
    
    return view('form');
});
// Route::post('/',function(){
    
//     return 'đây là phương thức post';
// });
// Route::put('/',function(){
    
//     return 'đây là phương thức put';
// });
// Route::delete('/',function(){
    
//     return 'đây là phương thức delete';
// });
// Route::patch('/',function(){
    
//     return 'đây là phương thức patch';
// });

// match
// Route::match(['get','post'],'/devnghia',function(){
//     echo "<pre>";
//     print_r($_SERVER);
//     echo "</pre>";
//     return $_SERVER['REQUEST_METHOD'];
// });

// any : chấp nhận tất cả các request
// Route::any('/devnghia',function(Request  $request ){


//     return $request->method();
// });

// redirect :nhận request nhưng sẽ chuyển hướng (đường dẫn chính, đường chuyển hướng, status)
//Route::redirect('devnghia2','form',403);

// Route::view('showform','form');

//prefix
Route::prefix('admin')->group(function() {
    // lưu ý đặt id thì biến phải là id
    // lưu ý nên để tên đúng thứ tự,và cùng tên
    Route::get('tin-tuc/{slug?}-{id?}',function($slug=null,$id=null) {
        $content = 'đây là trang web lập trình '.$slug;
        $content .= ' id= '.$id;
        return  $content;
    // })->where('id', '[0-9]*')->where('slug','[.*]');
    })->where([
        'slug'=> '.*',
        'id'=> '[0-9]+'
    ])->name('admin.tintuc');
    Route::get('nhau',function() {
        return "đây là trang web ăn nhậu";
    })->name('admin.nhau');
    Route::prefix('product')->middleware('CheckPermission')->group(function() {
        Route::get('/',function() {
            return 'đây là trang danh sách sản phẩm';
        });Route::get('add',function() {
            return 'đây là trang  thêm sản phẩm';
        })->name('admin.them');
    });
});
// Route::get('/home',function() {
//     return view('home');
// })->name('home');

Route::get('/newtintuc','HomeController@tintuc')->name('tintuc');

Route::get('/home','App\Http\Controllers\HomeController@index')->name('index');
// khuyến kích dùng cách này
Route::get('/chuyenmuc/{id}',[HomeController::class, 'getCategories']);