@if(isset($styles) && count($styles))
<?php 
    $styleDefine = isset($loadStyles['style']) ? $loadStyles['style'] : '';
?>
<div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
    <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="" >
        <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="" rel="nofollow" >
            {{ trans('front.partial.filter.kind_type') }}
            <span class="fillter-direct" >
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </span>
        </a>
    </div>
    <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
        @foreach($styles as $keyS => $totalS)
        <div class="list-fillter-check clearfix" >
            <div class="coz-item-check_xxx" data-id="" >
                <!--
                <div class="coz-check-box" >
                    <span></span>
                    <input type="checkbox" name="kind[]" value="{{ $keyS }}" style="display: none" data-id="" data-input="kind" >
                </div>
                -->
                <div class="coz-lable-check" >
                    <a href="{{ formatRouteSearch(array('kind' => $keyS)) }}">
                        <span class="coz-label-check-inner">@if(isset($styleDefine[$keyS])) {{ trans($styleDefine[$keyS]) }} @endif</span>
                        <span class="coz-sum-check" >({{ formatNumber($totalS) }})</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif