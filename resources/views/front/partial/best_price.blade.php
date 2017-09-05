@if(count($productBestPrice))
<div class="row" >

    <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-9 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-3 col-sm-push-0"  data-align-height="right"  data-bottom="20"  >
        <div class="page-right clearfix" >
            <div class="row" >
                <div class="col-sm-12" >
                    <div class="content-center" >
                        <div class="inner-content-center clearfix" >

                            <div class="list-product clearfix" >
                                <div class="row" >

                                    @foreach ($productBestPrice as $item)
                                    <?php $imageInfo = getImage($item->image_rand, $item->image_real); ?>
                                    <div class="col-ex-2 col-lg-3 col-md-4 col-sm-4 col-xs-6" >
                                        <div class="item-product" >
                                            <div class="in-product clearfix" >
                                                <div class="thumb-product text-xs-center" >
                                                    <a href="{{ makeSlug($item->slug, $item->id) }}" title="{{ $item->title }}" class="link-product" >
                                                        <img src="{{ $imageInfo['href'] }}" alt="{{ $imageInfo['base_name'] }}" class="img-fluid" >
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sizebar-left col-ex-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-ex-pull-10 col-lg-pull-9 col-md-pull-9 col-sm-pull-0" >
        <div class="mini-box"  data-align-height="left" data-bottom="20" >
            <h2 class="mini-box-title" >
                {!! trans('front.partial.best_price_title') !!}
            </h2>
            <div class="mini-box-content" >
                <ul class="nav-hots clearfix" >
                    @foreach ($arrMenuBestPrice as $bestT)
                    <li>
                        <a href="{{ makeSlug($bestT['slug'], $bestT['id']) }}" title="{{ $bestT['title'] }}" >{{ $bestT['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>
@endif