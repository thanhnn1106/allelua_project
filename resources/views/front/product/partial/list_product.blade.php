@if(isset($products) && $products->total())
<div class="row" >
    @foreach($products as $product)
    <?php $imageInfo = getImage($product->image_rand, $product->image_real); ?>
    <div class="col-ex-2 col-lg-3 col-md-4 col-sm-4 col-xs-6" >
        <div class="item-product" >
            <div class="in-product clearfix" >
                <div class="thumb-product text-xs-center" >
                    <a href="{{ makeSlug($product->slug, $product->id) }}" title="{{ $product->title }}" class="link-product" >
                        <img src="{{ $imageInfo['img_src'] }}" alt="{{ $imageInfo['base_name'] }}" class="img-fluid" >
                    </a>
                </div>
                <h3 class="name-product" >
                    <a href="{{ makeSlug($product->slug, $product->id) }}" title="{{ $product->title }}" class="link-product" >{{ $product->title }}</a>
                </h3>
                <div class="price-product clearfix" >
                    <span class="price-sale-product" >{{ formatPrice($product->price) }}</span>
                </div>
            </div>
        </div>
    </div><!-- end item-product -->
    @endforeach
</div>
@else
<p>Data not found</p>
@endif