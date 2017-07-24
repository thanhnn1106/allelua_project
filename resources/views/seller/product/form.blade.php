@extends('seller.layout')

@section('content')

<div class="clearfix">
    <ul class="breadcrumbs">
        <li class="home">
            <a href="{{ route('home') }}">{{ trans('front.bread_crum.home') }}</a>
        </li>
        <li>
            <a href="{{ route('seller_product_list') }}">{{ trans('front.product.list_product') }}</a>
        </li>
        <li><span>{{ trans('front.product.make_product') }}</span></li>
    </ul>
</div>

<!-- upload product -->
<div class="row">
    <div class="col-sm-12">
        <div class="content-center">
            <div class="inner-content-center clearfix" >
                <div class="row" >
                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12"  >
                        <div class="wrap-form clearfix" >
                            <h1 class="title-form text-xs-center" >
                                Thông tin sản phẩm đăng lên
                            </h1>
                            <div class="content-form" >
                                <form class="clearfix" action="" >

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Tên sản phẩm
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Hình sản phẩm chính
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <div class="list-img-upload clearfix" >
                                                    <div class="img-prevew-upload btn-upload" >
                                                        <a href="javascript:void(0)" >
                                                            <img src="{{ asset_front('dataimages/capture.png') }}" class="img-fluid" >
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Hình sản phẩm chi tiết<br />
                                                    <span class="note-red" >
                                                        (Cần đăng ít nhất 3 ảnh)
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <div class="list-img-upload clearfix" >
                                                    <div class="img-prevew-upload" >
                                                        <a href="javascript:void(0)" class="action-upload" >
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </a>
                                                        <img src="{{ asset_front('dataimages/upload.jpg') }}" class="img-fluid" >
                                                    </div>
                                                    <div class="img-prevew-upload" >
                                                        <a href="javascript:void(0)" class="action-upload" >
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </a>
                                                        <img src="{{ asset_front('dataimages/upload.jpg') }}" class="img-fluid" >
                                                    </div>
                                                    <div class="img-prevew-upload btn-upload" >
                                                        <a href="javascript:void(0)" class="action-upload" >
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" >
                                                            <img src="{{ asset_front('dataimages/capture.png') }}" class="img-fluid" >
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Giá
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Thông số kỹ thuật sản phẩm
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Xuất xứ
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Bảo hành
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Phương thức thanh toán
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <div class="radio-image clearfix" >
                                                    <div class="item-radio-image checked" data-input="imgRadio" >
                                                        <input type="radio" name="payment" value="" checked="checked" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/visa.png') }}" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                    <div class="item-radio-image" data-input="imgRadio" >
                                                        <input type="radio" name="payment" value="" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/master.png') }}" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                    <div class="item-radio-image" data-input="imgRadio" >
                                                        <input type="radio" name="payment" value="" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/jcb.png') }}" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                    <div class="item-radio-image" data-input="imgRadio" >
                                                        <input type="radio" name="payment" value="" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/cartondelivery.png') }}" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                    <div class="item-radio-image" data-input="imgRadio" >
                                                        <input type="radio" name="payment" value="" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/napast.png') }}" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                    <div class="item-radio-image" data-input="imgRadio" >
                                                        <input type="radio" name="payment" value="" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/123pay.png') }}" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Phương thức vận chuyển
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <div class="radio-image clearfix" >
                                                    <div class="item-radio-image checked" data-input="imgRadio" >
                                                        <input type="radio" name="tran" value="" checked="checked" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/vnp.jpg" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                    <div class="item-radio-image" data-input="imgRadio" >
                                                        <input type="radio" name="tran" value="" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/giaohangnhanh.jpg" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                    <div class="item-radio-image" data-input="imgRadio" >
                                                        <input type="radio" name="tran" value="" style="display: none;" >
                                                        <img src="{{ asset_front('dataimages/viettel.jpg" class="img-fluid" alt="" >
                                                        <span class="sts" ></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Địa điểm giao hàng
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Giới thiệu sản phẩm chi tiết
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Hình thức sản phẩm
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Số lượng còn hàng
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                <label class="lbl-form-control" >
                                                    Số lượng tối thiểu giao dịch
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                                <input type="text" name="" class="form-control form-control-md" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row" >
                                            <div class="col-sm-offset-4" >
                                                <button type="button" class="btn btn-style btn-heart" title="" >
                                                    <span>
                                                        Huỷ ĐĂNG
                                                    </span>
                                                </button>
                                                <button type="submit" class="btn btn-style" title="" >
                                                    <span>
                                                        ĐĂNG ẢNH SẢN PHẨM
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end upload product -->

    <div class="inner-page-main"  data-align-height="wrap">
        <!-- BEGIN BEST PRICE -->
        @include('front.partial.best_price')
        <!-- END BEST PRICE -->
    </div>

    <!-- BEGIN BEST PRICE -->
    @include('front.partial.favorite')
    <!-- END BEST PRICE -->

    <!-- BEGIN RELATED PRODUCT -->
    @include('front.partial.related')
    <!-- END RELATED PRODUCT -->

    <!-- BEGIN COUNTRY AND SERVICE -->
    @include('front.partial.country_service')
    <!-- END COUNTRY AND SERVICE -->

@endsection
