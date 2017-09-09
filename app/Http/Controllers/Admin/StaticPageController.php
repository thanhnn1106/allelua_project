<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Validator;
use App\Statics;
use App\StaticsTranslate;

class StaticPageController extends AdminBaseController
{
    /**
     * List static page
     * @param Request $request
     * @return view
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function index(Request $request)
    {
        $pageInfoList = Statics::getPageInfoList();
        $data = [
            'pageInfoList' => $pageInfoList,
            'langs'        => \App\Languages::getResults(),
        ];

        return view('admin/static_page/list', $data);
    }

    /**
     * Edit static page content
     * 
     * @param Request $request
     * 
     * @return view
     * 
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function edit(Request $request)
    {
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $rules =  array(
                'page_id'    => 'required|exists:statics,id',
                'content_en' => 'required',
                'content_vi' => 'required',
            );
            $pageId = $postData['page_id'];
            // run the validation rules on the inputs from the form
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_edit_static_page', ['page_id' => $pageId])
                            ->withErrors($validator)
                            ->withInput();
            }
            $updateStaticsTranslate = \App\StaticsTranslate::updateStaticsTranslate($postData);
            if ($updateStaticsTranslate) {
                return redirect()->route('admin_edit_static_page', ['page_id' => $pageId])
                        ->with('success', trans('common.msg_update_success'));
            }

            return redirect()->route('admin_edit_static_page', ['page_id' => $pageId])
                            ->with('error', trans('common.msg_update_failed'))
                            ->withInput();
        }

        $langs             = \App\Languages::getResults();
        $pageId            = $request->page_id;
        $pageInfo = \App\Statics::where('id', '=', $pageId)->first();
        if($pageInfo !== NULL) {
            $pageTranslateInfo = $pageInfo->staticTranslates()->get();
        }

        $data = [
            'pageInfo'          => $pageInfo,
            'pageTranslateInfo' => $pageTranslateInfo,
            'languages'         => $langs,
        ];

        return view('admin/static_page/edit', $data);
    }
}
