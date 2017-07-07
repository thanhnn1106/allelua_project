@extends('seller.layout')

@section('content')
<div class="row" >
    <div class="col-sm-12" >
        <div class="content-center" >
            <div class="inner-content-center clearfix" >
                <div class="row" >
                    <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12"  >
                        <div class="profile-content clearfix" data-align-height="left"  data-bottom="20" >
                            <div class="user-heading">
                                <h3><strong>Quản lý tài khoản</strong></h3>
                                <span class="help-block">test@yahoo.com.vn</span>
                            </div>
                            <form accept-charset="UTF-8" action="" method="post" data-form="editProfile">
                                <div class="row" >
                                    <div class="col-sm-12">
                                        <p class="allelua-note-payment">
                                            Thông tin cá nhân của bạn                                   
                                        </p>
                                    </div>
                                    <div class="col-xs-12" >
                                        <div class="box-error clearfix" >
                                            <div class="pull-left" >
                                                bạn chưa nhập đầy đủ, xem bên dưới để biết thông tin
                                            </div>
                                            <div class="pull-right">
                                                <a href="javascript:void(0);" data-btn="closeBoxError" >
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
                                        <div class="wrap-form-edit-profile">
                                            <div class="form-element-payment">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label class="ui-lb-payment">
                                                            Tên         
                                                        </label>
                                                    </div>
                                                    <div class="col-xs-6  first-payment">
                                                        <div class="ui-input-payment">
                                                            <input type="text" value="" name="first_name" id="first_name" spellcheck="false" class="input-payment first_name" aria-invalid="true" data-input="first_name" placeholder="first name">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="ui-input-payment">
                                                            <input type="text" value="" name="last_name" id="last_name" spellcheck="false" class="input-payment last_name" aria-invalid="true" data-input="last_name" placeholder="last name" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-element-payment">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="ui-lb-payment">
                                                            Số điện thoại
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="ui-input-payment">
                                                            <input type="text" name="phone" id="phone" spellcheck="false" class="input-payment phone" aria-invalid="true" value="01280358932" data-input="phone">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-element-payment">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="ui-lb-payment">
                                                            Đất nước                       
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="ui-select-payment">
                                                            <select name="" class="input-select2" >
                                                                <option>Chọn đất nước</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-element-payment">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="clearfix">
                                                        <input name="sb" type="submit" value="Sửa thông tin" class="allelua-btn allelua-btn-active">
                                                        <br>
                                                        <a href="javascript:void(0);" class="allelua-btn-link">
                                                            Đổi password 
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
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

@endsection
