@if(isset($data['position_use']))
<div class="form-group">
    <label class="control-label">Position use</label>
    <select name="position_use" id="shipping_method" class="form-control border-corner">
        <option value="">------</option>
        @foreach($data['position_use'] as $keyPos => $itemPos)
        <option value="{{ $keyPos }}">{{ trans($itemPos) }}</option>
        @endforeach`
    </select>
    <p class="help-block"></p>
</div>
@endif
@if(isset($data['size']))
<div class="form-group">
    <label class="control-label">Size</label>
    <select name="size" id="size" class="form-control border-corner">
        <option value="">------</option>
        @foreach($data['size'] as $keySize => $itemSize)
        <option value="{{ $keySize }}">{{ trans($itemSize) }}</option>
        @endforeach`
    </select>
    <p class="help-block"></p>
</div>
@endif

@if(isset($data['style']))
<div class="form-group">
    <label class="control-label">Style</label>
    <select name="style" id="style" class="form-control border-corner">
        <option value="">------</option>
        @foreach($data['style'] as $keyStyle => $itemStyle)
        <option value="{{ $keyStyle }}">{{ trans($itemStyle) }}</option>
        @endforeach`
    </select>
    <p class="help-block"></p>
</div>
@endif
