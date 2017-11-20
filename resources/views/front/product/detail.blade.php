@extends('front.layout')
@section('content')
<div class="container">
    <div class="clearfix" >
        <ul class="breadcrumbs" >
            <li class="home" ><a href="{{ route('home') }}" >{{ trans('front.bread_crum.home') }}</a></li>
            @if(isset($product) && $product)
            <li>
                <a href="{{ makeSlug($product->cate_slug) }}" >{{ $product->cate_title }}</a>
            </li>
            @if(!empty($product->sub_category_id))
            <li>
                <a href="{{ makeSlug($product->sub_cate_slug, $product->sub_category_id, false) }}" >{{ $product->sub_cate_title }}</a>
            </li>
            @endif
            <li>
                <span>{{ $product->title }}</span>
            </li>
            @endif
        </ul>
    </div>

    <div class="wrap-d-product" >
        <div class="alert alert-warning alert-block" style="display:none;">
            <p></p>
        </div>
        <div class="details-product clearfix" >
            @include('front.product.partial.detail_info')
        </div>
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
<script src="{{ asset_front('js/cart.js') }}"></script>
@endsection