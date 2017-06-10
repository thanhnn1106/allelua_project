<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class LangController extends BaseController
{
    public function index(Request $request)
    {
        $lang = $request->get('lt');

        if (in_array($lang, $this->getIso2Lang())) {
            \Session::put('applocale', $lang);
        }
        return redirect()->back();
    }
}