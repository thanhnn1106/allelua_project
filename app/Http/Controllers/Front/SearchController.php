<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;

class SearchController extends BaseController
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
        $q = $request->get('q', NULL);

        if (empty($q)) {
            return redirect(route('home'));
        }

        $isFinalProduct = false;
        $subCate        = null;
        $slug           = null;

        $products = $this->loadProductSearch($request);
        if($products->count() === $products->total()) {
            $isFinalProduct = true;
        }
        if ($products->total()) {
            $params = array(
                'language_code' => $this->lang,
            );
            $cateMatching = \App\Product::getCategoryMatchingSearch($params);
            if ($cateMatching !== NULL) {
                $slug = $cateMatching->slug;
                $subCate = \App\Categories::getRowByLang($this->lang, $cateMatching->category_id);

                $loadStyles = $this->getStyle($cateMatching->type);
                $loadStyles = $this->getPrice($loadStyles, $cateMatching->type);
                $params = array(
                    'language_code' => $this->lang,
                    'category_id' => $cateMatching->category_id,
                );
                $attrs = $this->loadFilterAttr($loadStyles, $params);
            }
        }

        $productBestPrice = $this->loadProductBestPrice();

        $dataView = array(
            'subCate' => $subCate,
            'products' => $products,
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'productWatched' => $this->loadProductWatched(),
            'isFinalProduct' => $isFinalProduct,
            'loadStyles' => $loadStyles,
            'urlSearch' => route('product_load_cate', array('slug' => $slug))
        );
        $dataView = array_merge($dataView, $attrs);

        return view('front.product.search', $dataView);
    }
}
