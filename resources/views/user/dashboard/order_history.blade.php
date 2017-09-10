@extends('front.layout')

@section('content')

<?php
$draftStatus = config('product.product_seller_status.value.draft');
?>
<div class="container">
<div class="clearfix">
    <ul class="breadcrumbs">
        <li class="home">
            <a href="{{ route('home') }}">{{ trans('front.bread_crum.home') }}</a>
        </li>
        <li><span>{{ trans('front.user_order_history.lb_title') }}</span></li>
    </ul>
</div>

<div class="inner-page-main" data-align-height="wrap">
    <div class="row" >
        <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-8 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-4 col-sm-push-0" >
            <div class="page-right clearfix" >
                <div class="row">
                    <div class="col-sm-12" >
                        @include('notifications')
                        <div class="content-center" >
                            <div class="inner-content-center clearfix" >

                                <div class="profile-content clearfix" data-align-height="left"  data-bottom="20" >
                                    <div class="user-heading">
                                        <h3><strong>{{ trans('front.user_order_history.lb_title') }}</strong></h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="allelua-table-cart">
                                            @if (count($orderList)==0)
                                                <tr><td colspan="9" align="center">Data not found</td></tr>
                                            @else
                                            <thead>
                                                <tr>
                                                    <th>{{ trans('front.user_order_history.lb_order_id') }}</th>
                                                    <th>{{ trans('front.user_order_history.lb_seller_name') }}</th>
                                                    <th>{{ trans('front.user_order_history.lb_product_name') }}</th>
                                                    <th>{{ trans('front.user_order_history.lb_price') }}</th>
                                                    <th>{{ trans('front.user_order_history.lb_quantity') }}</th>
                                                    <th>{{ trans('front.user_order_history.lb_total') }}</th>
                                                    <th>{{ trans('front.user_order_history.lb_status') }}</th>
                                                    <th>{{ trans('front.user_order_history.lb_created_at') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($orderList as $item)
                                            <tr>
                                                <td>{{ $item->order_id }}</td>
                                                <td>{{ $item->company_name }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ formatPrice($item->price) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ formatPrice($item->price * formatNumber($item->quantity)) }}</td>
                                                <td>{{ config('allelua.order_status_name.' . $item->status) }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            @endif
                                        </table>
                                    </div>

                                    <div class="nav-paging clearfix" >
                                        <nav class="pull-right">
                                            {{ $orderList->links() }}
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
            @include('user.information')
        </div>
    </div>
</div>
</div>
</div>
@endsection
@section('footer_script')
<script>
    function fncDeleteProduct(obj)
    {
        if (!confirm('Are you sure delete this product ?')) {
            return false;
        }
        window.location.href = $(obj).attr('data-url');
    }
</script>
@endsection
