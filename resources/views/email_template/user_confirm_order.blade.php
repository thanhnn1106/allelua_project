<p>{{ $emailContentData['customerName'] }} thân mến,</p>
<p>Đơn hàng của bạn đã được đặt thành công!</p>
<p>Thông tin đơn hàng của bạn như sau:</p>

<table style="width: 100%;">
    <tr>
        <th style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">#</th>
        <th style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ trans('front.shipping_page.lb_product_image') }}</th>
        <th style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ trans('front.shipping_page.lb_product_name') }}</th>
        <th style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ trans('front.shipping_page.lb_price') }}</th>
        <th style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ trans('front.shipping_page.lb_quantity') }}</th>
        <th style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ trans('front.shipping_page.lb_total') }}</th>
    </tr>
    <?php
        $index = 0;
        $totalAmount = 0;
    ?>
    @foreach($emailContentData['cartList'] as $cart)
    <?php
        $index++;
        $totalAmount += formatNumber($cart->quantity) * $cart->price;
    ?>
    <tr>
        <td style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ $index }}</td>
        <?php $imageInfo = getImage($cart->attributes->image_rand, $cart->attributes->image_real); ?>
        <td style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">
            <a href="{{ makeSlug($cart->attributes->slug, $cart->id) }}" title="{{ $cart->name }}" class="link-product" >
                <img src="{{ $imageInfo['href'] }}" alt="{{ $imageInfo['base_name'] }}" class="img-fluid" >
            </a>
        </td>
        <td style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">
            <a href="{{ makeSlug($cart->attributes->slug, $cart->id) }}" title="{{ $cart->name }}">{{ $cart->name }}</a>
        </td>
        <td style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ formatPrice($cart->price) }}</td>
        <td style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ formatNumber($cart->quantity) }}</td>
        <td style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ formatPrice(formatNumber($cart->quantity) * $cart->price) }}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="5" style="text-align: right;border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ trans('front.shipping_page.lb_total_amount') }}</td>
        <td style="border: 1px solid #ddd;padding: 10px;font-size: 13px;">{{ formatPrice($totalAmount) }}</td>
    </tr>
</table>
<p>Nếu có thắc mắc. Vui lòng truy cập <a href="http://www.allelua.com">www.allelua.com</a> để nhờ admin hỗ trợ.</p>
