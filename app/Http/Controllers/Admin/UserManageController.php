<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Admin\AdminBaseController;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\SellerActiveNotiEmail;
use Mail;

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
            if($request->get('roles') == config('allelua.roles.user')) {
                $validator->after(function ($validator) use ($request) {
                    if ( ! checkdate($request->get('dob_month'), $request->get('dob_day'), $request->get('dob_year'))) {
                        $validator->errors()->add('dob_month', 'The birthday field is not valid');
                    }
                });
            }

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

            $request->session()->flash('success', trans('common.msg_create_success'));
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
        $dob = $this->getBirthDay();
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
            // Active seller
            $isSendMail = ($user->role_id == config('allelua.roles.seller')
                    && $user->status == config('allelua.user_status.value.inactive')
                    && $user->status != $request->status) ? true : false;

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if($request->get('roles') == config('allelua.roles.user')) {
                $validator->after(function ($validator) use ($request) {
                    if ( ! checkdate($request->get('dob_month'), $request->get('dob_day'), $request->get('dob_year'))) {
                        $validator->errors()->add('dob_month', 'The birthday field is not valid');
                    }
                });
            }
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
            if($isSendMail) {
                $toEmail = $user->email;
                $fullName = $request->get('company_name');
                Mail::to($toEmail)->send(new SellerActiveNotiEmail($fullName));
            }
            $request->session()->flash('success', trans('common.msg_update_success'));
            return redirect()->route('admin_user');
        }

        return view('admin/user/form', [
            'user'       => $user,
            'roles'      => \App\Roles::getRoles(),
            'countries'  => \App\Countries::getResults(),
            'dob'        => $dob,
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
        $dob = $this->getBirthDay();
        $listStatus = array_keys(config('allelua.user_status.label'));
        $email = '';
        if ($id === null) {
            $email = 'required|max:255|unique:users,email';
        }
        $password = '';
        if ($id === null) {
            $password = 'required|';
        }

        $required_seller = $required_user = $user_bithday_day = $user_bithday_month = $user_bithday_year = '';
        if($request->get('roles') == config('allelua.roles.seller')) {
            $required_seller = 'required|';
        }
        if($request->get('roles') == config('allelua.roles.user')) {
            $required_user = 'required|';
            $user_bithday_day = 'numeric|in:'.implode(',', $dob['day']);
            $user_bithday_month = 'numeric|in:'.implode(',', $dob['month']);
            $user_bithday_year = 'numeric|in:'.implode(',', $dob['year']);
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
            'dob_day'          => $required_user.$user_bithday_day,
            'dob_month'        => $required_user.$user_bithday_month,
            'dob_year'         => $required_user.$user_bithday_year,
        );

        return $rules;
    }

    /**
     * Show user deleted list.
     *
     * @return array
     * @author Nguyen Ngoc Thanh    <thanh.nn1106@gmail.com>
     */
    public function deletedList(Request $request)
    {
        $params = array(
            'email'         => null,
            'company_name'  => null,
            'status'        => null,
            'role'          => null,
            'deleted_at'    => null,
        );

        $users = User::getListUserDeleted();

        return view('admin.user.deleted_list', [
            'users' => $users,
        ]);
    }

    /**
     * Restore user.
     * 
     * @param Request $request
     * @param Integer $id user id
     * @return type
     */
    public function restore(Request $request, $id)
    {
        $user = User::getUserDeletedInfo($id);
        if ($user == null) {
            $request->session()->flash('error', trans('user.there_is_no_user'));
            return redirect(route('admin_user'));
        }
        $currentUser = Auth::user();
        if ($user->id == $currentUser->id) {
            $request->session()->flash('warning', trans('user.can_not_change'));
            return redirect()->route('admin_user');
        }

        $restoreResult = User::restoreDeletedUser($id);
        $request->session()->flash('success', trans('user.restore_success'));
        return redirect(route('admin_user'));
    }

    /**
     * Delete user with hard delete
     * 
     * @param Request $request
     * @param Integer $id user id
     * @return type
     */
    public function forceDelete(Request $request, $id)
    {
        $user = User::getUserDeletedInfo($id);
        if ($user == null) {
            $request->session()->flash('error', trans('user.there_is_no_user'));
            return redirect(route('admin_user'));
        }
        $currentUser = Auth::user();
        if ($user->id == $currentUser->id) {
            $request->session()->flash('warning', trans('user.can_not_change'));
            return redirect()->route('admin_user');
        }

        $restoreResult = User::forceDeletedUser($id);
        $request->session()->flash('success', trans('user.delete_success'));
        return redirect(route('admin_user'));
    }
}
