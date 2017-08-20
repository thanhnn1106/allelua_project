@extends('front.layout')
@section('content')

    <div class="inner-page-main" data-align-height="wrap">
        <div class="row" >
            <!-- BEGIN ADVERTISEMENT -->
            @include('front.partial.ad')
            <!-- BEGIN ADVERTISEMENT -->

            <!-- BEGIN CATEGORY -->
            @include('front.menu')
            <!-- END CATEGORY -->
        </div>
    </div>

    <div class="inner-page-main"  data-align-height="wrap">
        <!-- BEGIN BEST PRICE -->
        @include('front.partial.best_price')
        <!-- END BEST PRICE -->
    </div>

    <!-- BEGIN RELATED PRODUCT -->
    @include('front.partial.related')
    <!-- END RELATED PRODUCT -->

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