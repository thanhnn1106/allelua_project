<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use App\Languages;
use App\Statics;

class HomeController extends BaseController
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
        $cateHomes = \App\Categories::getCategoryHome($this->lang, null);
        $categories = $this->loadMenuFront();
        $arrCateId = array_keys($categories);

        $productBestPrice = $this->loadProductBestPrice($arrCateId);
        $staticPageMenu = Statics::getPageInfoListByLang(\App::getLocale());
        $arrStaticPage = array();
        foreach ($staticPageMenu as $item) {
            $arrStaticPage[$item->type] = array(
               'title' => $item->title,
               'slug' => $item->slug,
            );
        }

        return view('front.home.index', [
            'langs' => \App\Languages::getResults(),
            'generals' => \App\Generals::getResultsByLang($this->lang),
//            'categories' => $categories,
            'cateHomes' => $cateHomes,
            'productWatched' => $this->loadProductWatched(),
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'cssClass' => 'page-home',
            'staticPage' => $arrStaticPage,
        ]);
    }
}
