<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Seller\BaseController;
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

    public function changePasswordSeller(Request $request)
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

                return redirect()->route('seller_change_password')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $sellerInfo = User::find($userId);
                // Check current password
                if (Hash::check($params['current_password'], $sellerInfo->password)) {
                    $updateResult = User::updateSellerPassword($userId, $params['new_password']);
                    if ($updateResult) {
                        $messagesBag = trans('common.change_password.msg_changed_password_success');
                        return redirect('seller/change_password')->with('success', $messagesBag)->withInput();
                    }
                    $messagesBag = trans('common.change_password.msg_changed_password_failed');
                    return redirect('seller/change_password')->with('error', $messagesBag)->withInput();
                }
                $messagesBag = trans('common.change_password.msg_invalid_current_password');
                return redirect('seller/change_password/')->with('error', $messagesBag)->withInput();
            }
        }
        return view('seller.dashboard.change_password');
    }

    public function notification(Request $request)
    {
        return view('seller.dashboard.notification');
    }

    public function manageOrder(Request $request)
    {
        $orderList = Order::getOrderList(Auth::user()->id);
        return view('seller.dashboard.order_list', ['orderList' => $orderList]);
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $updateResult = Order::updateOrderStatus($orderId);
        if ($updateResult) {

            return redirect()->route('seller_manange_order')->with('success', trans('common.seller.msg_update_order_status_success'));
        }

        return redirect()->route('seller_manange_order')->with('errror', trans('common.seller.msg_update_order_status_failed'));
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