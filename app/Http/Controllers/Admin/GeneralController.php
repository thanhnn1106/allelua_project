<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Generals;

class GeneralController extends BaseController
{
    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        $generals = Generals::getResults();

        $arrGeneral = array();
        if($generals !== NULL) {
            foreach ($generals as $general) {
                $arrGeneral[$general->language_code] = array(
                    'title'       => $general->title,
                    'description' => $general->description,
                    'seo_keyword' => $general->seo_keyword,
                    'logo'        => $general->logo,
                );
            }
        }

        $langs = \App\Languages::getResults();
        if ($request->isMethod('POST')) {

            $rules =  $this->_setRules($request, $langs);

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_setting_general')
                            ->withErrors($validator)
                            ->withInput();
            }

            foreach ($langs as $lang) {
                $title       = $request->get('title_'.$lang->iso2);
                $description = $request->get('description_'.$lang->iso2);
                $seoKeyword  = $request->get('seo_keyword_'.$lang->iso2);
                $chk         = $request->get('check_'.$lang->iso2);

                $data = null;
                if ($request->hasFile('logo_'.$lang->iso2)) {
                    $data = $this->_uploadLogo($request->file('logo_'.$lang->iso2));
                }

                $row = Generals::where('language_code', $lang->iso2)->first();
                if ($row !== null) {
                    $row->title       = $title;
                    $row->description = $description;
                    $row->seo_keyword = $seoKeyword;
                    if (isset($data['rand_name'])) {
                        $this->removeFile($row->logo);
                        $row->logo = $data['rand_name'];
                    } else if ((int) $chk === 1 && $data === null) {
                        $this->removeFile($row->logo);
                        $row->logo = null;
                    }
                    $row->save();
                }
            }

            $request->session()->flash('success', trans('common.update_success'));
            return redirect(route('admin_setting_general'));
        }

        return view('admin/general/form', [
            'general'      => null,
            'languages'    => $langs,
            'generals'     => $arrGeneral,
        ]);
    }

    private function _setRules($request, $langs)
    {
        $rules = array();
        foreach ($langs as $lang) {

            $rules['title_'.$lang->iso2] = 'max:255';
            $rules['check_'.$lang->iso2] = 'in:1';
            if($request->hasFile('logo_'.$lang->iso2)) {
                $rules['logo_'.$lang->iso2]  = 'max:2048|mimes:jpeg,gif,png';
            }
        }
        return $rules;
    }

    private function _uploadLogo($file)
    {
        $path = config('allelua.general_logo.path_upload_logo');
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid().'.'.$extension;
        $file->move(public_path().$path, $fileName);

        return array(
            'rand_name' => $path . '/' . $fileName,
            'real_name' => $path . '/' . $file->getClientOriginalName(),
            'base_name' => $file->getClientOriginalName(),
        );
    }
}
