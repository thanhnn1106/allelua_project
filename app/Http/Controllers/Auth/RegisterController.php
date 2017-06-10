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
                $messages    = $validator->messages();
                $messagesBag = "";
                foreach ($messages->all() as $message) {
                    $messagesBag .= $message . "<br>";
                }

                return redirect(route('seller_register'))->with('error', $messagesBag)->withInput();
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
}
