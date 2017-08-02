<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use App\Product;
use Validator;
use Cart;

class CheckoutController extends BaseController
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
        $langs = \App\Languages::getResults();
        $categories = \App\Categories::getRowByLang($this->lang);

        $productBestPrice = $this->loadProductBestPrice();
        $cartCollection = Cart::getContent();

        $data = array(
            'languages' => $langs,
            'categories' => $categories,
            'product' => null,
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'productWatched' => $this->loadProductWatched(),
            'totalCart' => $cartCollection->count(),
            'cartList'  => $cartCollection,
            'totalPrice' => Cart::getTotal(),
        );

        if ($request->isMethod('post')) {

            $rules = array(
                'current_password' => 'required|min:8|max:32',
                'new_password' => 'required|min:8|max:32',
                'confirm_password' => 'required|min:8|max:32|same:new_password'
            );
            $validator = Validator::make($params, $rules);

            // Return view and error message when data invalid
            if ($validator->fails()) {

                return redirect()->route('seller_change_password')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $sellerInfo = User::find($userId);
                // Check current password
                if (Hash::check($params['current_password'], $sellerInfo->password)) {
                    $updateResult = User::updateSellerPassword($userId, $params['new_password']);
                    if ($updateResult) {
                        $messagesBag = trans('common.change_password.msg_changed_password_success');
                        return redirect('seller/change_password')->with('success', $messagesBag)->withInput();
                    }
                    $messagesBag = trans('common.change_password.msg_changed_password_failed');
                    return redirect('seller/change_password')->with('error', $messagesBag)->withInput();
                }
                $messagesBag = trans('common.change_password.msg_invalid_current_password');
                return redirect('seller/change_password/')->with('error', $messagesBag)->withInput();
            }
        }

        return view('front.checkout.form_info', $data);
    }
}
