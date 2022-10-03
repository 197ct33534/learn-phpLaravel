<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
