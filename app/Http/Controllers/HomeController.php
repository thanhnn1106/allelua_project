<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');

        $this->lang = \App::getLocale();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $langCode = $this->lang;
        return view('home', [
            'langs' => \App\Languages::getResults(),
            'generals' => \App\Generals::getResultsByLang($langCode)
        ]);
    }
}
