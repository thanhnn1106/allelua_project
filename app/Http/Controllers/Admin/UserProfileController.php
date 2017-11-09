<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserProfileController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Edit user
     * @param Request $request
     * @param Integer $id user id
     * @return type
     */
    public function edit(Request $request) {

        $currentUser = Auth::user();
        $user = User::find($currentUser->id);
        if ($user == null) {
            $request->session()->flash('error', trans('user.there_is_no_user'));
            return redirect()->route('admin_dashboard');
        }

        if ($request->isMethod('POST')) {

            $rules =  array(
                'company_name'     => 'required|max:255',
                'password'         => 'max:255',
                'confirm_password' => 'max:255|same:password',
                'phone_number'     => 'required|numeric',
                'country'          => 'required|exists:countries,id',
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_profile')
                            ->withErrors($validator)
                            ->withInput();
            }

            $user->company_name = $request->get('company_name');
            $user->phone_number = $request->get('phone_number');
            $user->country_id   = $request->get('country');
            if ($request->get('password') !== NULL && $request->get('password') !== '') {
                $user->passord = bcrypt($request->get('password'));
            }
            $user->save();
            $request->session()->flash('success', trans('user.update_success'));
            return redirect(route('admin_profile'));
        }

        return view('admin/profile/form', [
            'user'      => $user,
            'countries' => \App\Countries::getResults(),
        ]);
    }
}
