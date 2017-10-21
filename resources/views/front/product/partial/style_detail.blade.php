@if(isset($loadStyles['position_use'][$product->position_use]))
<p><i>{{ trans('front.product.position_use') }}</i>: {{ trans($loadStyles['position_use'][$product->position_use]) }}</p>
@endif
@if(isset($loadStyles['size'][$product->size]))
<p><i>{{ trans('front.product.size') }}</i>: {{ trans($loadStyles['size'][$product->size]) }}</p>
@endif

@if(isset($loadStyles['style'][$product->style]))
<p><i>{{ trans('front.product.style') }}</i>: {{ trans($loadStyles['style'][$product->style]) }}</p>
@endif

@if(isset($loadStyles['material'][$product->material]))
<p><i>{{ trans('front.product.material') }}</i>: {{ trans($loadStyles['material'][$product->material]) }}</p>
@endif
