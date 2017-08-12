@extends('front.layout')

@section('content')

<form action="{{ route('seller_register') }}" method="post">
<div class="row" >
    <div class="col-sm-12" >
        <div class="content-center" >
            <div class="inner-content-center clearfix" >
                <div class="clearfix" >
                    <div class="row" >
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2" >
                            <div class="page-sign" >
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    @if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
                                    @else {{ $message }} @endif
                                </div>
                                @endif 
                                <form accept-charset="UTF-8" action="/sign-up" id="registerform" method="post" class="form-horizontal clearfix" data-form="signup">
                                    <fieldset class="clearfix" >
                                        <legend align="center">
                                            <label><b>THÔNG TIN TÀI KHOẢN</b></label>
                                        </legend>
                                        <div class="form-group required">
                                            <div class="row" >
                                                <div class="form-group input-group-sm @if ($errors->has('company_name')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.register_page.lb_company_name') }}</label>
                                                    <input type="text" name="company_name" id="company_name" class="form-control border-corner" value="{{ old('company_name') }}" placeholder="Input ..." />
                                                    @if ($errors->has('company_name'))
                                                      <p class="help-block">{{ $errors->first('company_name') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="row" >
                                                <div class="form-group input-group-sm @if ($errors->has('phone_number')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.register_page.lb_phone_number') }}</label>
                                                    <input type="text" name="phone_number" id="phone_number" class="form-control border-corner" value="{{ old('phone_number') }}" placeholder="Input ..." />
                                                    @if ($errors->has('phone_number'))
                                                      <p class="help-block">{{ $errors->first('phone_number') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="row" >
                                                <div class="form-group input-group-sm @if ($errors->has('email')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.register_page.lb_email') }}</label>
                                                    <input type="text" name="email" id="email" class="form-control border-corner" value="{{ old('email') }}" placeholder="Input ..." />
                                                    @if ($errors->has('email'))
                                                      <p class="help-block">{{ $errors->first('email') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="row" >
                                                <div class="form-group input-group-sm @if ($errors->has('password')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.register_page.lb_password') }}</label>
                                                    <input type="password" name="password" id="password" class="form-control border-corner" value="{{ old('password') }}" placeholder="Input ..." />
                                                    @if ($errors->has('password'))
                                                      <p class="help-block">{{ $errors->first('password') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="row" >
                                                <div class="form-group input-group-sm @if ($errors->has('password_confirmation')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.register_page.lb_confirm_password') }}</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-corner" value="{{ old('password_confirmation') }}" placeholder="Input ..." />
                                                    @if ($errors->has('password_confirmation'))
                                                      <p class="help-block">{{ $errors->first('password_confirmation') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row" >
                                                <label class="control-label">{{ trans('front.register_page.lb_country') }}</label>
                                                <select class="form-control col-md-9 @if ($errors->has('country_id')) has-error @endif" name="country_id">
                                                    @foreach ($countryList as $item)
                                                    <option value="{{ $item->id }}" {{ (old('country_id') === $item->id) ? 'selected' : ''}}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <div class="pull-right">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-primary">{{ trans('front.register_page.btn_register') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
