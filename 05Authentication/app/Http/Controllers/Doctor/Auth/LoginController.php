<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('doctor')->check()) {
            return 'thành công  ';
        }
        return view('doctor.auth.login');
    }
    public function postLogin(Request $request)
    {
        $dataLogin = $request->except(['_token']);
        if (is_active($dataLogin['email'])) {
            $checkLogin = Auth::guard('doctor')->attempt($dataLogin);
            if ($checkLogin) {
                return redirect(RouteServiceProvider::DOCTOR);
            }
            return back()->with('msg', 'Email hoặc mật khẩu không hợp lệ');
        }
        return back()->with('msg', 'Tài khoản chưa được kích hoạt');
    }
}
