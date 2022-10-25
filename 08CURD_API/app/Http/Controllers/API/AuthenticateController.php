<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;

class AuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $checkLogin = Auth::attempt(['email' => $email, 'password' => $password]);
        if ($checkLogin) {
            // $user = Auth::user();
            // $token =   $request->user()->createToken('auth_token')->plainTextToken;
            // $tokenResult = $request->user()->createToken('auth_api');




            // $token = $tokenResult->token;
            // $token->expires_at = Carbon::now()->addMinutes(60);

            // // trả về accesn token
            // $accessToken = $tokenResult->accessToken;
            // $expires = Carbon::parse($token->expires_at)->toDateTimeString();

            // return  [
            //     'status' => 'success',
            //     'token' => $accessToken,
            //     'expire' => $expires,
            // ];

            //refresh token
            $client = Client::where('password_client', 1)->first();
            if ($client) {
                $clientID = $client->id;
                $clientSecret = $client->secret;
                $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                    'username' => $email,
                    'password' => $password,
                    'scope' => '',
                ]);
                return $response;
            }
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
    // public function refreshToken(Request $request)
    // {
    //     $hashToken = $request->header('authorization');
    //     $hashToken = trim(str_replace('Bearer', ' ', $hashToken));

    //     $token =  PersonalAccessToken::findToken($hashToken);

    //     if ($token) {
    //         $tokenCreatedAt = $token->created_at;
    //         $expire = Carbon::parse($tokenCreatedAt)->addMinutes(config('sanctum.expiration'));
    //         if (Carbon::now() >= $expire) {
    //             $tokenId = $token->id;

    //             $userId = $token->tokenable_id;

    //             $user = User::find($userId);
    //             $user->tokens()->delete();

    //             $newToken = $user->createToken('auth_token')->plainTextToken;
    //             $response =  [
    //                 'status' => 200,
    //                 'token' => $newToken
    //             ];
    //         } else {
    //             $response =  [
    //                 'status' => 200,
    //                 'title' => 'Token còn thời hạn'
    //             ];
    //         }
    //     } else {
    //         $response =  [
    //             'status' => 404,
    //             'title' => 'Token không hợp lệ'
    //         ];
    //     }

    //     return $response;
    // }
    public function refreshToken(Request $request)
    {
        $client = Client::where('password_client', 1)->first();
        $refreshToken = $request->input('refreshToken');
        if ($client && $refreshToken) {
            $clientID = $client->id;
            $clientSecret = $client->secret;
            $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' =>  $refreshToken,
                'client_id' => $clientID,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);
            return $response;
        } else {
            return [
                'status' => 'error',
                'error' => 401
            ];
        }
    }
    public function logout()
    {
        $user = Auth::user();
        $status = $user->token()->revoke();
        return [
            'status' => 200,
            'title' => 'logout successful'
        ];
    }
}
