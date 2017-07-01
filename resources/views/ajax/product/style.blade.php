<?php 
    $positionUse = isset($params['positionUse']) ? $params['positionUse'] : NULL;
    $size = isset($params['size']) ? $params['size'] : NULL;
    $style = isset($params['style']) ? $params['style'] : NULL;
?>
@if(isset($data['position_use']))
<div class="form-group form-position_use">
    <label class="control-label">Position use</label>
    <select name="position_use" id="position_use" class="form-control border-corner">
        <option value="">------</option>
        @foreach($data['position_use'] as $keyPos => $itemPos)
        <option value="{{ $keyPos }}" @if($positionUse == $keyPos) selected="selected" @endif>{{ trans($itemPos) }}</option>
        @endforeach`
    </select>
    <p class="help-block"></p>
</div>
@endif
@if(isset($data['size']))
<div class="form-group form-size">
    <label class="control-label">Size</label>
    <select name="size" id="size" class="form-control border-corner">
        <option value="">------</option>
        @foreach($data['size'] as $keySize => $itemSize)
        <option value="{{ $keySize }}" @if($size == $keySize) selected="selected" @endif>{{ trans($itemSize) }}</option>
        @endforeach`
    </select>
    <p class="help-block"></p>
</div>
@endif

@if(isset($data['style']))
<div class="form-group form-style">
    <label class="control-label">Style</label>
    <select name="style" id="style" class="form-control border-corner">
        <option value="">------</option>
        @foreach($data['style'] as $keyStyle => $itemStyle)
        <option value="{{ $keyStyle }}" @if($style == $keyStyle) selected="selected" @endif>{{ trans($itemStyle) }}</option>
        @endforeach`
    </select>
    <p class="help-block"></p>
</div>
@endif
