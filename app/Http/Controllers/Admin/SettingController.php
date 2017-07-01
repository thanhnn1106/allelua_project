<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Validator;

class SettingController extends AdminBaseController
{
    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {

        $settings = \App\Settings::all(array('key', 'value'));
        $setting = array_column($settings->toArray(), 'value', 'key');

        if ($request->isMethod('POST')) {

            $rules =  array(
                'setting_rate'              => 'required|numeric|min:1',
                'setting_link_facebook'     => 'required|url',
                'setting_link_twitter'      => 'required|url',
                'setting_link_youtube'      => 'required|url',
                'setting_link_zalo'         => 'required|url',
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_setting_socical')
                            ->withErrors($validator)
                            ->withInput();
            }

            $data = array(
                array(
                    'key'   => 'setting_rate',
                    'value' => $request->get('setting_rate'),
                ),
                array(
                    'key'   => 'setting_link_facebook',
                    'value' => $request->get('setting_link_facebook'),
                ),
                array(
                    'key'   => 'setting_link_twitter',
                    'value' => $request->get('setting_link_twitter'),
                ),
                array(
                    'key'   => 'setting_link_youtube',
                    'value' => $request->get('setting_link_youtube'),
                ),
                array(
                    'key'   => 'setting_link_zalo',
                    'value' => $request->get('setting_link_zalo'),
                ),
            );
            foreach ($data as $item) {
                $row = \App\Settings::where('key', $item['key'])->first();
                if ($row !== null) {
                    $row->value = $item['value'];
                    $row->save();
                }
            }

            $request->session()->flash('success', trans('common.update_success'));
            return redirect(route('admin_setting_socical'));
        }

        return view('admin/setting/form', [
            'setting'      => $setting,
        ]);
    }
}
