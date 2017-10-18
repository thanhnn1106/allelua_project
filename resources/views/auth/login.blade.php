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
                                    <div class="clearfix">
                                        <div class="clearfix" id="login" >
                                            @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            <h2>{{ trans('front.login_page.lb_old_customer') }}</h2>
                                            <form action="{{ route('seller_login', ['redirect' => $url_redirect]) }}" method="post">
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
                                                        {{ trans('front.login_page.lb_forget_password') }}
                                                    </a>
                                                </div>
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-primary">{{ trans('front.login_page.btn_login') }}</button>
                                            </form>
                                        </div>
                                        @if (isset($message))
                                        <p class="help-block">{{ $message }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                                    <div class="well-sign" data-align-height="left"  data-bottom="20" >
                                        <h2>{{ trans('front.login_page.lb_new_register') }}</h2>
                                        <a href="{{ route('seller_register') }}" class="btn btn-primary">{{ trans('front.login_page.btn_register') }}</a>
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
