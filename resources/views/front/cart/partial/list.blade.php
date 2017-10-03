@foreach($cartList as $cart)
<?php $imageInfo = getImage($cart->attributes->image_rand, $cart->attributes->image_real); ?>
<div class="cart-item">
    <div class="row">
        <div class="col-xs-2">
            <div class="thumb-item-cart">
                <a href="{{ makeSlug($cart->attributes->slug, $cart->id) }}" title="{{ $cart->name }}" class="link-product" >
                    <img src="{{ $imageInfo['img_src'] }}" alt="{{ $imageInfo['base_name'] }}" class="img-fluid" >
                </a>
            </div>
        </div>
        <div class="col-xs-10">
            <div class="info-item-cart">
                <h3 class="name-item-cart">
                    <a href="{{ makeSlug($cart->attributes->slug, $cart->id) }}" title="{{ $cart->name }}">{{ $cart->name }}</a>
                </h3>
                <div class="price-item-cart clearfix">
                    <span class="text-price">{{ formatPrice($cart->price) }}</span> /
                    <input type="number" name="quantity_{{ $cart->id }}" class="qty-item-cart" value="{{ $cart->quantity }}">
                    @if($errors->first('quantity_' . $cart->id))
                    <div class="input-error">{{ $errors->first('quantity_' . $cart->id) }}</div>
                    @endif
                </div>
                <div class="action-item-cart clearfix">
                    <a href="{{ route('cart_remove', ['id' => $cart->id]) }}" class="item-action-cart item-action-del">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                    <!--
                    <a href="" class="item-action-cart">Để dành mua sau</a>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach