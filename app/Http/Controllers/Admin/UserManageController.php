<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Admin\AdminBaseController;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserManageController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = array(
            'email'         => null,
            'company_name'  => null,
            'status'        => null,
            'role'          => null,
        );

        if ($request->isMethod('post')) {
//            $temp = $request->all();
//            $filter = $temp['filter'];
//            $request->session()->set('admin_filter_usermanage', $filter);
        }
//        $filterSesion = (array) $request->session()->get('admin_filter_usermanage');
//        $filter = array_merge($filter, $filterSesion);
 
        $users = User::getListFilterUser($params);

        return view('admin.user.list', [
          'users' => $users,
//          'filter' => $filter,
//          'fliterUserBy' => config('experteyes.admin_user_filter_by'),
//          'fliterUserStatus' => config('experteyes.user_status'),
//          'filterUserRole' => config('experteyes.admin_user_filter_role')
        ]);
    }

    /**
     * Add new user
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_user_add')
                            ->withErrors($validator)
                            ->withInput();
            }

            $user = new User();
            if($request->get('roles') == config('allelua.roles.seller')) {
                $user->company_name           = $request->get('company_name');
                $user->phone_number   = $request->get('phone_number');
                $user->country_id     = $request->get('country');
            } else if ($request->get('roles') == config('allelua.roles.user')) {
                $user->full_name = $request->get('full_name');
                $user->sex = $request->get('sex');
                $user->dob = $request->get('dob_year'). '-' . $request->get('dob_month') . '-' . $request->get('dob_day');
            }
            $user->email          = $request->get('email');
            $user->password       = bcrypt($request->get('password'));
            $user->role_id        = $request->get('roles');
            $user->status         = $request->get('status');
            $user->save();

            $request->session()->flash('success', trans('create_success'));
            return redirect()->route('admin_user');
        }

        return view('admin/user/form', [
            'roles'       => \App\Roles::getRoles(),
            'countries'   => \App\Countries::getResults(),
            'action'      => route('admin_user_add'),
            'dob' => $this->getBirthDay(),
        ]);
    }

    /**
     * Edit user
     * @param Request $request
     * @param Integer $id user id
     * @return type
     */
    public function edit(Request $request, $id) {
        $user = User::find($id);

        if ($user == null) {
            $request->session()->flash('error', trans('user.there_is_no_user'));
            return redirect()->route('admin_user');
        }
        $currentUser = Auth::user();
        if ($user->id == $currentUser->id) {
            $request->session()->flash('warning', trans('user.can_not_change'));
            return redirect()->route('admin_user');
        }

        if ($request->isMethod('POST')) {

            $rules = $this->_setRules($request, $id);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_user_edit', array('id' => $user->id))
                            ->withErrors($validator)
                            ->withInput();
            }

            if($request->get('roles') == config('allelua.roles.seller')) {
                $user->company_name = $request->get('company_name');
                $user->phone_number = $request->get('phone_number');
                $user->country_id = $request->get('country');
            } else if ($request->get('roles') == config('allelua.roles.user')) {
                $user->full_name = $request->get('full_name');
                $user->sex = $request->get('sex');
                $user->dob = $request->get('dob_year'). '-' . $request->get('dob_month') . '-' . $request->get('dob_day');
            }

            $user->role_id = $request->get('roles');
            $user->status = $request->get('status');
            if ($request->get('password') !== NULL && $request->get('password') !== '') {
                $user->password = bcrypt($request->get('password'));
            }
            $user->save();
            $request->session()->flash('success', trans('update_success'));
            return redirect()->route('admin_user');
        }

        return view('admin/user/form', [
            'user'       => $user,
            'roles'      => \App\Roles::getRoles(),
            'countries'  => \App\Countries::getResults(),
            'action'     => route('admin_user_edit', array('id' => $user->id))
        ]);
    }

    /**
     * Delete user with soft delete
     * 
     * @param Request $request
     * @param Integer $id user id
     * @return type
     */
    public function delete(Request $request, $id) {
        $user = User::find($id);
        if ($user == null) {
            $request->session()->flash('error', trans('user.there_is_no_user'));
            return redirect(route('admin_user'));
        }
        $currentUser = Auth::user();
        if ($user->id == $currentUser->id) {
            $request->session()->flash('warning', trans('user.can_not_change'));
            return redirect()->route('admin_user');
        }

        $user->delete();
        $request->session()->flash('success', trans('user.delete_success'));
        
        return redirect(route('admin_user'));
    }

    /**
     * Change status of user
     * @param Request $request
     * @param Integer $id user id
     * @return type
     */
    public function changeStatus(Request $request, $id) {
        $user = User::find($id);
        if ($user == null) {
            $request->session()->flash('error', trans('user.there_is_no_user'));
            return redirect(route('admin_user'));
        }
        $currentUser = Auth::user();
        if ($user->id == $currentUser->id) {
            $request->session()->flash('warning', trans('user.can_not_change'));
            return redirect()->route('admin_user');
        }

        $const = config('allelua.user_status.value');
        if ((int) $user->status === $const['active']) {
            $user->status = $const['inactive'];
        } else {
            $user->status = $const['active'];
        }
        $user->save();
        $request->session()->flash('success', trans('user.change_status_success'));
        
        return redirect(route('admin_user'));
    }

    private function _setRules($request, $id = null)
    {
        $listStatus = array_keys(config('allelua.user_status.label'));
        $email = '';
        if ($id === null) {
            $email = 'required|max:255|unique:users,email';
        }
        $password = '';
        if ($id === null) {
            $password = 'required|';
        }

        $required_seller = $required_user = '';
        if($request->get('roles') == config('allelua.roles.seller')) {
            $required_seller = 'required|';
        }
        if($request->get('roles') == config('allelua.roles.user')) {
            $required_user = 'required|';
        }

        $rules =  array(
            'email'            => $email,
            'password'         => $password.'max:255',
            'confirm_password' => $password.'max:255|same:password',
            'roles'            => 'required|exists:roles,id|not_in:1',
            'status'           => 'required|max:1|in:'.implode(',', $listStatus),
            'company_name'     => $required_seller.'max:255',
            'phone_number'     => $required_seller.'numeric',
            'country'          => $required_seller.'exists:countries,id',
            'full_name'        => $required_user.'max:255',
            'sex'              => $required_user.'in:' . implode(',', array_keys(config('allelua.sex.label'))),
            'dob_day'          => $required_user.'in:1,31',
            'dob_month'        => $required_user.'in:1,12',
            'dob_year'         => $required_user.'in:1900,'.date('Y'),
        );

        return $rules;
    }
}
