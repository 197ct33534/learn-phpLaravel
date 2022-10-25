<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthenticateController;
use App\Models\User;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', [AuthenticateController::class, 'logout'])->middleware('auth:api');
Route::post('/login', [AuthenticateController::class, 'login']);
Route::prefix('users')->name('users.')->middleware('auth:api')->group(function () {

    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'detail']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::patch('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});

Route::apiResource('products', ProductController::class);
Route::get('/token', [AuthenticateController::class, 'getToken'])->middleware('auth:sanctum');
Route::post('/refresh-token', [AuthenticateController::class, 'refreshToken']);
Route::get('/passport', function () {
    $user  = User::find(1);
    $tokenResult = $user->createToken('auth_api');
    // dd($tokenResult);
    // thiet lap expired
    $token = $tokenResult->token;
    $token->expires_at = Carbon::now()->addMinutes(60);
    // dd($tokenResult);
    // access token
    $accessToken = $tokenResult->accessToken;

    //lấy token expired
    $expires = Carbon::parse($token->expires_at)->toDateTimeString();
    $respone = [
        'access_token' => $accessToken,
        'expires' => $expires
    ];
    return   $respone;
});
