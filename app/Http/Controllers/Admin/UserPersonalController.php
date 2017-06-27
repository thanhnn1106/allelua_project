<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Personal;
use DB;

class UserPersonalController extends BaseController
{
    /**
     * Edit user personal info
     * @param Request $request
     * @param Integer $id user id
     * @return type
     */
    public function editPersonalInfo(Request $request)
    {
        $userBankInfo      = null;
        $userTranslateInfo = null;

        // Update
        if ($request->isMethod('post')) {
            $params = $request->all();

            $rules =  array(
                'user_id'              => 'required|exists:users,id',
                'tax_code'             => 'required',
                'license_business'     => 'required',
                'bank_account'         => 'required',
                'bank_name'            => 'required',
                'bank_address'         => 'required',
                'introduce_company_en' => 'required',
                'introduce_company_vi' => 'required',
            );
            $userId = $params['user_id'];
            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_user_personal_edit', ['id' => $userId])
                            ->withErrors($validator)
                            ->withInput();
            }
            DB::beginTransaction();

            try {

                $updatePersonal          = \App\Personal::updatePersonal($params);
                if ($updatePersonal == false) {
                    return redirect()->route('admin_user_personal_edit', ['id' => $userId])
                            ->with('error', trans('common.update_failed'))
                            ->withInput();
                }

                $params['personal_id'] = $updatePersonal->id;
                $updateBankInfo          = \App\PersonalBank::updatePersonalBank($params);
                $updatePersonalTranslate = \App\PersonalTranslate::updatePersonalTranslate($params);
                if ($updateBankInfo && $updatePersonalTranslate) {

                    DB::commit();
                    return redirect()->route('admin_user', ['id' => $userId])
                        ->with('success', trans('common.update_success'));
                }
                return redirect()->route('admin_user_personal_edit', ['id' => $userId])
                            ->with('error', trans('common.update_failed'))
                            ->withInput();

            } catch (Exception $ex) {
                DB::rollback();
                return redirect()->route('admin_user_personal_edit', ['id' => $userId])
                            ->with('error', trans('common.update_failed'))
                            ->withInput();
            }
        }

        // Return page edit
        $langs             = \App\Languages::getResults();
        $id                = $request->id;
        $user              = User::find($id);

        if ($user == null) {
            $request->session()->flash('error', trans('user.there_is_no_user'));
            return redirect()->route('admin_user');
        }

        $userPersonalInfo = \App\Personal::where('user_id', '=', $id)->first();
        if($userPersonalInfo !== NULL) {
            $userBankInfo      = $userPersonalInfo->personalBanks()->first();
            $userTranslateInfo = $userPersonalInfo->personalTranslates()->get();
        }

        $returnData = array(
            'languages'         => $langs,
            'title'             => 'edit',
            'userInfo'          => $userPersonalInfo,
            'userBankInfo'      => $userBankInfo,
            'userTranslateInfo' => $userTranslateInfo,
        );

        return view('admin/user_personal_info/form', $returnData);
    }
}
