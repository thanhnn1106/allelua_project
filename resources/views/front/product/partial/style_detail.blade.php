@if(isset($loadStyles['position_use'][$product->position_use]))
<p><i>Vi tri su dung</i>: {{ trans($loadStyles['position_use'][$product->position_use]) }}</p>
@endif
@if(isset($loadStyles['size'][$product->size]))
<p><i>Size</i>: {{ trans($loadStyles['size'][$product->size]) }}</p>
@endif

@if(isset($loadStyles['style'][$product->style]))
<p><i>Kieu dang</i>: {{ trans($loadStyles['style'][$product->style]) }}</p>
@endif

@if(isset($loadStyles['material'][$product->material]))
<p><i>Phu kien</i>: {{ trans($loadStyles['material'][$product->material]) }}</p>
@endif
