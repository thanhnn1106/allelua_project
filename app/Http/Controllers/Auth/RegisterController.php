<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Countries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeEmail;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|max:15|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'country_id' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'company_name' => $data['company_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country_id' => $data['country_id'],
            'role_id' => config('allelua.roles.seller'),
            'status' => config('allelua.user_status.value.inactive'),
        ]);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = array(
                'company_name' => 'required|string|max:255',
                'phone_number' => 'required|numeric',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
                'country_id' => 'required:exists:countries,id'
            );
            $paramsAdd = $request->all();
            $validator = Validator::make($paramsAdd, $rules);
            // Return view and error message when data invalid
            if ($validator->fails()) {
                return redirect()->route('seller_register')
                            ->withErrors($validator)
                            ->withInput();
            }
            $registerResult = $this->create($request->all());
            if ($registerResult) {
                $toEmail = $request->get('email');
                $roleId = config('allelua.roles.seller');
                $fullName = $request->get('company_name');
                Mail::to($toEmail)->send(new WelcomeEmail($fullName, $roleId));

                return redirect(route('seller_register'))->with('success', trans('common.register.msg_register_success'));
            }
            return redirect(route('seller_register'))->with('error', trans('common.register.msg_register_failed'))->withInput();
        }

        $countryList = Countries::getCountriesList();
        return view('seller.register.index', ['countryList' => $countryList]);
    }

    public function registerUser(Request $request)
    {
        $redirect = $request->get('redirect', NULL);
        if($redirect === NULL) {
            $redirect = base64_encode(\URL::previous());
        }

        $dob = $this->getBirthDay();
        if ($request->isMethod('post')) {
            $rules = array(
                'full_name' => 'required|string|max:255',
                'sex' => 'required|in:' . implode(',', array_keys(config('allelua.sex.label'))),
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
                'dob_day' => 'required|in:'.implode(',', $dob['day']),
                'dob_month' => 'required|in:'.implode(',', $dob['month']),
                'dob_year' => 'required|in:'.implode(',', $dob['year']),
            );
            $paramsAdd = $request->all();
            $validator = Validator::make($paramsAdd, $rules);

            $validator->after(function ($validator) use ($request) {
                if ( ! checkdate($request->get('dob_month'), $request->get('dob_day'), $request->get('dob_year'))) {
                    $validator->errors()->add('dob_month', 'The birthday field is not valid');
                }
            });

            if ($validator->fails()) {
                return redirect()->route('user_register', ['redirect' => $redirect])
                            ->withErrors($validator)
                            ->withInput();
            }

            $user = new User();
            $user->full_name = $request->get('full_name');
            $user->sex = $request->get('sex');
            $user->dob = $request->get('dob_year'). '-' . $request->get('dob_month') . '-' . $request->get('dob_day');
            $user->email          = $request->get('email');
            $user->password       = bcrypt($request->get('password'));
            $user->role_id        = config('allelua.roles.user');
            $user->status         = config('allelua.user_status.value.active');
            $user->save();

            // BEGIN TODO send email to active account
            $toEmail = $request->get('email');
            $roleId = config('allelua.roles.user');
            $fullName = $request->get('full_name');
            Mail::to($toEmail)->send(new WelcomeEmail($fullName, $roleId));

            // END TODO send email

            $userData = array(
                'email'     => $user->email,
                'password'  => $user->password,
                'status'    => $user->status,
                'role_id'   => $user->role_id,
            );
            if (Auth::attempt($userData)) {
                if( ! empty($redirect)) {
                    $url = base64_decode($redirect);
                    if(check_domain_name($url)) {
                        return \Redirect::to($url);
                    }
                }
            }
            return redirect(route('user_register'))->with('success', trans('common.register.msg_user_register_success'));
        }
        return view('user.register.index', ['dob' => $dob, 'url_redirect' => $redirect]);
    }
}
