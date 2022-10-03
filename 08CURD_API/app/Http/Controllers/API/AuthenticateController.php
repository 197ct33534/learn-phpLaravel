<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $checkLogin = Auth::attempt(['email' => $email, 'password' => $password]);
        if ($checkLogin) {
            // $user = Auth::user();
            $token =   $request->user()->createToken('auth_token')->plainTextToken;
            return  [
                'status' => 'success',
                'token' => $token
            ];
        } else {
            return [
                'status' => 'error',
                'error' => 401
            ];
        }
    }
    public function getToken(Request $request)
    {
        // $user = User::find(1);

        // $user->tokens()->delete();
        // $user->tokens()->where('id', 4)->delete();
        $user = $request->user()->currentAccessToken()->delete();
        return  $user;
    }
    public function refreshToken(Request $request)
    {
        $hashToken = $request->header('authorization');
        $hashToken = trim(str_replace('Bearer', ' ', $hashToken));

        $token =  PersonalAccessToken::findToken($hashToken);

        if ($token) {
            $tokenCreatedAt = $token->created_at;
            $expire = Carbon::parse($tokenCreatedAt)->addMinutes(config('sanctum.expiration'));
            if (Carbon::now() >= $expire) {
                $tokenId = $token->id;

                $userId = $token->tokenable_id;

                $user = User::find($userId);
                $user->tokens()->delete();

                $newToken = $user->createToken('auth_token')->plainTextToken;
                $response =  [
                    'status' => 200,
                    'token' => $newToken
                ];
            } else {
                $response =  [
                    'status' => 200,
                    'title' => 'Token còn thời hạn'
                ];
            }
        } else {
            $response =  [
                'status' => 404,
                'title' => 'Token không hợp lệ'
            ];
        }



        return $response;
    }
}
