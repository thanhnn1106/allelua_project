@if(isset($materials) && count($materials))
<?php 
    $materialDefine = isset($loadStyles['material']) ? $loadStyles['material'] : '';
?>
<div class="fillter-item clearfix" data-place="itemFillter" data-id="" >
    <div class="header-item-fillter clearfix" data-place="itemHeaderFillter" data-id="" >
        <a class="fillter-toogle" href="javascript:void(0);" data-btn="toggleFillter" data-id="" rel="nofollow" >
            {{ trans('front.partial.filter.material_type') }}
            <span class="fillter-direct" >
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </span>
        </a>
    </div>
    <div class="body-item-fillter clearfix" data-place="itemBodyFillter" data-id="" >
        @foreach($materials as $keyM => $totalM)
        <div class="list-fillter-check clearfix" >
            <div class="coz-item-check_xxx" data-id="" >
                <!--
                <div class="coz-check-box" >
                    <span></span>
                    <input type="checkbox" name="material[]" value="{{ $keyM }}" style="display: none" data-id="" data-input="material" >
                </div>
                -->
                <div class="coz-lable-check" >
                    <a href="{{ formatRouteSearch(array('material' => $keyM)) }}">
                        <span class="coz-label-check-inner">@if(isset($materialDefine[$keyM])) {{ trans($materialDefine[$keyM]) }} @endif</span>
                        <span class="coz-sum-check" >({{ formatNumber($totalM) }})</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif