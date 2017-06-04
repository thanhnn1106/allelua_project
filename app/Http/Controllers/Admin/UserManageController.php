<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Validator;

class UserManageController extends Controller
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

        if ((int) $user->status === config('allelua.user_status_value.active')) {
            $user->status = config('allelua.user_status_value.inactive');
        } else {
            $user->status = config('allelua.user_status_value.active');
        }
        $user->save();
        $request->session()->flash('success', trans('user.change_status_success'));
        
        return redirect(route('admin_user'));
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

        $user->delete();
        $request->session()->flash('success', trans('user.delete_success'));
        
        return redirect(route('admin_user'));
    }
}
