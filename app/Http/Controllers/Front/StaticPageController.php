<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use App\StaticsTranslate;

class StaticPageController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug)
    {
        $pageInfo = StaticsTranslate::getStaticsTranslateBySlug($slug);

        return view('front.home.about', [
            'pageInfo' => $pageInfo
        ]);
    }
}
