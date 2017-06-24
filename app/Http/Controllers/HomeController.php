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

        return view('home', [
            'langs' => \App\Languages::getResults(),
            'generals' => \App\Generals::getResultsByLang($langCode),
            'categories' => $filters,
        ]);
    }
}
