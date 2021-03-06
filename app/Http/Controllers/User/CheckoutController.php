<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use App\Product;
use Validator;
use Cart;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\ConfirmOrderMail;
use Mail;

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

        // Get firstime shipping info of user
        $customerInfo = \App\CustomerShipping::where('user_id', '=', Auth::user()->id)->orderBy('is_default', 'DESC')->first();

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
            'customerInfo' => $customerInfo,
        );

        if ($request->isMethod('post')) {

            if($cartCollection->count() === 0) {
                $request->session()->flash('error', trans('front.product.no_product_to_payment'));
                    return redirect(route('user_checkout_shipping'));
            }

            $customerShippingId = $request->get('customer_shipping_id');
            $rules = array(
                'full_name' => 'required|max:255',
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

                $customerInfo = \App\CustomerShipping::where('id', $customerShippingId)->where('user_id', Auth::user()->id)->first();
                if($customerInfo === NULL) {
                    $customerInfo = new \App\CustomerShipping();
                    $customerInfo->user_id = Auth::user()->id;
                    $customerInfo->full_name = $request->get('full_name');
                    $customerInfo->address = $request->get('address');
                    $customerInfo->phone = $request->get('phone');
                    $customerInfo->save();
                }

                // Push information to order
                $order = new \App\Order();
                $order->user_id = Auth::user()->id;
                $order->status = config('allelua.order_status_value.waiting_process'); // pending
                $order->full_name = $customerInfo->full_name;
                $order->address = $customerInfo->address;
                $order->phone = $customerInfo->phone;
                $order->save();

                // Get product item from Cart
                if($cartCollection->count()) {
                    foreach ($cartCollection as $cart) {
                        $orderItem = new \App\OrderItem();
                        $orderItem->order_id = $order->id;
                        $orderItem->seller_id = $cart->attributes->seller_id;
                        $orderItem->product_id = $cart->id;
                        $orderItem->product_name = $cart->name;
                        $orderItem->price = $cart->price;
                        $orderItem->quantity = $cart->quantity;
                        $orderItem->image_rand = $cart->attributes->image_rand;
                        $orderItem->image_real = $cart->attributes->image_real;
                        $orderItem->created_at = date('Y-m-d H:i:s');
                        $orderItem->save();

                        // Decrease quantity in product after order success
                        $product = Product::find($cart->id);
                        if($product !== NULL) {
                            $product->quantity = $product->quantity - $cart->quantity;
                            $product->save();
                        }
                    }
                }

                DB::commit();

                // Remove cart after insert order success
                if($cartCollection->count()) {
                    foreach ($cartCollection as $cart) {
                        Cart::remove($cart->id);
                    }
                }

                // Send mail confirm order
                $emailContentData = array(
                    'toEmail'      => Auth::user()->email,
                    'customerName' => Auth::user()->full_name,
                    'cartList'     => $cartCollection,
                );
                Mail::to($emailContentData['toEmail'])->send(new ConfirmOrderMail($emailContentData));
                $request->session()->flash('success', trans('front.product.buy_success_sale_group_will_contact_later'));

                return redirect(route('user_order_history'));
            } catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('error', trans('common.msg_error_transaction'));

                return redirect(route('user_checkout_shipping'));
            }

        }

        return view('user.shipping.form', $data);
    }
}
