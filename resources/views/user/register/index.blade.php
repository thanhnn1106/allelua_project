@extends('front.layout')

@section('content')
<?php 
    $sex = config('allelua.sex.value');
?>

<div class="container">
<form action="{{ route('user_register', ['redirect' => $url_redirect]) }}" method="post">
<div class="row" >
    <div class="col-sm-12" >
        <div class="content-center" >
            <div class="inner-content-center clearfix" >
                <div class="clearfix" >
                    <div class="row" >
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2" >
                            <div class="page-sign" >
                                @include('notifications')
                                    <fieldset class="clearfix" >
                                        <legend align="center">
                                            <b>THÔNG TIN ĐĂNG KÝ</b>
                                        </legend>
                                        <div class="form-group required">
                                            <div class="row" >
                                                <div class="form-group input-group-sm @if ($errors->has('full_name')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.register_page.lb_full_name') }}</label>
                                                    <input type="text" name="full_name" id="full_name" class="form-control border-corner" value="{{ old('full_name') }}" placeholder="Input ..." />
                                                    @if ($errors->has('full_name'))
                                                      <p class="help-block">{{ $errors->first('full_name') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="row" >
                                                <div class="form-group input-group-sm @if ($errors->has('sex')) has-error @endif">
                                                    <label class="control-label">{{ trans('front.register_page.lb_sex') }}</label>

                                                    <input type="radio" name="sex" id="sex_1" value="{{ $sex['male'] }}" @if (old('sex') === '1') checked="checked" @endif />
                                                    <label for="sex_1">{{ trans('front.register_page.sex.male') }}</label>

                                                    <input type="radio" name="sex" id="sex_0" value="{{ $sex['female'] }}" @if (old('sex') === '0') checked="checked" @endif />
                                                    <label for="sex_0">{{ trans('front.register_page.sex.female') }}</label>
                                                    @if ($errors->has('sex'))
                                                      <p class="help-block">{{ $errors->first('sex') }}</p>
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
                                        <div class="form-group input-group-sm @if ($errors->has('dob_day')) has-error @endif">
                                            <div class="col-xs-4">
                                                <label class="control-label">{{ trans('front.register_page.dob.day') }}</label>
                                                <select name="dob_day" id="birthday_day" class="form-control">
                                                @foreach ($dob['day'] as $keyD => $day)
                                                <option value="{{ $keyD }}"  @if (old('dob_day', isset($user->dob) ? getBirthDay($user->dob) : '') == $keyD) selected="selected" @endif>{{ $day }}</option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('dob_day'))
                                                <p class="help-block">{{ $errors->first('dob_day') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label">{{ trans('front.register_page.dob.month') }}</label>
                                                <select name="dob_month" id="birthday_month" class="form-control">
                                                @foreach ($dob['month'] as $keyM => $month)
                                                <option value="{{ $keyM }}"  @if (old('dob_month', isset($user->dob) ? getBirthDay($user->dob, 'm') : '') == $keyM) selected="selected" @endif>{{ $month }}</option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('dob_month'))
                                                <p class="help-block">{{ $errors->first('dob_month') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label">{{ trans('front.register_page.dob.year') }}</label>
                                                <select name="dob_year" id="birthday_year" class="form-control">
                                                @foreach ($dob['year'] as $keyY => $year)
                                                <option value="{{ $keyY }}"  @if (old('dob_year', isset($user->dob) ? getBirthDay($user->dob) : '') == $keyY) selected="selected" @endif>{{ $year }}</option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('dob_year'))
                                                <p class="help-block">{{ $errors->first('dob_year') }}</p>
                                                @endif
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</div>
@endsection

@section('footer_script')

<script src="{{ asset_front('js/common.js') }}"></script>

@endsection

