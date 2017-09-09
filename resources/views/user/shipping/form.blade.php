@extends('front.layout')

@section('content')

<div class="clearfix">
    <ul class="breadcrumbs">
        <li class="home">
            <a href="{{ route('home') }}">{{ trans('front.bread_crum.home') }}</a>
        </li>
        <li><span>{{ trans('front.checkout.infor') }}</span></li>
    </ul>
</div>

<!-- upload product -->
<div class="row">
    <div class="col-sm-12">
        <div class="content-center">
            <div class="inner-content-center clearfix" >
                <div class="row" >
                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12"  >
                        <div class="wrap-form clearfix" >
                            @if(isset($totalCart) && $totalCart)
                            <h1 class="title-form text-xs-center">
                                <strong>{{ trans('front.shipping_page.lb_shipping_info') }}</strong>
                            </h1>
                            <div class="content-form" >
                                @include('notifications')
                                <form id="form_checkout" name="form_checkout" class="clearfix" action="{{ route('user_checkout_shipping') }}" method="POST" >
                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-sm-offset-4" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="customer_shipping_id" value="{{ isset($customerInfo->id) ? $customerInfo->id : '' }}" />
                                                <button type="submit" class="btn btn-style" title="{{ trans('front.product.make_product') }}" >
                                                    <span>{{ trans('front.shipping_page.btn_submit') }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row form-quantity">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >{{ trans('front.shipping_page.lb_customer_name') }}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', isset($customerInfo->full_name) ? $customerInfo->full_name : '') }}" />
                                                @if ($errors->has('full_name'))
                                                    <p class="input-error">{{ $errors->first('full_name') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row form-quantity">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >{{ trans('front.shipping_page.lb_address') }}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <textarea class="form-control" id="address" name="address">{{ old('address', isset($customerInfo->address) ? $customerInfo->address : '') }}</textarea>
                                                @if ($errors->has('address'))
                                                    <p class="input-error">{{ $errors->first('address') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row form-quantity">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >{{ trans('front.shipping_page.lb_phone_number') }}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', isset($customerInfo->phone) ? $customerInfo->phone : '') }}" />
                                                @if ($errors->has('phone'))
                                                    <p class="input-error">{{ $errors->first('phone') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                <h1 class="title-form text-xs-center">
                                    <strong>{{ trans('front.shipping_page.lb_invoice_info') }}</strong>
                                </h1>
                                <div>
                                    <table class="allelua-table-cart">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('front.shipping_page.lb_product_image') }}</th>
                                            <th>{{ trans('front.shipping_page.lb_product_name') }}</th>
                                            <th>{{ trans('front.shipping_page.lb_price') }}</th>
                                            <th>{{ trans('front.shipping_page.lb_quantity') }}</th>
                                            <th>{{ trans('front.shipping_page.lb_total') }}</th>
                                        </tr>
                                        <?php
                                            $index = 0;
                                            $totalAmount = 0;
                                        ?>
                                        @foreach($cartList as $cart)
                                        <?php
                                            $index++;
                                            $totalAmount += formatNumber($cart->quantity * $cart->price);
                                        ?>
                                        <tr>
                                            <td>{{ $index }}</td>
                                            <?php $imageInfo = getImage($cart->attributes->image_rand, $cart->attributes->image_real); ?>
                                            <td>
                                                <a href="{{ makeSlug($cart->attributes->slug, $cart->id) }}" title="{{ $cart->name }}" class="link-product" >
                                                    <img src="{{ $imageInfo['href'] }}" alt="{{ $imageInfo['base_name'] }}" class="img-fluid" >
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ makeSlug($cart->attributes->slug, $cart->id) }}" title="{{ $cart->name }}">{{ $cart->name }}</a>
                                            </td>
                                            <td>{{ formatPrice($cart->price) }}</td>
                                            <td>{{ formatNumber($cart->quantity) }}</td>
                                            <td>{{ formatPrice(formatNumber($cart->quantity * $cart->price)) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" style="text-align: right;">{{ trans('front.shipping_page.lb_total_amount') }}</td>
                                            <td>{{ formatPrice($totalAmount) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @else
                            No product to payment
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <div class="inner-page-main"  data-align-height="wrap">
        <!-- BEGIN BEST PRICE -->
        @include('front.partial.best_price')
        <!-- END BEST PRICE -->
    </div>

    <!-- BEGIN BEST PRICE -->
    @include('front.partial.favorite')
    <!-- END BEST PRICE -->

    <!-- BEGIN RELATED PRODUCT -->
    @include('front.partial.related')
    <!-- END RELATED PRODUCT -->

    <!-- BEGIN COUNTRY AND SERVICE -->
    @include('front.partial.country_service')
    <!-- END COUNTRY AND SERVICE -->
@endsection
@section('footer_script')
<script>

</script>
@endsection
