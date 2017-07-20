@extends('front.layout')

@section('content')

<div class="row" >
    <div class="col-sm-12" >
        <div class="content-center" >
            <div class="inner-content-center clearfix" >
                <div class="row" >
                    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1" >
                        <div class="page-sign" data-align-height="wrap" >
                            <div class="row" >
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-align-height="right"  data-bottom="20" >
                                    <div class="well-sign clearfix">
                                        <div class="clearfix" id="login" >
                                            @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            <h2>Khác hàng cũ</h2>
                                            <form action="{{ route('seller_login') }}" method="post">
                                                <div class="form-group input-group-sm @if ($errors->has('email')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.login_page.lb_email') }}</label>
                                                    <input type="text" name="email" id="email" class="form-control border-corner" placeholder="" value="" />
                                                    @if ($errors->has('email'))
                                                      <p class="help-block">{{ $errors->first('email') }}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group input-group-sm @if ($errors->has('password')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.login_page.lb_password') }}</label>
                                                    <input type="password" name="password" id="password" class="form-control border-corner" placeholder="" value="" />
                                                    @if ($errors->has('password'))
                                                      <p class="help-block">{{ $errors->first('password') }}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <a class="forgotpw" href="{{ route('password_request') }}" title="Quên mật khẩu" data-neo="silling" data-from="#login" data-to="#recover-password">
                                                        Quên mật khẩu
                                                    </a>
                                                </div>
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                            </form>
                                        </div>
                                        @if (isset($message))
                                        <p class="help-block">{{ $message }}</p>
                                        @endif
                                        <div class="clearfix" id="recover-password" style="display:none;">
                                            <h2>Quên password</h2>
                                            <p><strong>Nhập địa chỉ email đã đăng ký với tài khoản này. Bấm nút Tiếp tục mật khẩu sẽ được gửi đến email của bạn</strong></p>
                                            <form accept-charset="UTF-8" action="/profile/recover" id="recover_customer_password" method="post" data-form="recoverPassword">
                                                <div class="form-group">
                                                    <label class="control-label" for="user_name">
                                                        Email                                
                                                    </label>
                                                    <input type="text" name="email" value="" placeholder="Email" id="user_name" class="form-control user_name" data-input="email">
                                                </div>
                                                <div class="form-group">
                                                    <a class="forgotpw" href="javascript:void(0);" title="Về trang login" data-neo="silling" data-to="#login" data-from="#recover-password">
                                                        Về trang login                                
                                                    </a>
                                                </div>
                                                <input type="submit" value="Khôi phục lại password" class="btn btn-primary">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                                    <div class="well-sign" data-align-height="left"  data-bottom="20" >
                                        <h2>Khách hàng mới</h2>
                                        <a href="{{ route('seller_register') }}" class="btn btn-primary">ĐĂNG KÝ TÀI KHOẢN</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
