<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Personal;
use DB;

class UserPersonalController extends AdminBaseController
{
    /**
     * index
     * @param Request $request
     * @return $userPersonalInfoList
     */
    public function index(Request $request)
    {
        $userPersonalInfoList = User::getUserPersonalInfo();
        $data = [
            'userPersonalInfoList' => $userPersonalInfoList,
            'langs'                => \App\Languages::getResults(),
        ];

        return view('admin/user_personal_info/list', $data);
    }

    /**
     * index
     * @param Request $request
     * @return $mix
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->all();
            $sellerIdArr = Personal::getUserIdList();
            $personalUserIdArray = array();
            foreach ($sellerIdArr as $item) {
                array_push($personalUserIdArray, $item->user_id);
            }
            $rules =  array(
                'seller'               => 'required|exists:users,company_name',
                'user_id'              => 'required|not_in:' . implode(',', $personalUserIdArray),
                'tax_code'             => 'required|numeric|max:191',
                'license_business'     => 'required|max:255',
                'bank_account'         => 'required|numeric|max:255',
                'bank_name'            => 'required|max:255',
                'bank_address'         => 'required|max:255',
                'introduce_company_en' => 'required',
                'introduce_company_vi' => 'required',
            );
            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_user_personal_add')
                            ->withErrors($validator)
                            ->withInput();
            }
            DB::beginTransaction();

            try {

                $params['role_id'] = Auth::user()->role_id;
                $addPersonal          = \App\Personal::addPersonal($params);
                if ($addPersonal == false) {
                    return redirect()->route('admin_user_personal_add')
                            ->with('error', trans('common.create_failed'))
                            ->withInput();
                }

                $params['personal_id'] = $addPersonal->id;
                $addBankInfo          = \App\PersonalBank::addPersonalBank($params);
                $addPersonalTranslate = \App\PersonalTranslate::addPersonalTranslate($params);
                if ($addBankInfo && $addPersonalTranslate) {

                    DB::commit();
                    return redirect()->route('admin_user_personal_list')
                        ->with('success', trans('common.create_success'));
                }
                return redirect()->route('admin_user_personal_add')
                            ->with('error', trans('common.create_failed'))
                            ->withInput();

            } catch (Exception $ex) {
                DB::rollback();
                return redirect()->route('admin_user_personal_add')
                            ->with('error', trans('common.create_failed'))
                            ->withInput();
            }
        }

        $returnData = array(
            'languages'         => \App\Languages::getResults(),
            'title'             => 'add',
        );

        return view('admin/user_personal_info/form_add', $returnData);
    }

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
                'tax_code'             => 'required|numeric',
                'license_business'     => 'required',
                'bank_account'         => 'required|numeric',
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
                    return redirect()->route('admin_user_personal_list')
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
        $langs          = \App\Languages::getResults();
        $personalInfoId = $request->id;

        $userPersonalInfo = \App\Personal::where('user_id', '=', $personalInfoId)->first();
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

        return view('admin/user_personal_info/form_edit', $returnData);
    }

    /**
     * Approve user personal info
     * @param Request $request
     * @param Integer $id user id
     * @return type
     * @author Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function approve(Request $request)
    {
        $personalInfo = Personal::find($request->id);
        $personalInfo->status = 1;
        $approvedResult = $personalInfo->save();
        if ($approvedResult) {
            return redirect()->route('admin_user_personal_list')
                        ->with('success', trans('common.update_success'));
        }
        return redirect()->route('admin_user_personal_list')
                            ->with('error', trans('common.update_failed'))
                            ->withInput();
    }
}
