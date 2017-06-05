@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Setting
            <small>Edit</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <div class="box box-primary">
                    <form role="form" action="{{ route('admin_setting_socical') }}" id="form-user" method="post">
                        <div class="box-body">
                            <div class="form-group input-group-sm @if ($errors->has('setting_rate')) has-error @endif">
                                <label class="control-label">Rate</label>
                                <input type="text" class="form-control" id="setting_rate" name="setting_rate" 
                                       maxlength="255" value="{{ old('setting_rate', isset($setting['setting_rate']) ? $setting['setting_rate'] : '') }}" />
                                @if ($errors->has('setting_rate'))
                                  <p class="help-block">{{ $errors->first('setting_rate') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('setting_link_facebook')) has-error @endif">
                                <label class="control-label">Link Facebook</label>
                                <input type="text" class="form-control" id="setting_link_facebook" name="setting_link_facebook" maxlength="255" 
                                       value="{{ old('setting_link_facebook', isset($setting['setting_link_facebook']) ? $setting['setting_link_facebook'] : '') }}" />
                                @if ($errors->has('setting_link_facebook'))
                                <p class="help-block">{{ $errors->first('setting_link_facebook') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('setting_link_twitter')) has-error @endif">
                                <label class="control-label">Link Twitter</label>
                                <input type="text" class="form-control" id="company_name" name="setting_link_twitter" 
                                       maxlength="255" value="{{ old('setting_link_twitter', isset($setting['setting_link_twitter']) ? $setting['setting_link_twitter'] : '') }}" />
                                @if ($errors->has('setting_link_twitter'))
                                  <p class="help-block">{{ $errors->first('setting_link_twitter') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('setting_link_youtube')) has-error @endif">
                                <label class="control-label">Link Twitter</label>
                                <input type="text" class="form-control" id="company_name" name="setting_link_youtube" 
                                       maxlength="255" value="{{ old('setting_link_youtube', isset($setting['setting_link_youtube']) ? $setting['setting_link_youtube'] : '') }}" />
                                @if ($errors->has('setting_link_youtube'))
                                  <p class="help-block">{{ $errors->first('setting_link_youtube') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('setting_link_zalo')) has-error @endif">
                                <label class="control-label">Link Twitter</label>
                                <input type="text" class="form-control" id="company_name" name="setting_link_zalo" 
                                       maxlength="255" value="{{ old('setting_link_zalo', isset($setting['setting_link_zalo']) ? $setting['setting_link_zalo'] : '') }}" />
                                @if ($errors->has('setting_link_zalo'))
                                  <p class="help-block">{{ $errors->first('setting_link_zalo') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('footer_script')

@endsection