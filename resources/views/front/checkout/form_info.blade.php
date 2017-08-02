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
                                <form id="form_checkout" name="form_checkout" class="clearfix" action="{{ route('checkout_form_infor') }}" id="seller_form_product" method="POST" >
                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-sm-offset-4" >
                                                <button id="save_product" type="button" class="btn btn-style" title="{{ trans('front.product.make_product') }}" >
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
                                                <input type="text" class="form-control form-control-md" id="full_name" name="full_name" value="" />
                                                <div class="input-error"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row form-quantity">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >{{ trans('front.checkout.phone') }}</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control form-control-md" id="full_name" name="full_name" value="" />
                                                <div class="input-error"></div>
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
    </div>
</div>
<div id="content_img" style="display: none;">
    <a href="javscript:void(0);" class="img-review"></a>
</div>
<!-- end upload product -->

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

<?php 
    $initPreviewImage = isset($productImages['initialPreview']) ? json_encode($productImages['initialPreview']) : NULL;
    $initPreviewConfig = isset($productImages['initialPreviewConfig']) ? json_encode($productImages['initialPreviewConfig']) : NULL;
?>
@endsection
@section('footer_script')
<script>
var product_ajax_upload = '{{ route('ajax_product_upload_file') }}';
var product_ajax_delete = '{{ route('ajax_product_delete_file') }}';

var initialPreviewImg = initialPreviewConfigImg = [];
    @if( ! is_null($initPreviewImage))
    initialPreviewImg = {!! $initPreviewImage !!};
    @endif

    @if( ! is_null($initPreviewConfig))
    initialPreviewConfigImg = {!! $initPreviewConfig !!};
    @endif

</script>
<!-- bootstrap multiple upload -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
<script src="{{ asset('plugins/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<!--<script src="{{ asset_admin('/plugins/bootstrap-fileinput/themes/fa/theme.js') }}"></script>-->
<script src="{{ asset('/plugins/bootstrap-fileinput/js/locales/lang.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/themes/explorer/theme.js') }}"></script>
<script src="{{ asset_front('js/product.js') }}"></script>
@endsection
