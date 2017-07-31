<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers{
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginAdmin(Request $request)
    {
        $data = array('message' => '');

        if ($request->isMethod('POST')) {

            // validate the info, create rules for the inputs
            $rules = array(
                'email'    => 'required|email',
                'password' => 'required|min:8',
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect(route('admin_login'))
                            ->withErrors($validator)
                            ->withInput();
            }

            $const = config('allelua.user_status.value');
            $loginUser = User::where('email', $request->get('email'))->first();
            if ($loginUser === NULL) {
                $data['message'] = trans('auth.login_failed');
            } else {
                if ($loginUser->status == $const['inactive']) { 
                    $data['message'] = trans('auth.login_failed');
                } else {

                    // create our user data for the authentication
                    $userData = array(
                        'email'     => $request->get('email'),
                        'password'  => $request->get('password'),
                        'status'    => $const['active'],
                        'role_id'   => $loginUser->role_id
                    );
                    // attempt to do the login
                    if (Auth::attempt($userData)) {
                        return redirect(route('admin_dashboard'));
                    } else {        
                        $data['message'] = trans('auth.login_failed');
                    }
                }
            }
        }

        return view('auth/admin_login', $data);
    }

    public function logout(Request $request)
    {
        $role = config('config.allelua.roles');
        if (Auth::user()->role_id == $role['administrator']) {
            $this->performLogout($request);
            return redirect(route('admin_login'));
        } else {
            $this->performLogout($request);
            return redirect(route('home'));
        }
    }

    public function loginSeller(Request $request)
    {
        $data = array();

        if ($request->isMethod('POST')) {

            // validate the info, create rules for the inputs
            $rules = array(
                'email'    => 'required|email',
                'password' => 'required|min:8',
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect(route('seller_login'))
                            ->withErrors($validator)
                            ->withInput();
            }

            $const = config('allelua.user_status.value');
            $loginUser = User::where('email', $request->get('email'))->first();
            if ($loginUser === NULL) {

                return view('auth/login', ['message' => trans('auth.login_failed')]);
            } else {
                if ($loginUser->status == $const['inactive']) {

                    return view('auth/login', ['message' => trans('auth.login_failed')]);
                } else {

                    // create our user data for the authentication
                    $userData = array(
                        'email'     => $request->get('email'),
                        'password'  => $request->get('password'),
                        'status'    => $const['active'],
                        'role_id'   => $loginUser->role_id
                    );
                    // attempt to do the login
                    if (Auth::attempt($userData)) {
                        return redirect(route('seller_dashboard'));
                    } else {

                        return view('auth/login', ['message' => trans('auth.login_failed')]);
                    }
                }
            }
        }

        return view('auth/login', $data);
    }

    public function loginAjaxSeller(Request $request)
    {
        try {
            if ( ! $request->isMethod('POST')) {
                return response()->json(array('error' => 1, 'result' => trans('common.error_exception_ajax')));
            }

            // validate the info, create rules for the inputs
            $rules = array(
                'email'    => 'required|email',
                'password' => 'required|min:8',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(array('error' => 1, 'result' => trans('common.please_check_form_below'), 'messages' => $validator->errors()), 422);
            }

            $const = config('allelua.user_status.value');
            $loginUser = User::where('email', $request->get('email'))->first();
            if ($loginUser === NULL) {
                return response()->json(array('error' => 1, 'result' => trans('common.please_check_form_below'), 'messages' => trans('auth.login_failed')));
            }

            if ($loginUser->status == $const['inactive']) {
                return response()->json(array('error' => 1, 'result' => trans('common.please_check_form_below'), 'messages' => trans('auth.login_failed')));
            }

            // create our user data for the authentication
            $userData = array(
                'email'     => $request->get('email'),
                'password'  => $request->get('password'),
                'status'    => $const['active'],
                'role_id'   => $loginUser->role_id
            );
            // attempt to do the login
            if (Auth::attempt($userData)) {
                 return response()->json(array('error' => 0, 'result' => '', 'urlRedirect' => $request->get('urlBefore')));
            }
            return response()->json(array('error' => 1, 'result' => trans('common.please_check_form_below'), 'messages' => trans('auth.login_failed')));

        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.error_exception_ajax')));
        }
    }

}
