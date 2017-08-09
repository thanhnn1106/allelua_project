<?php

namespace App\Http\Controllers\User;

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

            $customerShippingId = $request->get('customer_shipping_id');
            $rules = array(
                'full_name' => 'required|max:255',
//                'city' => 'required',
//                'district' => 'required',
//                'ward' => 'required',
                'address' => 'required|max:255',
                'phone' => 'required|max:255',
            );
            $validator = Validator::make($request->all(), $rules);

            // Return view and error message when data invalid
            if ($validator->fails()) {

                return redirect()->route('user_checkout_shipping')
                            ->withErrors($validator)
                            ->withInput();
            }

            DB::beginTransaction();
            try {

                $customerInfo = \App\CustomerShipping::find($customerShippingId);
                if($customerInfo === NULL) {
                    $customerInfo = new \App\CustomerShipping();
                    $customerInfo->full_name = $request->get('full_name');
                    $customerInfo->address = $request->get('address');
                    $customerInfo->phone = $request->get('phone');
                    $customerInfo->save();
                }

                // Push information to order
                $order = new \App\Order();
                $order->user_id = Auth::user()->id;
                $order->status = 1; // success
                $order->full_name = $customerInfo->full_name;
                $order->address = $customerInfo->address;
                $order->phone = $customerInfo->phone;
                $order->save();

                // Get product item from Cart

                DB::commit();

                $request->session()->flash('success', trans('front.product.buy_success_sale_group_will_contact_later'));
                return redirect(route('user_checkout_shipping'));

            } catch (\Exception $e) {
                DB::rollback();

                $request->session()->flash('error', trans('common.fail'));
                return redirect(route('user_checkout_shipping'));
            }

        }

        return view('user.shipping.form', $data);
    }
}
