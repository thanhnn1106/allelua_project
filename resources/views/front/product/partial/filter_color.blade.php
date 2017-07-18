@if(isset($colors) && count($colors))
<div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
    <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="" >
        <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="" rel="nofollow" >
            {{ trans('front.partial.filter.color_type') }}
            <span class="fillter-direct" >
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </span>
        </a>
    </div>
    <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
        @foreach($colors as $color)
        <div class="list-fillter-check clearfix" >
            <div class="coz-item-check_xxx" data-id="" >
                <!--
                <div class="coz-check-box" >
                    <span></span>
                    <input type="checkbox" name="color[]" value="0" style="display: none" data-id="" data-input="color" >
                </div>
                -->
                <div class="coz-lable-check" >
                    <a href="{{ formatRouteSearch(array('color' => $color->color)) }}">
                        <span class="coz-label-check-inner">{{ $color->color }}</span>
                        <span class="coz-sum-check" >({{ formatNumber($color->total) }})</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif