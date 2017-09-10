@extends('front.layout')

@section('content')
<div class="clearfix">
    <ul class="breadcrumbs">
        <li class="home">
            <a href="{{ route('home') }}">{{ trans('front.bread_crum.home') }}</a>
        </li>
        <li><span>{{ trans('front.account_manage_page.lb_title') }}</span></li>
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
                                        <h3><strong>{{ trans('front.account_manage_page.lb_title') }}</strong></h3>
                                    </div>
                                    <form role="form" action="{{ route('user_account_management') }}" id="form-product" method="POST" enctype="multipart/form-data">
                                        <div class="nav-tabs-custom">
                                            <div class="box-footer">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                                            </div>
                                            <div class="box-body" style="margin-top: 10px;">
                                                <div class="row">
                                                    <!-- left -->
                                                    <div class="col-md-6">
                                                        <div class="form-group input-group-sm @if ($errors->has('full_name')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_full_name') }}</label>
                                                            <input type="text" name="full_name" id="full_name" class="form-control border-corner" placeholder="" value="{{ (isset($userInfo->full_name)) ? $userInfo->full_name : ''}}" />
                                                            @if ($errors->has('full_name'))
                                                            <p class="help-block">{{ $errors->first('full_name') }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group input-group-sm @if ($errors->has('email')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_email') }}</label>
                                                            <input type="text" disabled="disabled" name="email" id="email" class="form-control border-corner" placeholder="" value="{{ (isset($userInfo->email)) ? $userInfo->email : ''}}" />
                                                        </div>
                                                        <div class="form-group input-group-sm @if ($errors->has('phone_number')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_phone_number') }}</label>
                                                            <input type="number" name="phone_number" id="phone_number" class="form-control border-corner" placeholder="" value="{{ (isset($userInfo->phone_number)) ? $userInfo->phone_number : ''}}" />
                                                            @if ($errors->has('phone_number'))
                                                            <p class="help-block">{{ $errors->first('phone_number') }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group @if ($errors->has('sex')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_sex') }}</label>&nbsp;
                                                            <input type="radio" name="sex" value="1" @if (old('sex', isset($userInfo->sex) ? $userInfo->sex : '') == 1) checked="checked" @endif />
                                                            <label for="sex_1">{{ trans('front.account_manage_page.sex.male') }}</label>
                                                            <input type="radio" name="sex" value="0" @if (old('sex', isset($userInfo->sex) ? $userInfo->sex : '') != 1) checked="checked" @endif />
                                                            <label for="sex_0">{{ trans('front.account_manage_page.sex.female') }}</label>
                                                            @if ($errors->has('sex'))
                                                            <p class="help-block">{{ $errors->first('sex') }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group @if ($errors->has('sex')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_dob') }}</label>
                                                        </div>
                                                        <div class="form-group @if ($errors->has('dob_day') || $errors->has('dob_month') || $errors->has('dob_year')) has-error @endif">
                                                            <div class="col-xs-4">
                                                                <label>{{ trans('front.register_page.dob.day') }}</label>
                                                                <select name="dob_day" id="birthday_day" class="form-control">
                                                                    @foreach ($dob['day'] as $day)
                                                                    <option value="{{ $day }}"  @if (old('dob_day', isset($userInfo->dob) ? getBirthDay($userInfo->dob) : '') == $day) selected="selected" @endif>{{ $day }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('dob_day'))
                                                                <p class="help-block">{{ $errors->first('dob_day') }}</p>
                                                                @endif
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <label>{{ trans('front.register_page.dob.month') }}</label>
                                                                <select name="dob_month" id="birthday_month" class="form-control">
                                                                    @foreach ($dob['month'] as $month)
                                                                    <option value="{{ $month }}"  @if (old('dob_month', isset($userInfo->dob) ? getBirthDay($userInfo->dob, 'm') : '') == $month) selected="selected" @endif>{{ $month }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('dob_month'))
                                                                <p class="help-block">{{ $errors->first('dob_month') }}</p>
                                                                @endif
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <label>{{ trans('front.register_page.dob.year') }}</label>
                                                                <select name="dob_year" id="birthday_year" class="form-control">
                                                                    @foreach ($dob['year'] as $year)
                                                                    <option value="{{ $year }}"  @if (old('dob_year', isset($userInfo->dob) ? getBirthDay($userInfo->dob, 'Y') : '') == $year) selected="selected" @endif>{{ $year }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('dob_year'))
                                                                <p class="help-block">{{ $errors->first('dob_year') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div id="load_style">
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
        </div><!-- end clearfix save-marle -->
        <div class="sizebar-left col-ex-2 col-lg-3 col-md-4 col-sm-12 col-xs-12 col-ex-pull-10 col-lg-pull-9 col-md-pull-8 col-sm-pull-0" data-align-height="right" data-bottom="20">
            <div class="inner-sizebar clearfix">
                @include('user.information');
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')

<script src="{{ asset_front('js/common.js') }}"></script>

@endsection
