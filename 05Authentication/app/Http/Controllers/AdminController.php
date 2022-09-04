<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // dùng middleware xác thực trong controller
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $userDetail = Auth::user();

        return view('admin', compact('userDetail'));
    }
}
