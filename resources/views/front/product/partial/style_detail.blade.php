@if(isset($loadStyles['position_use'][$product->position_use]))
<p>Vi tri su dung: {{ trans($loadStyles['position_use'][$product->position_use]) }}</p>
@endif
@if(isset($loadStyles['size'][$product->size]))
<p>Size: {{ trans($loadStyles['size'][$product->size]) }}</p>
@endif

@if(isset($loadStyles['style'][$product->style]))
<p>Kieu dang: {{ trans($loadStyles['style'][$product->style]) }}</p>
@endif

@if(isset($loadStyles['material'][$product->material]))
<p>Phu kien: {{ trans($loadStyles['material'][$product->material]) }}</p>
@endif
