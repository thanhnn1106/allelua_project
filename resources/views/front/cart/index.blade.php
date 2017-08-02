@extends('front.layout')
@section('content')
    <div class="clearfix" >
        <ul class="breadcrumbs" >
            <li class="home" ><a href="{{ route('home') }}" >{{ trans('front.bread_crum.home') }}</a></li>
            <li>
                <span>{{ trans('front.cart.badge') }} ({{ sprintf(trans('front.cart.total_product'), $totalCart) }})</span>
            </li>
        </ul>
    </div>

    <div class="inner-page-main" data-align-height="wrap">
        @include('notifications')
        @if($totalCart > 0)
        <div class="row">
            <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="page-right clearfix">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="content-center">
                                <div class="inner-content-center clearfix">
                                    <form action="{{ route('cart_update') }}" method="POST">
                                    <div class="shopping-cart clearfix">
                                        <div class="list-cart-item clearfix">
                                            <!-- BEGIN CART LISTS -->
                                            @include('front.cart.partial.list')
                                            <!-- END CART LISTS -->
                                        </div>

                                        <div class="wrap-update-cart">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-block btn-style btn-heart">{{ trans('front.cart.but_update_cart') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sizebar-left col-ex-2 col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="right-cart">

                    <div id="box-total-cart" class="box-total">
                        <div class="fee-cart">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="txt-lb-total">{{ trans('front.cart.price_total') }}</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="txt-price-fee text-xs-right">{{ formatPrice($totalPrice) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="total-cart">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="txt-lb-total">{{ trans('front.cart.price_money') }}</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="text-xs-right">
                                        <div class="txt-price-total">{{ formatPrice($totalPrice) }}</div>
                                        <div class="txt-tax-total">{{ trans('front.cart.vat') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-cart-continue clearfix">
                        <button type="button" onclick="window.location.href='{{ route('checkout_form_infor') }}';" class="btn btn-block btn-style btn-cart">{{ trans('front.cart.but_order_process') }}</button>
                    </div>

                    <!--
                    <div class="box-discount">
                        <div class="title-discount">Mã giảm giá / Quà tặng</div>
                        <div class="discount-panel">
                            <form class="discount-form">
                                <input type="text" name="n" class="input-dc">
                                <button class="discount-btn">Đồng ý</button>
                            </form>
                        </div>
                    </div>
                    -->

                </div>
            </div>

        </div>
        @else
        <div class="row">{{ trans('common.data_not_found') }}</div>
        @endif
    </div>

@endsection

@section('footer_script')
<script src="{{ asset_front('js/cart.js') }}"></script>
@endsection