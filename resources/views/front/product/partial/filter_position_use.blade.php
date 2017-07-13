@if(isset($positionUses) && count($positionUses))
<?php 
    $posDefine = isset($loadStyles['position_use']) ? $loadStyles['position_use'] : '';
?>
<div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
    <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="" >
        <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="" rel="nofollow" >
            {{ trans('front.partial.filter.position_use_type') }}
            <span class="fillter-direct" >
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </span>
        </a>
    </div>
    <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
        @foreach($positionUses as $position)
        <div class="list-fillter-check clearfix" >
            <div class="coz-item-check" data-id="" >
                <div class="coz-check-box" >
                    <span></span>
                    <input type="checkbox" name="position_use[]" value="{{ $position->position_use }}" style="display: none" data-id="" data-input="position_use" >
                </div>
                <div class="coz-lable-check" >
                    <span class="coz-label-check-inner">@if(isset($posDefine[$position->position_use])){{ trans($posDefine[$position->position_use]) }} @endif</span>
                    <span class="coz-sum-check" >({{ formatNumber($position->total) }})</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif