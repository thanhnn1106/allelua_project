<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Seller\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Hash;

class ManageController extends BaseController
{
    public function index(Request $request)
    {
        $data = array();
        echo 'This is seller';exit;

//        return view('admin.index', $data);
    }

    public function changePasswordSeller(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $params = $request->all();
            $rules = array(
                'current_password' => 'required|min:8|max:32',
                'new_password' => 'required|min:8|max:32',
                'confirm_password' => 'required|min:8|max:32|same:new_password'
            );
            $validator = Validator::make($params, $rules);

            // Return view and error message when data invalid
            if ($validator->fails()) {
                $messages = $validator->messages();
                $messagesBag = "";
                foreach ($messages->all() as $message) {
                    $messagesBag .= $message . "<br>";
                }

                return redirect('seller/change_password/' . $id)->with('error', $messagesBag)->withInput();
            } else {
                $sellerInfo = User::find($id);
                // Check current password
                if (Hash::check($params['current_password'], $sellerInfo->password)) {
                    $updateResult = User::updateSellerPassword($id, $params['new_password']);
                    if ($updateResult) {
                        $messagesBag = trans('common.change_password.msg_changed_password_success');
                        return redirect('seller/change_password/' . $id)->with('success', $messagesBag)->withInput();
                    }
                    $messagesBag = trans('common.change_password.msg_changed_password_failed');
                    return redirect('seller/change_password/' . $id)->with('error', $messagesBag)->withInput();
                }
                $messagesBag = trans('common.change_password.msg_invalid_current_password');
                return redirect('seller/change_password/' . $id)->with('error', $messagesBag)->withInput();
            }
        }
        return view('seller.change_password.index', ['id' => $id]);
    }
}