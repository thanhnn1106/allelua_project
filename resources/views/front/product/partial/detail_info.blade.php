@if(isset($product) && $product)
<div class="row">
    <div class="col-sm-12" >
        <div class="top-detail clearfix" >
            <div class="row" >
                <?php 
                    $imagePreviews = $productImages['initialPreview'];
                ?>
                @if(isset($imagePreviews))
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">

                    <div class="hidden-sm-down" >
                        <div class="wrap-produt-img clearfix" >
                            <div id="surround" >
                                <div class="box-image-featured">
                                    @if(isset($imagePreviews[0]))
                                    <img class="product-image-feature" src="{{ $imagePreviews[0] }}" alt="" >
                                    @endif
                                </div>
                            </div>
                            <div class="thumb-image-dt" >
                                <a href="javascript:void(0);" class="btn-up-sly" rel="nofollow" >
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                </a>
                                <div class="sly-thumb clearfix" id="sly_thumb">
                                    <ul class="list-sly" >
                                        <?php $arrDetailImg = $productImages['initialPreviewConfig']; ?>
                                        @foreach($imagePreviews as $index => $image)
                                        <li class="product-thumb item-sly" >
                                            <a href="javascript:void(0);" title="@if(isset($arrDetailImg[$index])) {{ $arrDetailImg[$index]['caption'] }} @endif" data-image="{{ $image }}" data-zoom-image="{{ $image }}" rel="nofollow" >
                                                <img src="{{ $image }}" title="" alt="" data-image="{{ $image }}" data-zoom-image="{{ $image }}" />
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="javascript:void(0);" class="btn-down-sly" rel="nofollow" >
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden-md-up" >
                        <div class="owl-sm-detail clearfix" >
                            <div id="owlSm" class="owl-carousel owl-theme slideshow" data-neo="owlCarousel" data-own-name="owlDetailSlider" data-wow-delay="0.2s" data-dots="false" data-loop="false" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoPlay="5000" data-autoplayHoverPause = "true" data-navTextLeft='<i class="fa fa-chevron-left" aria-hidden="true"></i>' data-navTextRight='<i class="fa fa-chevron-right" aria-hidden="true"></i>' data-responsive='{"0":{"items":1}}' >
                                <div class="item" >
                                    @if(isset($imagePreviews[0]))
                                    <img src="{{ $imagePreviews[0] }}" title="" alt="" itemprop="image" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-xs-12  col-md-6 col-sm-12 col-lg-4" >
                    <div class="details-pro clearfix" >
                        <h2 class="manufacturers-name" >
                            <span>{{ $product->brand }}</span>
                        </h2>
                        <h1 class="product-name" >{{ $product->title }}</h1>
                        <div class="product-price" id="price-preview" >
                            <span class="price-sale" >{{ formatPrice($product->price) }}</span>
                        </div>
                        <div class="product-description product_description" >
                            <p class="lbl-myn" >{{ trans('front.partial.product_detail.short_des') }}</p>
                            <div class="mini-product-description clearfix">
                                <p>{{ trans('front.partial.product_detail.source') }}: {{ $product->source }}</p>
                                <p>{{ trans('front.partial.product_detail.guarantee') }}: {{ $product->guarantee }}</p>
                                <p>{{ trans('front.partial.product_detail.delivery_location') }}: {{ $product->delivery_location }}</p>
                                <p>{{ trans('front.partial.product_detail.shipping_method') }}: {{ getShippingMethod($product->shipping_method) }}</p>
                                <p>{{ trans('front.partial.product_detail.payment_method') }}: {{ getPaymentMethod($product->payment_method) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if( ! isSeller() || ! isAdmin())
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12" >
                    <div class="action-detail clearfix" >
                        <div class="form-product">
                            <form id="form-add-cart" action="{{ route('cart_add') }}" method="POST" class="form-inline" >

                                <div class="product-form-group">
                                    <div class="row form-quantity">
                                        <div class="col-xs-12" >
                                            <label for="select-product-type" class="lbl-type-product" >Số lượng</label>
                                        </div>
                                        <div class="col-xs-12" >
                                            <input type="number" class="quantity-product-dt" title="quantity" value="1" name="quantity" >
                                            <div class="input-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $isCheckOut = (isset($totalCart) && $totalCart > 0) ? 'display:block' : 'display:none';
                                ?>
                                <div id="butCheckout" class="product-form-group" style="{{ $isCheckOut }}">
                                    <button type="button" onclick="window.location.href='{{ route('user_checkout_shipping') }}';" class="btn btn-block btn-style btn-cart add_to_cart" title="Cho vào giỏ hàng" >
                                        <span>Mua ngay</span>
                                    </button>
                                </div>
                                <div class="product-form-group">
                                    <input type="hidden" value="{{ $product->id or null }}" name="product_id" />
                                    <button type="button" id="cart_add_ajax_button" class="btn btn-block btn-style btn-cart add_to_cart" title="Cho vào giỏ hàng" >
                                        <span>Cho vào giỏ hàng</span>
                                    </button>
                                </div>
                            </form>

                            <div class="product-form-group">
                                <a href="javascript:void(0);" data-url-login="{{ route('user_login') }}" data-url="{{ route('user_product_favorite') }}" data-product-id="{{ $product->id }}" 
                                   onclick="fncFavorite(event, this)" class="btn btn-block btn-style btn-heart" rel="nofollow" >
                                    <span>Yêu thích</span>
                                </a>
                            </div>

                            <div class="product-form-group" >
                                <div class="social-media text-xs-left">
                                    <h2 class="lb-action-share" >
                                        Chia sẻ 
                                    </h2>                       
                                    <div class="bdy-share clearfix" >
                                        <ul class="nav nav-inline" >
                                            <li class="nav-item" >
                                                <a href="" title="" rel="nofollow" data-btn="share" data-network="facebook" target='_blank' >
                                                    <i class="ic i-facebook" ></i>
                                                </a>
                                            </li>
                                            <li class="nav-item" >
                                                <a href="" title="" rel="nofollow"  data-btn="zaloshare" data-network="zalo" target='_blank' >
                                                    <i class="ic i-zalo" ></i>
                                                </a>
                                            </li>
                                            <li class="nav-item" rel="nofollow" >
                                                <a href="" title=""  data-btn="share" data-network="google" target='_blank' >
                                                    <i class="ic i-google" ></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <!-- Nav tabs -->
        <div class="clearfix" >
            <ul class="nav nav-inline nav-tab-detailspro clearfix" role="tablist">

                <li class="nav-item" >
                    <a class="nav-link active" data-toggle="tab" href="#products_more" role="tab" rel="nofollow" >{{ trans('front.partial.product_detail.long_des') }}</a>
                </li>

                <li class="nav-item" >
                    <a class="nav-link" data-toggle="tab" href="#products_longdescription" role="tab" rel="nofollow" >{{ trans('front.partial.product_detail.introduce_company') }}</a>
                </li>

            </ul>
        </div>

        <div class="tab-content tab-content-detailspro clearfix" >

            <div class="tab-pane fade in active" id="products_more" role="tabpanel" >
                <div class="clearfix" >{!! $product->detail !!}</div>
            </div>

            <div class="tab-pane fade in" id="products_longdescription" role="tabpanel" >
                <div class="clearfix">@if(isset($personal)) {!! $personal->introduce_company !!} @endif</div>
            </div>
        </div>
    </div>

</div>
@endif