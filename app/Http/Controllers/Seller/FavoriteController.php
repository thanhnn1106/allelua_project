<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Seller\BaseController;
use Illuminate\Http\Request;
use App\ProductLike;
use App\Product;
use Auth;

class FavoriteController extends BaseController
{
    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        try {
            $userId = Auth::user()->id;
            $productId = $request->get('product_id');
            $product = Product::where('id', $productId)->where('status', config('product.product_status.value.publish'))->first();
            if($product === NULL) {
                return response()->json(array('error' => 1, 'result' => trans('common.data_not_found')));
            }

            $productLikes = $product->productLikes()->where('product_id', $productId)->where('user_id', $userId)->first();

            if($productLikes === NULL) {
                $productLikes = new ProductLike();
                $productLikes->user_id = $userId;
                $productLikes->product_id = $productId;
                $productLikes->created_at = date('Y-m-d H:i:s');
                $productLikes->save();
                $isLike = true;
            } else {
                $productLikes->delete();
                $isLike = false;
            }

            return response()->json(array('error' => 0, 'result' => '', 'isLike' => $isLike));
        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.error_exception_ajax')));
        }
    }
}
