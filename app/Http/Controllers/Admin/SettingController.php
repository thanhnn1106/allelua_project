<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Validator;

class SettingController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

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
                'setting_link_facebook'     => 'nullable|url',
                'setting_link_twitter'      => 'nullable|url',
                'setting_link_youtube'      => 'nullable|url',
                'setting_link_zalo'         => 'nullable|url',
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_setting_socical')
                            ->withErrors($validator)
                            ->withInput();
            }

            $params = array(
                'setting_rate' => $request->get('setting_rate'),
                'setting_link_facebook' => $request->get('setting_link_facebook'),
                'setting_link_twitter' => $request->get('setting_link_facebook'),
                'setting_link_youtube' => $request->get('setting_link_youtube'),
                'setting_link_zalo' => $request->get('setting_link_zalo'),
            );

            $data = array();
            if ( ! empty($params['setting_rate'])) {
                $data[] = array(
                    'key' => 'setting_rate',
                    'value' => $params['setting_rate'],
                );
            }
            if ( ! empty($params['setting_link_facebook'])) {
                $data[] = array(
                    'key' => 'setting_link_facebook',
                    'value' => $params['setting_link_facebook'],
                );
            }
            if ( ! empty($params['setting_link_twitter'])) {
                $data[] = array(
                    'key' => 'setting_link_twitter',
                    'value' => $params['setting_link_twitter'],
                );
            }
            if ( ! empty($params['setting_link_youtube'])) {
                $data[] = array(
                    'key' => 'setting_link_youtube',
                    'value' => $params['setting_link_youtube'],
                );
            }
            if ( ! empty($params['setting_link_zalo'])) {
                $data[] = array(
                    'key' => 'setting_link_zalo',
                    'value' => $params['setting_link_zalo'],
                );
            }
            if (count($data)) {
                foreach ($data as $item) {
                    $row = \App\Settings::where('key', $item['key'])->first();
                    if ($row !== null) {
                        $row->value = $item['value'];
                        $row->save();
                    } else {
                        $row = new \App\Settings();
                        $row->key = $item['key'];
                        $row->value = $item['value'];
                        $row->save();
                    }
                }

                $request->session()->flash('success', trans('common.msg_update_success'));
            } else {
                $request->session()->flash('success', trans('common.not_data_update'));
            }
            return redirect(route('admin_setting_socical'));
        }

        return view('admin/setting/form', [
            'setting'      => $setting,
        ]);
    }
}
