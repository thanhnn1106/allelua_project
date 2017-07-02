<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;

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
    public function index(Request $request)
    {
        $langCode = $this->lang;
        $categories = \App\Categories::getRowByLang($langCode);
        $filters = [];

        foreach ($categories as $item) {
            if (empty($item->parent_id)) {
                $filters[$item->id] = array(
                    'title' => $item->title,
                    'slug' => $item->slug,
                );
            }
            if(isset($filters[$item->parent_id])) {
                $filters[$item->parent_id]['childs'][$item->id] = array(
                    'id'    => $item->id,
                    'title' => $item->title,
                    'slug' => $item->slug,
                );
            }
        }

        return view('front.home.index', [
            'langs' => \App\Languages::getResults(),
            'generals' => \App\Generals::getResultsByLang($langCode),
            'categories' => $filters,
            'cssClass' => 'page-home',
        ]);
    }
}
