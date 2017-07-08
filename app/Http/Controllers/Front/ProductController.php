<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;

class ProductController extends BaseController
{
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

        if ($cateObj !== NULL) {
            $arrCateId = (array) $cateObj->id;
            $productBestPrice = $this->loadProductBestPrice($arrCateId);

            if ( ! empty($cateObj->id)) {
                $subCate = \App\Categories::getRowByLang($this->lang, $cateObj->id);
            }

            $products = $this->loadProductCateFilter($request, $cateObj->id);
            if($products->count() === $products->total()) {
                $isFinalProduct = true;
            }
        }

        return view('front.product.index', [
            'cateObj' => $cateObj,
            'subCate' => $subCate,
            'productWatched' => $this->loadProductWatched(),
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'products' => $products,
            'isFinalProduct' => $isFinalProduct,
        ]);
    }

    public function loadSub(Request $request, $slug, $id)
    {
        $cateObj = \App\Categories::getCateSubCate($this->lang, $slug, $id);

        $productBestPrice = NULL;
        $products = NULL;
        $isFinalProduct = false;

        if ($cateObj !== NULL) {
            $arrCateId = (array) $cateObj->id;
            $productBestPrice = $this->loadProductBestPrice($arrCateId);

            $products = $this->loadProductSubCateFilter($request, $cateObj->id);
            if($products->count() === $products->total()) {
                $isFinalProduct = true;
            }
        }

        return view('front.product.index', [
            'cateObj' => $cateObj,
            'productWatched' => $this->loadProductWatched(),
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'products' => $products,
            'isFinalProduct' => $isFinalProduct,
        ]);
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
        }

        return view('front.product.detail', [
            'product' => $product,
            'productImages' => $productImages,
            'personal' => $personal,
            'productWatched' => $this->loadProductWatched(),
        ]);
    }
}
