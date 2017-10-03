@if(count($productBestPrice))
<h2 class="title-cm">
    <span class="txt-title-cm">
        {!! trans('front.partial.best_price_title') !!}
    </span>
</h2>
<div class="content-cm clearfix">
    <div class="list-product clearfix">
        <div class="row">
            @foreach ($productBestPrice as $item)
            <?php $imageInfo = getImage($item->image_rand, $item->image_real); ?>
            <div class="col-ex-2 col-lg-3 col-md-4 col-sm-4 col-xs-6" >
                <div class="item-product" >
                    <div class="in-product clearfix" >
                        <div class="thumb-product text-xs-center" >
                            <a href="{{ makeSlug($item->slug, $item->id) }}" title="{{ $item->title }}" class="link-product" >
                                <img src="{{ $imageInfo['img_src'] }}" alt="{{ $imageInfo['base_name'] }}" class="img-fluid" >
                            </a>
                        </div>
                        <h3 class="name-product" >
                            <a href="{{ makeSlug($item->slug, $item->id) }}" title="{{ $item->title }}" class="link-product" >{{ $item->title }}</a>
                        </h3>
                        <div class="price-product clearfix" >
                            <span class="price-sale-product" >{{ formatPrice($item->price) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif