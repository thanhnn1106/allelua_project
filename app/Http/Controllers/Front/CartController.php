<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use App\Product;
use Validator;
use Cart;

class CartController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        try {
            $productId = $request->get('product_id');
            $product = Product::where('id', $productId)->where('status', config('product.product_status.value.publish'))->first();
            if($product === NULL) {
                return response()->json(array('error' => 1, 'result' => trans('common.data_not_found')));
            }

            // validate the info, create rules for the inputs
            $rules = array(
                'quantity'    => 'required|integer',
            );
            $validator = Validator::make($request->all(), $rules);

            $cartTotalQuantity = Cart::getTotalQuantity();
            if($cartTotalQuantity === 0) {
                $cartTotalQuantity = $request->get('quantity');
            }

            $validator->after(function ($validator) use ($request, $cartTotalQuantity, $product) {
                if ($cartTotalQuantity > $product->quantity_limit) {
                    $validator->errors()->add('quantity', sprintf('The quantity in cart more than %d', $product->quantity_limit));
                }
            });

            if ($validator->fails()) {
                return response()->json(array('error' => 1, 'result' => trans('common.please_check_form_below'), 'messages' => $validator->errors()), 422);
            }
            $productTrans = $product->productTranslates()->where('language_code', $this->lang)->first();
            $name = ($productTrans !== NULL) ? $productTrans->title : NULL;

            $cartRow = Cart::get($productId);
            if ($cartRow !== NULL) {
                Cart::update($productId, array('quantity' => $request->get('quantity')));
            } else {
                Cart::add(array('id' => $productId, 'name' => $name, 'quantity' => $request->get('quantity'), 'price' => $product->price));
            }

            return response()->json(array('error' => 0, 'result' => $cartTotalQuantity));

        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.error_exception_ajax')));
        }
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

            $products = $this->loadProductSubCateFilter($request, $cateObj->id);
            if($products->count() === $products->total()) {
                $isFinalProduct = true;
            }
            $loadStyles = $this->getStyle($cateObj->cate_type, $cateObj->type);
            $loadStyles = $this->getPrice($loadStyles, $cateObj->cate_type, $cateObj->type);

            $params = array(
                'language_code' => $this->lang,
                'sub_category_id' => $cateObj->id,
            );
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

        return view('front.product.detail', [
            'product' => $product,
            'productImages' => $productImages,
            'personal' => $personal,
            'productWatched' => $this->loadProductWatched(),
        ]);
    }
}
