@if(isset($prices) && count($prices))
<?php
    $minPrice = isset($priceMinMax->minPrice) ? $priceMinMax->minPrice : 0;
    $maxPrice = isset($priceMinMax->maxPrice) ? $priceMinMax->maxPrice : 0;
?>
<div class="fillter-item clearfix" data-place="itemFillter" data-id="price" >
    <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="price" >
        <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="price" rel="nofollow" >
            {{ trans('front.partial.filter.price_type') }}
            <span class="fillter-direct" >
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </span>
        </a>
    </div>
    <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="price" >
        <div class="clearfix wrap-ranger-price" >
            <input type="text" data-neo="ionRangeSlider"  data-min="{{ $minPrice }}" data-max="" data-grid="true" value="" name="{{ $maxPrice }}" data-input="price" />
        </div>
        <div class="price-from-to" >
            {{ trans('front.partial.filter.from_price') }}: 
            <span class="txt-ranger-from" data-place="valueRangerFrom" >{{ formatNumber($minPrice) }}</span> - 
            <span class="txt-ranger-to"  data-place="valueRangerTo" >{{ formatNumber($maxPrice) }}</span>
        </div>
    </div>
</div>

<div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
    <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
        @foreach($prices as $keyP => $totalP)
        <div class="list-fillter-check clearfix" >
            <div class="coz-item-check_xxx" data-id="" >
                <!--
                <div class="coz-check-box" >
                    <span></span>
                    <input type="checkbox" name="size[]" value="{{ $keyP }}" style="display: none" data-id="" data-input="size" >
                </div>
                -->
                <div class="coz-lable-check" >
                    <a href="{{ formatRouteSearch(array('price' => $keyP)) }}">
                        <span class="coz-label-check-inner">{{ formatPriceLang($keyP) }}</span>
                        <span class="coz-sum-check" >({{ formatNumber($totalP) }})</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif