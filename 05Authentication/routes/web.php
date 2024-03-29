<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Doctor\Auth\LoginController;
use App\Http\Controllers\Doctor\IndexController;
use App\Http\Controllers\Doctor\Auth\ForgotPasswordController;
use App\Http\Controllers\Doctor\Auth\ResetPasswordController;
use App\Http\Controllers\PostController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [AdminController::class, 'index']);

    // post Route
    Route::prefix('/posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        // Route::get('/add', [PostController::class, 'add']);
        Route::get('/edit/{post}', [PostController::class, 'edit']);
        // Nếu muốn kiểm tra quyền bằng Middleware, sử dụng cú pháp sau:
        // Route::get('/add', [PostController::class, 'add'])->middleware('can:posts.add');
        // hoặc bạn dùng thông qua phương thức can() với cú pháp sau:
        Route::get('/add', [PostController::class, 'add'])->can('posts.add');

        // Route::get('/edit/{post}', [PostController::class, 'edit'])->middleware('can:posts.edit,post');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->can('posts.edit', 'post');
        Route::get('/detail/{post}', [PostController::class, 'detail']);
    });
});
// Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');
Route::get('routes', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});
// The Email Verification Notice
// Link thông báo verify khi người dùng đăng ký tài khoản , chưa xác thực email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Handler email verifi
// liên kết sẽ gửi email của người đăng kí
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
// resend
// xử lý hành động gửi lại email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


//Doctor Route
Route::prefix('doctors')->name('doctors.')->group(function () {
    // kiểm tra đăng nhập hay chưa auth:doctor
    Route::get('', [IndexController::class, 'index'])->middleware('auth:doctor')->name('index');
    // kt khách hàng chưa đăng nhập với guard cụ thể
    Route::get('login', [LoginController::class, 'login'])->middleware('guest:doctor')->name('login');
    Route::post('login', [LoginController::class, 'postLogin'])->name('postLogin');
    // phương thức get cho logout
    // Route::get('logout', function () {
    //     Auth::guard('doctor')->logout();
    //     return redirect()->route('doctors.login');
    // });

    Route::post('logout', function () {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctors.login');
    })->name('logout');
    Route::get('forgot-password', [ForgotPasswordController::class, 'getForgotPassword'])->middleware('guest:doctor')->name('forgotPassword');

    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest:doctor')->name('POSTforgotPassword');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('postResetPassword');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('resetPassword');
});
