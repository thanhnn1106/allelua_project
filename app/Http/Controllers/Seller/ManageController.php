<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Seller\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
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

    public function accountManagement(Request $request)
    {
        $userBankInfo      = null;
        $userTranslateInfo = null;
        $userId            = Auth::user()->id;
        $langs             = \App\Languages::getResults();
        if ($request->isMethod('post')) {
            $params = $request->all();

            $rules =  array(
                'seller_id'            => 'required|exists:users,id',
                'tax_code'             => 'required',
                'license_business'     => 'required',
                'bank_account'         => 'required',
                'bank_name'            => 'required',
                'bank_address'         => 'required',
                'introduce_company_en' => 'required',
                'introduce_company_vi' => 'required',
            );
            $userId = $params['seller_id'];
            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('seller_account_management')
                            ->withErrors($validator)
                            ->withInput();
            }
            DB::beginTransaction();
            if ($params['action'] === 'update') {
                try {

                    $params['status'] = 0;
                    $updatePersonal          = \App\Personal::updatePersonal($params);
                    if ($updatePersonal == false) {
                        return redirect()->route('seller_account_management')
                                ->with('error', trans('common.update_failed'))
                                ->withInput();
                    }

                    $params['personal_id'] = $updatePersonal->id;
                    $updateBankInfo          = \App\PersonalBank::updatePersonalBank($params);
                    $updatePersonalTranslate = \App\PersonalTranslate::updatePersonalTranslate($params);
                    if ($updateBankInfo && $updatePersonalTranslate) {

                        DB::commit();
                        return redirect()->route('seller_account_management')
                            ->with('success', trans('common.update_success'));
                    }
                    return redirect()->route('seller_account_management')
                                ->with('error', trans('common.update_failed'))
                                ->withInput();

                } catch (Exception $ex) {
                    DB::rollback();
                    return redirect()->route('seller_account_management')
                                ->with('error', trans('common.update_failed'))
                                ->withInput();
                }
            } else {
                try {

                    $params['status'] = 0;
                    $addPersonal          = \App\Personal::addPersonal($params);
                    if ($addPersonal == false) {
                        return redirect()->route('seller_account_management')
                                ->with('error', trans('common.update_failed'))
                                ->withInput();
                    }

                    $params['personal_id'] = $addPersonal->id;
                    $addBankInfo          = \App\PersonalBank::addPersonalBank($params);
                    $addPersonalTranslate = \App\PersonalTranslate::addPersonalTranslate($params);
                    if ($addBankInfo && $addPersonalTranslate) {

                        DB::commit();
                        return redirect()->route('seller_account_management')
                            ->with('success', trans('common.update_success'));
                    }
                    return redirect()->route('seller_account_management')
                                ->with('error', trans('common.update_failed'))
                                ->withInput();

                } catch (Exception $ex) {
                    DB::rollback();
                    return redirect()->route('seller_account_management')
                                ->with('error', trans('common.update_failed'))
                                ->withInput();
                }
            }
        }
        // Return page edit
        $userPersonalInfo = \App\Personal::where('user_id', '=', $userId)->first();
        if($userPersonalInfo !== NULL) {
            $userBankInfo      = $userPersonalInfo->personalBanks()->first();
            $userTranslateInfo = $userPersonalInfo->personalTranslates()->get();
        }

        $returnData = [
            'languages'         => $langs,
            'title'             => 'edit',
            'userInfo'          => $userPersonalInfo,
            'userBankInfo'      => $userBankInfo,
            'userTranslateInfo' => $userTranslateInfo,
            'action'            => isset($userPersonalInfo->user_id) ? 'update' : 'add',
        ];

        return view('seller.dashboard.account_management', $returnData);
    }

    public function newPost(Request $request)
    {
        return view('seller.dashboard.new_post');
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