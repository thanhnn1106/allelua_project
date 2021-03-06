@extends('front.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12" >
            <div class="content-center" >
                <div class="inner-content-center clearfix" >
                    <div class="row" >
                        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1" >
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif
                            <legend align="center">
                                <b>{{ trans('front.forgot_password_page.lb_title') }}</b>
                            </legend>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('password_email') }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <div class="col-md-2"></div>
                                            <label for="email" class="col-md-2 control-label">{{ trans('front.forgot_password_page.lb_email') }}</label>
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                                @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ trans('front.forgot_password_page.btn_send_link_reset_password') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px;"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
