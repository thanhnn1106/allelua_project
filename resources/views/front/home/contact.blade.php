@extends('front.layout')

@section('content')
<div class="container">
    <div class="breadcrumbs-box" >
        <div class="container" >
            <div class="clearfix" >
                <ul class="breadcrumbs" >
                    <li class="home" ><a href="{{ route('home') }}" >{{ trans('front.bread_crum.home') }}</a></li>
                    <li>
                        <span>{{ trans('front.send_request_page.lb_send_request_finding') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form action="{{ route('contact') }}" method="post" enctype="multipart/form-data">
        <div class="row" >
            <div class="col-sm-12" >
                <div class="content-center" >
                    <div class="inner-content-center clearfix" >
                        <div class="clearfix" >
                            <div class="row" >
                                <div class="page-sign col-md-12" >
                                    @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        @if(is_array($message)) @foreach ($message as $m) {{ $m }} @endforeach
                                        @else {{ $message }} @endif
                                    </div>
                                    @endif 
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <fieldset class="clearfix" >
                                            <legend align="center">
                                                <b>{{ trans('front.send_request_page.lb_send_request_finding') }}</b>
                                            </legend>
                                            <div class="form-group required">
                                                <div class="row" >
                                                    <div class="form-group input-group-sm @if ($errors->has('email')) has-error @endif">
                                                        <label class="control-label">{{ trans('front.send_request_page.lb_your_email_address') }} (*)</label>
                                                        <input type="text" name="email" id="email" class="form-control border-corner" value="{{ old('email') }}" placeholder="" />
                                                        @if ($errors->has('email'))
                                                        <p class="help-block">{{ $errors->first('email') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="row" >
                                                    <div class="form-group input-group-sm @if ($errors->has('subject')) has-error @endif">
                                                        <label class="control-label">{{ trans('front.send_request_page.lb_subject') }} (*)</label>
                                                        <input type="text" name="subject" id="subject" class="form-control border-corner" value="{{ old('subject') }}" placeholder="" />
                                                        @if ($errors->has('subject'))
                                                        <p class="help-block">{{ $errors->first('subject') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="row" >
                                                    <div class="form-group input-group-sm @if ($errors->has('message')) has-error @endif">
                                                        <label class="control-label">{{ trans('front.send_request_page.lb_message') }} (*)</label>
                                                        <textarea rows="5" type="text" name="message" id="message" class="form-control border-corner" value="" placeholder="">{{ old('message') }}</textarea>
                                                        @if ($errors->has('message'))
                                                        <p class="help-block">{{ $errors->first('message') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <div class="row" >
                                                    <div class="form-group input-group-sm @if ($errors->has('image')) has-error @endif">
                                                        <label class="control-label">{{ trans('front.send_request_page.lb_upload_image') }} (*)</label>
                                                        <input type="file" name="image" id="image" class="form-control border-corner" value="{{ old('image') }}" placeholder="" />
                                                        @if ($errors->has('image'))
                                                        <p class="help-block">{{ $errors->first('image') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="pull-right">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-primary">{{ trans('front.send_request_page.btn_send_request') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3"></div>
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
