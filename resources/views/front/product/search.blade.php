@extends('front.layout')
@section('content')
<div class="container">
    <div class="clearfix" >
        <ul class="breadcrumbs" >
            <li class="home" ><a href="{{ route('home') }}" >{{ trans('front.bread_crum.home') }}</a></li>
            @if(app('request')->input('q'))
            <li>
                <span>{{ app('request')->input('q') }}</span>
            </li>
            @endif
        </ul>
    </div>
    @if ($errors->has('search_image'))
    <p class="help-block">{{ $errors->first('search_image') }}</p>
    @endif

    <div class="inner-page-main" data-align-height="wrap">
        <div class="row" >
            @if($products !== null && $products->total())
                <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-9 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-3 col-sm-push-0" data-align-height="right"  data-bottom="20" >
                    <div class="page-right clearfix" >
                        <div class="row" >
                            <div class="col-sm-12" >
                                <div class="content-center" >
                                    <div class="inner-content-center clearfix" >
                                        <div id="productList" class="list-product clearfix" data-total="@if(isset($products)) {{ $products->total() }} @endif" data-start="2">
                                            <!-- BEGIN PRODUCT LISTS -->
                                            @include('front.product.partial.list_product')
                                            <!-- END PRODUCT LISTS -->
                                        </div>
                                        @if(isset($isFinalProduct) && $isFinalProduct === false)
                                        <div class="text-xs-center clearfix load-scroll" data-url="{{ $urlLoadMore }}" data-place="detectLoadMore" ></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BEGIN ADVERTISEMENT -->
                @include('front.product.partial.filter_product')
                <!-- BEGIN ADVERTISEMENT -->
            @else
            <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-9 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-3 col-sm-push-0" data-align-height="right"  data-bottom="20" >
            <p>Data not found</p>
            </div>
            @endif
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
</div>
@endsection

@section('footer_script')
<script>

</script>
@endsection