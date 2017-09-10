@extends('front.layout')
@section('content')
<div class="container">
    <div class="clearfix" >
        <ul class="breadcrumbs" >
            <li class="home" ><a href="{{ route('home') }}" >{{ trans('front.bread_crum.home') }}</a></li>
            @if(isset($cateObj))
            <li>
                @if(!empty($cateObj->parent_id))
                <a href="{{ makeSlug($cateObj->cate_slug) }}" >{{ $cateObj->cate_title }}</a>
                @else
                <span>{{ $cateObj->title }}</span>
                @endif
            </li>
            @endif

            @if(!empty($cateObj->parent_id))
            <li>
                <span>{{ $cateObj->title }}</span>
            </li>
            @endif
        </ul>
    </div>

    <div class="inner-page-main" data-align-height="wrap">
        <div class="row" >
            @if(count($cateObj))
                <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-9 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-3 col-sm-push-0" data-align-height="right"  data-bottom="20" >
                    <div class="page-right clearfix" >
                        <div class="row" >
                            <div class="col-sm-12" >
                                <div class="content-center" >
                                    <div class="inner-content-center clearfix" >
                                        <div class="list-product clearfix" data-total="@if(isset($products)) {{ $products->total() }} @endif" data-start="@if(isset($products)) {{ $products->currentPage() }} @endif">
                                            <!-- BEGIN PRODUCT LISTS -->
                                            @include('front.product.partial.list_product')
                                            <!-- END PRODUCT LISTS -->
                                        </div>
                                        @if(isset($isFinalProduct) && $isFinalProduct === false)
                                        <div class="text-xs-center clearfix load-scroll" data-place="detectLoadMore" >[LOAD MORE]</div>
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