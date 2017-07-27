@extends('front.layout')

@section('content')
<div class="row" >
    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12"  >
        <div class="wrap-form clearfix" >
            <h3 class="title-form text-xs-center" >
                <strong>Thông tin sản phẩm đăng lên</strong>
            </h3>
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
                                            <img src="dataimages/capture.png" class="img-fluid" >
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
                                        <img src="dataimages/upload.jpg" class="img-fluid" >
                                    </div>
                                    <div class="img-prevew-upload" >
                                        <a href="javascript:void(0)" class="action-upload" >
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                        <img src="dataimages/upload.jpg" class="img-fluid" >
                                    </div>
                                    <div class="img-prevew-upload btn-upload" >
                                        <a href="javascript:void(0)" class="action-upload" >
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                        <a href="javascript:void(0)" >
                                            <img src="dataimages/capture.png" class="img-fluid" >
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
                                        <img src="dataimages/visa.png" class="img-fluid" alt="" >
                                        <span class="sts" ></span>
                                    </div>
                                    <div class="item-radio-image" data-input="imgRadio" >
                                        <input type="radio" name="payment" value="" style="display: none;" >
                                        <img src="dataimages/master.png" class="img-fluid" alt="" >
                                        <span class="sts" ></span>
                                    </div>
                                    <div class="item-radio-image" data-input="imgRadio" >
                                        <input type="radio" name="payment" value="" style="display: none;" >
                                        <img src="dataimages/jcb.png" class="img-fluid" alt="" >
                                        <span class="sts" ></span>
                                    </div>
                                    <div class="item-radio-image" data-input="imgRadio" >
                                        <input type="radio" name="payment" value="" style="display: none;" >
                                        <img src="dataimages/cartondelivery.png" class="img-fluid" alt="" >
                                        <span class="sts" ></span>
                                    </div>
                                    <div class="item-radio-image" data-input="imgRadio" >
                                        <input type="radio" name="payment" value="" style="display: none;" >
                                        <img src="dataimages/napast.png" class="img-fluid" alt="" >
                                        <span class="sts" ></span>
                                    </div>
                                    <div class="item-radio-image" data-input="imgRadio" >
                                        <input type="radio" name="payment" value="" style="display: none;" >
                                        <img src="dataimages/123pay.png" class="img-fluid" alt="" >
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
                                        <img src="dataimages/vnp.jpg" class="img-fluid" alt="" >
                                        <span class="sts" ></span>
                                    </div>
                                    <div class="item-radio-image" data-input="imgRadio" >
                                        <input type="radio" name="tran" value="" style="display: none;" >
                                        <img src="dataimages/giaohangnhanh.jpg" class="img-fluid" alt="" >
                                        <span class="sts" ></span>
                                    </div>
                                    <div class="item-radio-image" data-input="imgRadio" >
                                        <input type="radio" name="tran" value="" style="display: none;" >
                                        <img src="dataimages/viettel.jpg" class="img-fluid" alt="" >
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

@endsection
