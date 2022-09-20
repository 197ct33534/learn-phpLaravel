<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function loginUsingGoogle()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            echo $user->getId() . '<br/>';
            echo $user->getNickname() . '<br/>';
            echo $user->getName() . '<br/>>';
            echo $user->getEmail() . '<br/>';
            echo $user->getAvatar() . '<br/>';


            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
