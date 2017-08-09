<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Countries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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

    protected function getBirthDay()
    {
        $day = array('' => trans('front.register_page.dob.day'));
        for($i = 1; $i <= 31; $i++) {
            $j = $i;
            if($i < 10) {
                $j = '0'.$i;
            }
            $day[$j] = $j;
        }

        $month = array('' => trans('front.register_page.dob.month'));
        for($k = 1; $k <= 12; $k++) {
            $month[$k] = $k;
        }

        $year = array('' => trans('front.register_page.dob.year'));
        $currentYear = date('Y');
        for($m = 1900; $m < $currentYear; $m++) {
            $year[$m] = $m;
        }
        return array(
            'day' => $day,
            'month' => $month,
            'year' => $year,
        );
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
            'role_id' => 2,
            'status' => 0,
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
                return redirect(route('seller_register'))->with('success', trans('common.register.msg_register_success'));
            }
            return redirect(route('seller_register'))->with('error', trans('common.register.msg_register_failed'))->withInput();
        }

        $countryList = Countries::getCountriesList();
        return view('seller.register.index', ['countryList' => $countryList]);
    }

    public function registerUser(Request $request)
    {
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
            if ($validator->fails()) {
                return redirect()->route('user_register')
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
            $user->status         = config('allelua.user_status.value.inactive');
            $user->save();

            // TODO send email to active account

            return redirect(route('user_register'))->with('success', trans('common.register.msg_user_register_success'));
        }
        return view('user.register.index', ['dob' => $dob]);
    }
}
