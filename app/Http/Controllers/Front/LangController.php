<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;

class LangController extends BaseController
{
    public function index(Request $request, $lt)
    {
        if (in_array($lt, $this->getIso2Lang())) {
            \Session::put('applocale', $lt);
        }
        //return redirect()->back();
        return redirect(route('home'));
    }
}