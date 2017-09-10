<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use Hash;
use DB;

class ManageController extends BaseController
{
    public function index(Request $request)
    {
        $data = array();
        echo 'This is seller';exit;

//        return view('admin.index', $data);
    }

    public function changePasswordUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $userId = $request->id;
            $params = $request->all();
            $rules = array(
                'current_password' => 'required|min:8|max:32',
                'new_password' => 'required|min:8|max:32',
                'confirm_password' => 'required|min:8|max:32|same:new_password'
            );
            $validator = Validator::make($params, $rules);

            // Return view and error message when data invalid
            if ($validator->fails()) {

                return redirect()->route('user_change_password')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $userInfo = User::find($userId);
                // Check current password
                if (Hash::check($params['current_password'], $userInfo->password)) {
                    $updateResult = User::updateSellerPassword($userId, $params['new_password']);
                    if ($updateResult) {
                        $messagesBag = trans('common.change_password.msg_changed_password_success');
                        return redirect()->route('user_change_password')->with('success', $messagesBag)->withInput();
                    }
                    $messagesBag = trans('common.change_password.msg_changed_password_failed');
                    return redirect()->route('user_change_password')->with('error', $messagesBag)->withInput();
                }
                $messagesBag = trans('common.change_password.msg_invalid_current_password');
                return redirect()->route('user_change_password')->with('error', $messagesBag)->withInput();
            }
        }
        return view('user.dashboard.change_password');
    }

    public function notification(Request $request)
    {
        return view('seller.dashboard.notification');
    }

    public function accountManagement(Request $request)
    {
        $userId   = Auth::user()->id;
        $userInfo = User::find($userId);
        $dob      = $this->getBirthDay();
        if ($request->isMethod('post')) {
            $params = $request->all();
            $rules =  array(
                'full_name'    => 'required|max:255',
                'phone_number' => 'required|numeric',
                'sex'          => 'required|in:' . implode(',', array_keys(config('allelua.sex.label'))),
                'dob_day'      => 'required|numeric|in:' . implode(',', $dob['day']),
                'dob_month'    => 'required|numeric|in:' . implode(',', $dob['month']),
                'dob_year'     => 'required|numeric|in:' . implode(',', $dob['year']),
            );
            // run the validation rules on the inputs from the form
            $validator = Validator::make($params, $rules);

            $validator->after(function ($validator) use ($request) {
                if ( ! checkdate($request->get('dob_month'), $request->get('dob_day'), $request->get('dob_year'))) {
                    $validator->errors()->add('dob_month', 'The birthday field is not valid');
                }
            });

            if ($validator->fails()) {
                return redirect()->route('user_account_management')
                            ->withErrors($validator)
                            ->withInput();
            }
            $userInfo->full_name    = $params['full_name'];
            $userInfo->phone_number = $params['phone_number'];
            $userInfo->sex          = $params['sex'];
            $userInfo->dob          = $params['dob_year']. '-' . $params['dob_month'] . '-' . $params['dob_day'];
            $saveResult = $userInfo->save();
            if ($saveResult) {
                return redirect()->route('user_account_management')
                            ->with('success', trans('update_success'))
                            ->withInput();
            }
            return redirect()->route('user_account_management')
                            ->with('error', trans('update_failed'))
                            ->withInput();
        }

        $returnData = array(
            'dob' => $dob,
            'userInfo' => $userInfo
        );

        return view('user.dashboard.account_management', $returnData);
    }

    public function orderHistory(Request $request)
    {
        $orderList = Order::getOrderHistoryList(Auth::user()->id);
        return view('user.dashboard.order_history', ['orderList' => $orderList]);
    }

    public function postManagement(Request $request)
    {
        return view('seller.dashboard.post_management');
    }

    public function inbox(Request $request)
    {
        return view('seller.dashboard.inbox');
    }
}