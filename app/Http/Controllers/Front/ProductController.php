<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use Cart;

class ProductController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadCate(Request $request, $slug)
    {
        $cateObj = \App\Categories::getCateSubCate($this->lang, $slug);

        $productBestPrice = NULL;
        $subCate = NULL;
        $products = NULL;
        $isFinalProduct = false;
        $loadStyles = NULL;
        $attrs = array();

        if ($cateObj !== NULL) {
            $arrCateId = (array) $cateObj->id;
            $productBestPrice = $this->loadProductBestPrice($arrCateId);

            if ( ! empty($cateObj->id)) {
                $subCate = \App\Categories::getRowByLang($this->lang, $cateObj->id);
            }

            $params = $this->loadProductCateFilter($request, $cateObj->id);
            $products = \App\Product::getProductFilter($params);
            if($products->count() === $products->total()) {
                $isFinalProduct = true;
            }
            $loadStyles = $this->getStyle($cateObj->type);
            $loadStyles = $this->getPrice($loadStyles, $cateObj->type);
            $attrs = $this->loadFilterAttr($loadStyles, $params);
        }

        $dataView = [
            'cateObj' => $cateObj,
            'subCate' => $subCate,
            'productWatched' => $this->loadProductWatched(),
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'products' => $products,
            'isFinalProduct' => $isFinalProduct,
            'loadStyles' => $loadStyles,
            'urlSearch' => route('product_load_cate', array('slug' => $slug))
        ];
        $dataView = array_merge($dataView, $attrs);

        return view('front.product.index', $dataView);
    }

    public function loadSub(Request $request, $slug, $id)
    {
        $cateObj = \App\Categories::getCateSubCate($this->lang, $slug, $id);

        $productBestPrice = NULL;
        $products = NULL;
        $isFinalProduct = false;
        $loadStyles = NULL;
        $attrs = array();

        if ($cateObj !== NULL) {
            $arrCateId = (array) $cateObj->id;
            $productBestPrice = $this->loadProductBestPrice($arrCateId);

            $params = $this->loadProductSubCateFilter($request, $cateObj->id);
            $products = \App\Product::getProductFilter($params);
            if($products->count() === $products->total()) {
                $isFinalProduct = true;
            }
            $loadStyles = $this->getStyle($cateObj->cate_type, $cateObj->type);
            $loadStyles = $this->getPrice($loadStyles, $cateObj->cate_type, $cateObj->type);
            $attrs = $this->loadFilterAttr($loadStyles, $params);
        }

        $dataView = [
            'cateObj' => $cateObj,
            'productWatched' => $this->loadProductWatched(),
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'products' => $products,
            'isFinalProduct' => $isFinalProduct,
            'loadStyles' => $loadStyles,
            'urlSearch' => route('product_load_sub_cate', array('slug' => $slug, 'id' => $id))
        ];
        $dataView = array_merge($dataView, $attrs);

        return view('front.product.index', $dataView);
    }

    public function detail(Request $request, $slug)
    {
        $id = getIdFromSlug($slug);
        $params = array(
            'product_id' => $id,
            'language_code' => $this->lang,
        );
        $product = \App\Product::getProductDetail($params);

        $personal = NULL;
        $productImages = NULL;
        if ($product !== NULL) {
            $personal = \App\Personal::getPersonalInfo($this->lang, $product->user_id);
            $productImages = $this->loadImageDetails($product);

            // Update view number of product
            $objProduct = \App\Product::find($product->id);
            $objProduct->view_number = $objProduct->view_number + 1;
            $objProduct->save();
        }

        $cartCollection = Cart::getContent();
        $totalQuantity = Cart::getTotalQuantity();

        return view('front.product.detail', [
            'product' => $product,
            'productImages' => $productImages,
            'personal' => $personal,
            'productWatched' => $this->loadProductWatched(),
            'totalCart' => $cartCollection->count(),
            'totalQuantity' => ($totalQuantity > 0) ? $totalQuantity : 1,
        ]);
    }
}
