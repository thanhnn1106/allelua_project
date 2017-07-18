@if(isset($brands) && count($brands))
<div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
    <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="" >
        <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="" rel="nofollow" >
            {{ trans('front.partial.filter.brand_type') }}
            <span class="fillter-direct" >
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </span>
        </a>
    </div>
    <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
        @foreach($brands as $brand)
        <div class="list-fillter-check clearfix" >
            <div class="coz-item-check_xxx">
                <!--
                <div class="coz-check-box" >
                    <span></span>
                    <input type="checkbox" name="brand[]" value="0" style="display: none" data-id="" data-input="brand" >
                </div>
                -->
                <div class="coz-lable-check" >
                    <a href="{{ formatRouteSearch(array('brand' => $brand->brand)) }}">
                        <span class="coz-label-check-inner">{{ $brand->brand }}</span>
                        <span class="coz-sum-check" >({{ formatNumber($brand->total) }})</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif