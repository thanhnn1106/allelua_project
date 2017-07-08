@if(isset($subCate) && count($subCate))
<div class="mini-box"  data-align-height="left" data-bottom="20" >
    <div class="mini-box-content" >
        <ul class="nav-hots clearfix" >
            @foreach ($subCate as $cateC)
            <li>
                <a href="{{ makeSlug($cateC->slug, $cateC->id, false) }}" title="{{ $cateC->title }}" >{{ $cateC->title }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif