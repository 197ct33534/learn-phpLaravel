<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;
use Mail;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validationErrorMessages()
    {
        return [
            'password.required' => "Mật khẩu bắt buộc phải nhập",
            'current_password' => 'Mật khẩu không chính xác'
        ];
    }

    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);
        $fullname = Auth::user()->name;
        $email = Auth::user()->email;
        $content = "Chào " . $fullname . " Bạn vừa xác nhận mật khẩu thành công";

        // Mail::send([], ['name' => "Virat Gandhi"], function ($message) use ($fullname, $email) {
        //     $message->to($email)
        //         ->subject("Xác nhận mật khẩu")

        //         ->addPart("5% off its awesome\n\nGo get it now!", 'text/plain');
        // });
        Mail::raw("", function ($message) use ($content, $email) {
            $body = new \Symfony\Component\Mime\Part\TextPart($content);
            $message->to($email)
                ->subject("Xác nhận mật khẩu")
                // ->from("no-reply@example.com")
                ->setBody($body);
        });
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }
}
