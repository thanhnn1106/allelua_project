@if(count($productBestPrice))
<h2 class="title-cm">
    <span class="txt-title-cm">
        {!! trans('front.partial.best_price_title') !!}
    </span>
</h2>
<div class="content-cm clearfix">
    <div class="owl-pronews owl-carousel owl-theme coz-owl-nav" data-neo="owlCarousel" data-own-name="owlProductNew" data-wow-delay="0.2s" data-dots="false" data-loop="false" data-nav = "true" data-margin = "15" data-autoplayTimeout="1000" data-autoPlay="5000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1}, "320":{"items":2}, "678":{"items":4}, "1200":{"items":5}, "1600":{"items":7}}' >
        @foreach ($productBestPrice as $item)
        <?php $imageInfo = getImage($item->image_rand, $item->image_real); ?>
        <div class="product-owl clearfix" >
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
@endif