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

class PersonalInfoController extends BaseController
{
    /**
     * Index page - Setting personal information
     * @param Request $request
     * @return array $returnData
     * @author Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function index(Request $request)
    {
        $userPersonalInfo  = null;
        $userBankInfo      = null;
        $userTranslateInfo = null;
        $userId            = Auth::user()->id;
        $langs             = \App\Languages::getResults();

        // Return page edit
        $userPersonalInfo = \App\Personal::where('user_id', '=', $userId)->first();
        if($userPersonalInfo !== NULL) {
            $userBankInfo      = $userPersonalInfo->personalBanks()->first();
            $userTranslateInfo = $userPersonalInfo->personalTranslates()->get();
        }

        $returnData = [
            'languages'         => $langs,
            'title'             => 'edit',
            'userPersonalInfo'  => $userPersonalInfo,
            'userBankInfo'      => $userBankInfo,
            'userTranslateInfo' => $userTranslateInfo,
        ];

        return view('seller.dashboard.account_management', $returnData);
    }

    /**
     * Add page - Setting personal information
     * @param Request $request
     * @return
     * @author Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function add(Request $request)
    {
        $params = $request->all();

        $rules = array(
            'tax_code' => 'required|numeric',
            'license_business' => 'required',
            'bank_account' => 'required|numeric',
            'bank_name' => 'required',
            'bank_address' => 'required',
            'introduce_company_en' => 'required',
            'introduce_company_vi' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('seller_account_management')
                             ->withErrors($validator)
                             ->withInput();
        }
        DB::beginTransaction();
        try {
            $params['user_id'] = Auth::user()->id;
            $params['role_id'] = Auth::user()->role_id;
            $addPersonal = \App\Personal::addPersonal($params);
            if ($addPersonal == false) {
                return redirect()->route('seller_account_management')
                                ->with('error', trans('common.seller.msg_update_personal_info_failed'))
                                ->withInput();
            }

            $params['personal_id'] = $addPersonal->id;
            $addBankInfo = \App\PersonalBank::addPersonalBank($params);
            $addPersonalTranslate = \App\PersonalTranslate::addPersonalTranslate($params);
            if ($addBankInfo && $addPersonalTranslate) {

                DB::commit();
                return redirect()->route('seller_account_management')
                                ->with('success', trans('common.seller.msg_update_personal_info_success'));
            }
            DB::rollback();
            return redirect()->route('seller_account_management')
                            ->with('error', trans('common.seller.msg_update_personal_info_failed'))
                            ->withInput();
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('seller_account_management')
                            ->with('error', trans('common.seller.msg_update_personal_info_failed'))
                            ->withInput();
        }
    }

    /**
     * Update page - Setting personal information
     * @param Request $request
     * @return
     * @author Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function update(Request $request)
    {
        $params = $request->all();

        $rules = array(
            'introduce_company_en' => 'required',
            'introduce_company_vi' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('seller_account_management')
                             ->withErrors($validator)
                             ->withInput();
        }
        DB::beginTransaction();
        try {

            $userPersonalInfo      = \App\Personal::where('user_id', '=', Auth::user()->id)->first();
            $params['personal_id'] = $userPersonalInfo->id;

            $updatePersonalTranslate = \App\PersonalTranslate::updatePersonalTranslate($params);
            if ($updatePersonalTranslate) {

                DB::commit();
                return redirect()->route('seller_account_management')
                                ->with('success', trans('common.seller.msg_update_personal_info_success'));
            }
            DB::rollback();
            return redirect()->route('seller_account_management')
                            ->with('error', trans('common.seller.msg_update_personal_info_failed'))
                            ->withInput();
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('seller_account_management')
                            ->with('error', trans('common.seller.msg_update_personal_info_failed'))
                            ->withInput();
        }
    }

}