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
        $tagImage = null;
        $q = isset($_GET['q']) ? $_GET['q'] : NULL;

        if($request->isMethod('POST')) {

            // Set rules
            $rules = array(
                'search_image' => 'required|max:2048|mimes:'.config('product.file_accept_types'),
            );
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('search_page')
                            ->withErrors($validator)
                            ->withInput();
            }

            $imagick = new \Imagick($request->file('search_image')->getPathname());
            $langDefault = \App::getLocale();
            $tagImage = $imagick->getImageProperty('Exif:tag_image_'.$langDefault);
            $request->session()->put('tag_image', $tagImage);
        } else {
            if ($q !== NULL && $request->session()->has('tag_image')) {
                $request->session()->forget('tag_image');
            }
        }

        $isFinalProduct = false;
        $subCate        = null;
        $slug           = null;
        $loadStyles     = NULL;
        $products       = NULL;
        $attrs = array();

        $params   = $this->loadProductSearch($request, $tagImage);
        if( ! empty($params['keyword']) || ! empty($params['tag_image'])) {

            $products = \App\Product::getProductFilter($params);
            if($products->count() === $products->total()) {
                $isFinalProduct = true;
            }
            if ($products->total()) {
                $cateMatching = \App\Product::getCategoryMatchingSearch($params);
                if ($cateMatching !== NULL) {
                    $slug = $cateMatching->slug;
                    $subCate = \App\Categories::getRowByLang($this->lang, $cateMatching->category_id);

                    $loadStyles = $this->getStyle($cateMatching->type);
                    $loadStyles = $this->getPrice($loadStyles, $cateMatching->type);
                    $params['category_id'] = $cateMatching->category_id;
                    $attrs = $this->loadFilterAttr($loadStyles, $params);
                }
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
