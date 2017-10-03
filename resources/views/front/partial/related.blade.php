@if(isset($productRelated) && count($productRelated))
<h2 class="title-cm">
    <span class="txt-title-cm">
        {{ trans('front.partial.related_title') }}
    </span>
</h2>
<div class="content-cm clearfix">
    <div class="owl-pronews owl-carousel owl-theme coz-owl-nav" data-neo="owlCarousel" data-own-name="owlProductNew" data-wow-delay="0.2s" data-dots="false" data-loop="false" data-nav = "true" data-margin = "15" data-autoplayTimeout="1000" data-autoPlay="5000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1}, "320":{"items":2}, "678":{"items":4}, "1200":{"items":5}, "1600":{"items":7}}' >
        @foreach ($productRelated as $proRelated)
        <?php $imageInfo = getImage($proRelated->image_rand, $proRelated->image_real); ?>
        <div class="product-owl clearfix" >
            <div class="item-product" >
                <div class="in-product clearfix" >
                    <div class="thumb-product text-xs-center" >
                        <a href="{{ makeSlug($proRelated->slug, $proRelated->id) }}" title="{{ $proRelated->title }}" class="link-product" >
                            <img src="{{ $imageInfo['img_src'] }}" alt="{{ $imageInfo['base_name'] }}" class="img-fluid" >
                        </a>
                    </div>
                    <h3 class="name-product" >
                        <a href="{{ makeSlug($proRelated->slug, $proRelated->id) }}" title="{{ $proRelated->title }}" class="link-product" >{{ $proRelated->title }}</a>
                    </h3>
                    <div class="price-product clearfix" >
                        <span class="price-sale-product" >{{ formatPrice($proRelated->price) }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif