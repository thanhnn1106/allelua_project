@extends('seller.layout')

@section('content')

<div class="clearfix">
    <ul class="breadcrumbs">
        <li class="home">
            <a href="{{ route('home') }}">{{ trans('front.bread_crum.home') }}</a>
        </li>
        <li><span>{{ trans('front.product.list_product') }}</span></li>
    </ul>
</div>

<div class="inner-page-main" data-align-height="wrap">
    <div class="row" >
        <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-8 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-4 col-sm-push-0" >
            <div class="page-right clearfix" >
                    <div class="row">
                        <div class="col-sm-12" >
                            <div class="content-center" >
                                <div class="inner-content-center clearfix" >

                                    <div class="profile-content clearfix" data-align-height="left"  data-bottom="20" >
                                        <div class="user-heading">
                                            <h3><strong>{{ trans('front.product.published') }}</strong></h3>
                                        </div>

                                        <p class="allelua-note-payment">
                                            <a href="{{ route('seller_product_create') }}" title="txt_edit_profile_here" class="allelua-btn allelua-btn-active">{{ trans('front.product.make_product') }}</a>
                                        </p>

                                        <div class="table-responsive">
                                            <table class="allelua-table-cart">
                                                <thead>
                                                    <tr>
                                                        <th class="text-xs-center" width="20" >{{ trans('front.product.id') }}</th>
                                                        <th class="text-xs-center">{{ trans('front.product.image') }}</th>
                                                        <th>{{ trans('front.product.category') }}</th>
                                                        <th>{{ trans('front.product.title') }}</th>
                                                        <th>{{ trans('front.product.price') }}</th>
                                                        <th>{{ trans('front.product.quantity') }}</th>
                                                        <th>{{ trans('front.product.quantity_limit') }}</th>
                                                        <th>{{ trans('front.product.status') }}</th>
                                                        <th>{{ trans('front.product.payment_method') }}</th>
                                                        <th>{{ trans('front.product.shipping_method') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($products)==0)
                                                    <tr><td colspan="9" align="center">Data not found</td></tr>
                                                    @else
                                                    @foreach($products as $product)
                                                    <tr>
                                                        <td class="text-right text-xs-center" width="20">{{ $product->id }}</td>
                                                        <td class="text-right" width="100">
                                                            @if(isset($product->image_rand) && isset($product->image_real))
                                                            <?php $imageThumb = getImage($product->image_rand, $product->image_real); ?>
                                                            <a href="{{ $imageThumb['href'] }}" target="_blank" >
                                                                <img src="{{ $imageThumb['img_src'] }}" class="img-fluid">
                                                            </a>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{ $product->category_title }}</td>
                                                        <td class="text-right"><a href="">{{ $product->title }}</a></td>
                                                        <td class="text-right text-xs-center" >{{ formatPrice($product->price) }}</td>
                                                        <td class="text-right">{{ formatNumber($product->quantity) }}</td>
                                                        <td class="text-right">{{ formatNumber($product->quantity_limit) }}</td>
                                                        <td class="text-right">{{ getProductStatus($product->status) }}</td>
                                                        <td class="text-right">{{ getPaymentMethod($product->payment_method) }}</td>
                                                        <td class="text-right">{{ getShippingMethod($product->shipping_method) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="nav-paging clearfix" >
                                            <nav class="pull-right">
                                                {{ $products->links() }}
                                                <!--
                                                <ul class="pagination">
                                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                </ul>
                                                -->
                                            </nav>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div
            </div>
        </div><!-- end clearfix save-marle -->

        <div class="sizebar-left col-ex-2 col-lg-3 col-md-4 col-sm-12 col-xs-12 col-ex-pull-10 col-lg-pull-9 col-md-pull-8 col-sm-pull-0" data-align-height="right" data-bottom="20">
            <div class="inner-sizebar clearfix">
                @include('seller.information');
            </div>
        </div>
    </div>
</div>

@endsection
