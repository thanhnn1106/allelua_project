<?php 
    $positionUse = isset($params['positionUse']) ? $params['positionUse'] : NULL;
    $size = isset($params['size']) ? $params['size'] : NULL;
    $style = isset($params['style']) ? $params['style'] : NULL;
    $material = isset($params['material']) ? $params['material'] : NULL;
?>

@if(isset($data['position_use']))
<div class="form-group form-position_use">
    <div class="row" >
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
            <label class="lbl-form-control" >{{ trans('front.product.position_use') }}</label>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <select name="position_use" id="position_use" class="form-control input-select2">
                <option value="">------</option>
                @foreach($data['position_use'] as $keyPos => $itemPos)
                <option value="{{ $keyPos }}" @if($positionUse == $keyPos) selected="selected" @endif>{{ trans($itemPos) }}</option>
                @endforeach
            </select>
            <div class="input-error"></div>
        </div>
    </div>
</div>
@endif

@if(isset($data['size']))
<div class="form-group form-size">
    <div class="row" >
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
            <label class="lbl-form-control" >{{ trans('front.product.size') }}</label>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <select name="size" id="size" class="form-control border-corner">
                <option value="">------</option>
                @foreach($data['size'] as $keySize => $itemSize)
                <option value="{{ $keySize }}" @if($size == $keySize) selected="selected" @endif>{{ trans($itemSize) }}</option>
                @endforeach`
            </select>
            <div class="input-error"></div>
        </div>
    </div>
</div>
@endif

@if(isset($data['style']))
<div class="form-group form-style">
    <div class="row" >
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
            <label class="lbl-form-control" >{{ trans('front.product.style') }}</label>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <select name="style" id="style" class="form-control input-select2">>
                <option value="">------</option>
                @foreach($data['style'] as $keyStyle => $itemStyle)
                <option value="{{ $keyStyle }}" @if($style == $keyStyle) selected="selected" @endif>{{ trans($itemStyle) }}</option>
                @endforeach`
            </select>
            <div class="input-error"></div>
        </div>
    </div>
</div>
@endif

@if(isset($data['material']))
<div class="form-group form-material">
    <div class="row" >
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
            <label class="lbl-form-control" >{{ trans('front.product.material') }}</label>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <select name="material" id="material" class="form-control input-select2">
                <option value="">------</option>
                @foreach($data['material'] as $keyMaterial => $itemMaterial)
                <option value="{{ $keyMaterial }}" @if($material == $keyMaterial) selected="selected" @endif>{{ trans($itemMaterial) }}</option>
                @endforeach`
            </select>
            <div class="input-error"></div>
        </div>
    </div>
</div>
@endif
