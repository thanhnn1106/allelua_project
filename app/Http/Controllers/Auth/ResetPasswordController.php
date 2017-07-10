<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Overide function showResetForm of ResetsPasswords class.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return view
     * @author Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('seller.forget_password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Overide function resetPassword of ResetsPasswords class.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     * @author Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        session()->flash('success', trans('passwords.reset'));
        // login sau khi d9at85 lai5 password thanh2 cong6
//        $this->guard()->login($user);
    }

}
