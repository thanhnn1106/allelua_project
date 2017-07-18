@if(isset($sizes) && count($sizes))
<?php 
    $sizeDefine = isset($loadStyles['size']) ? $loadStyles['size'] : '';
?>
<div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
    <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="" >
        <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="" rel="nofollow" >
            {{ trans('front.partial.filter.size_type') }}
            <span class="fillter-direct" >
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </span>
        </a>
    </div>
    <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
        @foreach($sizes as $size)
        <div class="list-fillter-check clearfix" >
            <div class="coz-item-check_xxx" data-id="" >
                <!--
                <div class="coz-check-box" >
                    <span></span>
                    <input type="checkbox" name="size[]" value="{{ $size->size }}" style="display: none" data-id="" data-input="size" >
                </div>
                -->
                <div class="coz-lable-check" >
                    <a href="{{ formatRouteSearch(array('size' => $size->size)) }}">
                        <span class="coz-label-check-inner">@if(isset($sizeDefine[$size->size])){{ trans($sizeDefine[$size->size]) }} @endif</span>
                        <span class="coz-sum-check" >({{ formatNumber($size->total) }})</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif