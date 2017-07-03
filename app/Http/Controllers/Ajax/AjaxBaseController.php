<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxBaseController extends Controller
{
    protected $lang;
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->lang = \App::getLocale();

        $this->middleware(function ($request, $next) {
             if(\Auth::check() ) {
                $this->user = \Auth::user();
            }

            return $next($request);
        });
    }

    protected function checkUploadFile($request)
    {
        if ( ! $request->hasFile('files')) {
            return response()->json(array('error' => trans('common.please_select_valid_file_type')));
        }

        $rules = array();
        $nbr = count($request->input('files')) - 1;

        foreach(range(0, $nbr) as $index) {
            $rules['files.' . $index] = 'max:2048|mimes:'.config('product.file_accept_types');;
        }
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('error' => 1, 'result' => $validator->errors()));
        }
        return '';
    }
}
