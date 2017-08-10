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

            $cartRow = Cart::get($productId);

            $quantitySub = $request->get('quantity');
            if ($cartRow !== NULL) {
                $quantitySub = ($cartRow->quantity + $request->get('quantity'));
            }

            $validator->after(function ($validator) use ($request, $quantitySub, $product) {
                if ($quantitySub > $product->quantity_limit) {
                    $validator->errors()->add('quantity', sprintf('The quantity can not more than %d', $product->quantity_limit));
                }
            });

            if ($validator->fails()) {
                return response()->json(array('error' => 1, 'result' => trans('common.please_check_form_below'), 'messages' => $validator->errors()), 422);
            }
            $productTrans = $product->productTranslates()->where('language_code', $this->lang)->first();
            $name = ($productTrans !== NULL) ? $productTrans->title : NULL;

            if ($cartRow !== NULL) {
                Cart::update($productId, array('quantity' => $request->get('quantity')));
            } else {
                $info = array(
                    'id' => $productId, 
                    'name' => $name, 
                    'quantity' => $request->get('quantity'), 
                    'price' => $product->price,
                    'attributes' => array(
                        'seller_id' => $product->user_id,
                        'slug' => $product->slug,
                        'image_rand' => $product->image_rand,
                        'image_real' => $product->image_real,
                    )
                );
                Cart::add($info);
            }

            return response()->json(array('error' => 0, 'result' => $quantitySub));

        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.error_exception_ajax')));
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, $id)
    {
        $cartRow = Cart::get($id);
        if($cartRow === NULL) {
            $request->session()->flash('error', trans('front.cart.cart_not_found'));
            return redirect(route('cart_list'));
        }

        Cart::remove($id);

        $request->session()->flash('success', trans('common.update_success'));
        return redirect(route('cart_list'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cartCollection = Cart::getContent();
        $totalCart = Cart::getTotal();
        if ( ! $totalCart) {
            $request->session()->flash('error', trans('front.cart.cart_not_found'));
            return redirect(route('cart_list'));
        }

        $rules = array();
        foreach($cartCollection as $cart) {
            $product = Product::find($cart->id);
            $max = '';
            if($product !== NULL) {
                $max = '|max:' . $product->quantity_limit;
            }
            $rules['quantity_'.$cart->id] = 'required|integer'.$max;
        }

        // run the validation rules on the inputs from the form
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('cart_list'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $n = 0;
        foreach($cartCollection as $cart) {
            $rowCart = Cart::get($cart->id);
            if($rowCart !== NULL) {
                Cart::update($cart->id, array('quantity' => array('relative' => false, 'value' => $request->get('quantity_' . $cart->id))));
                $n++;
            }
        }
        $request->session()->flash('success', sprintf(trans('common.num_update_success'), $n));
        return redirect(route('cart_list'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Request $request)
    {
        $cartCollection = Cart::getContent();

        $dataView = array(
            'totalCart' => $cartCollection->count(),
            'cartList'  => $cartCollection,
            'totalPrice' => Cart::getTotal(),
        );

        return view('front.cart.index', $dataView);
    }
}
