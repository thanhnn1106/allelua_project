<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use App\Contacts;
use Validator;

class ContactController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->isMethod('post')) {
            $postData = $request->all();
            $rules =  array(
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
                'image' => !empty($postData['image']) ? 'image|mimes:jpeg,png,jpg|max:2048' : '',
            );
            // run the validation rules on the inputs from the form
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()) {
                return redirect()->route('contact')
                            ->withErrors($validator)
                            ->withInput();
            }
            if (!empty($postData['image'])) {
                $image = $postData['image'];
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $input['imagename']);
                $postData['image'] = $input['imagename'];
            }
            $saveRequest = Contacts::saveContact($postData);
            return redirect()->route('contact')->with('success', trans('common.msg_update_success'));;
        }
        return view('front.home.contact');
    }
}
