@extends('front.layout')

@section('content')
<div class="clearfix">
    <ul class="breadcrumbs">
        <li class="home">
            <a href="{{ route('home') }}">{{ trans('front.bread_crum.home') }}</a>
        </li>
        <li><span>{{ trans('front.change_password.lb_title') }}</span></li>
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
                                        <h3><strong>{{ trans('front.change_password.lb_title') }}</strong></h3>
                                    </div>
                                    <form action="{{ route('seller_change_password', array('id' => Auth::user()->id)) }}" method="post">
                                        <div class="form-group input-group-sm @if ($errors->has('current_password')) has-error @endif">
                                            <label for="current_password"><strong>{{ trans('front.change_password.lb_current_password') }}</strong></label>
                                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="{{ trans('front.change_password.ph_current_password') }}" value="{{ old('current_password') }}" />
                                            @if ($errors->has('current_password'))
                                            <p class="help-block">{{ $errors->first('current_password') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group input-group-sm @if ($errors->has('new_password')) has-error @endif">
                                            <label for="new_password"><strong>{{ trans('front.change_password.lb_new_password') }}</strong></label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="{{ trans('front.change_password.ph_new_password') }}" value="{{ old('new_password') }}" />
                                            @if ($errors->has('new_password'))
                                            <p class="help-block">{{ $errors->first('new_password') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group input-group-sm @if ($errors->has('confirm_password')) has-error @endif">
                                            <label for="confirm_password"><strong>{{ trans('front.change_password.lb_confirm_new_password') }}</strong></label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="{{ trans('front.change_password.ph_confirm_new_password') }}" value="{{ old('confirm_password') }}">
                                            @if ($errors->has('confirm_password'))
                                            <p class="help-block">{{ $errors->first('confirm_password') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary">{{ trans('front.change_password.btn_save') }}</button>
                                        </div>
                                    </form>
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
