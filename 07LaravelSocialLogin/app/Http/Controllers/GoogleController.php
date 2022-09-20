<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function loginUsingGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            dd($user);


            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
