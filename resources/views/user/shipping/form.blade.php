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
                            <h1 class="title-form text-xs-center">
                                Thông tin giao hàng
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
                                                    <span>Submit</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row form-quantity">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >{{ trans('front.checkout.full_name') }}</label>
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
                                                <label class="lbl-form-control" >{{ trans('front.checkout.address') }}</label>
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
                                                <label class="lbl-form-control" >{{ trans('front.checkout.phone') }}</label>
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
                            </div>

                            <div style="border: 1px solid red;">
                                <h3>Thông tin tài khoản của Seller</h3>
                                <p>Tên ngân hàng: </p>
                                <p>Tài khoản ngân hàng: </p>
                                <p>Địa chỉ: </p>
                            </div>

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
