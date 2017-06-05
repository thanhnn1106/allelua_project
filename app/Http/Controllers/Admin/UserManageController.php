<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Admin\BaseController;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserManageController extends BaseController
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
            $user->company_name           = $request->get('company_name');
            $user->email          = $request->get('email');
            $user->password       = bcrypt($request->get('password'));
            $user->phone_number   = $request->get('phone_number');
            $user->country_id     = $request->get('country');
            $user->role_id        = $request->get('roles');
            $user->status         = $request->get('status');
            $user->save();

            $request->session()->flash('success', trans('create_success'));
            return redirect()->route('admin_user');
        }

        return view('admin/user/form', [
            'roles'       => $this->getRoles(),
            'countries'   => $this->getCoutries(),
            'action'      => route('admin_user_add'),
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

            $user->company_name = $request->get('company_name');
            $user->phone_number = $request->get('phone_number');
            $user->role_id = $request->get('roles');
            $user->country_id = $request->get('country');
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
            'roles'      => $this->getRoles(),
            'countries'  => $this->getCoutries(),
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

        if ((int) $user->status === config('allelua.user_status_value.active')) {
            $user->status = config('allelua.user_status_value.inactive');
        } else {
            $user->status = config('allelua.user_status_value.active');
        }
        $user->save();
        $request->session()->flash('success', trans('user.change_status_success'));
        
        return redirect(route('admin_user'));
    }

    private function _setRules($request, $id = null)
    {
        $listStatus = array_keys(config('allelua.user_status'));
        $email = '';
        if ($id === null) {
            $email = 'required|max:255|unique:users,email';
        }
        $password = '';
        if ($id === null) {
            $password = 'required|';
        }

        $rules =  array(
            'company_name'     => 'required|max:255',
            'email'            => $email,
            'password'         => $password.'max:255',
            'confirm_password' => $password.'max:255|same:password',
            'phone_number'     => 'required|numeric',
            'country'          => 'required|exists:countries,id',
            'roles'            => 'required|exists:roles,id|not_in:1',
            'status'           => 'required|max:1|in:'.implode(',', $listStatus),
        );

        return $rules;
    }
}
