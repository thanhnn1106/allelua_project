@extends('front.layout')
@section('content')
    <div class="clearfix" >
        <ul class="breadcrumbs" >
            <li class="home" ><a href="{{ route('home') }}" >{{ trans('front.bread_crum.home') }}</a></li>
            @if($cateObj)
            <li ><a href="{{ makeSlug($cateObj->slug, $cateObj->category_id) }}" >{{ $cateObj->title }}</a></li>
            @endif
            @if($cateChildObj)
            <li ><span >{{ $cateChildObj->title }}</span></li>
            @endif
        </ul>
    </div>

    <div class="inner-page-main" data-align-height="wrap">
        <div class="row" >
            <!-- BEGIN CATEGORY -->
            @include('front.partial.list_product')
            <!-- END CATEGORY -->

            <!-- BEGIN ADVERTISEMENT -->
            @include('front.partial.filter_product')
            <!-- BEGIN ADVERTISEMENT -->
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

    <!-- BEGIN COUNTRY AND SERVICE -->
    @include('front.partial.country_service')
    <!-- END COUNTRY AND SERVICE -->

@endsection

@section('footer_script')
<script>

</script>
@endsection