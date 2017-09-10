<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Validator;
use App\Contacts;

class ContactPageController extends AdminBaseController
{
    /**
     * List contact page
     * @param Request $request
     * @return view
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function index(Request $request)
    {
        $contactList = Contacts::all();
        return view('admin/contacts/list', ['contactList' => $contactList]);
    }

    /**
     * View contact page
     * @param Request $request
     * @return view
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function view(Request $request)
    {
        $contactId = $request->contact_id;
        $contactDetail = Contacts::find($contactId);
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $postData['contact_id'] = $contactId;

            $rules = array(
                'status' => 'required|in:0,1,2'
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()) {

                return redirect()->route('admin_view_contacts', ['contact_id' => $contactId])
                        ->with('error', trans('common.msg_update_failed'))
                        ->withInput();
            } 
            $updateResult = Contacts::updateContact($postData);
            if (!$updateResult) {

                return redirect()->route('admin_view_contacts', ['contact_id' => $contactId])
                        ->with('error', trans('common.msg_update_failed'))
                        ->withInput();
            } else {

                return redirect()->route('admin_manage_contacts')
                        ->with('success', trans('common.msg_update_success'));
            }
        }

        return view('admin/contacts/view', ['contactDetail' => $contactDetail]);
    }
}
