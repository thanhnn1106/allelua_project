<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;

class HomeController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('front.home.index', [
            'langs' => \App\Languages::getResults(),
            'generals' => \App\Generals::getResultsByLang($this->lang),
            'categories' => $this->loadCategories(),
            'cssClass' => 'page-home',
        ]);
    }
}
