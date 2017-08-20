@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.profile.lb_profile') }}
            <small>{{ trans('admin.profile.lb_edit') }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <div class="box box-primary">
                    <form role="form" action="{{ route('admin_profile') }}" id="form-user" method="post">
                        <div class="box-body">
                            <div class="form-group input-group-sm @if ($errors->has('company_name')) has-error @endif">
                                <label class="control-label">{{ trans('admin.profile.lb_company_name') }}</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" 
                                       maxlength="255" value="{{ old('company_name', isset($user->company_name) ? $user->company_name : '') }}" />
                                @if ($errors->has('company_name'))
                                  <p class="help-block">{{ $errors->first('company_name') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('email')) has-error @endif">
                                <label class="control-label">{{ trans('admin.profile.lb_email') }}</label>
                                <input type="text" class="form-control" id="email" name="email" maxlength="255" value="{{ old('email', isset($user->email) ? $user->email : '') }}" disabled="disabled" />
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('password')) has-error @endif">
                                <label class="control-label">{{ trans('admin.profile.lb_password') }}</label>
                                <input type="password" class="form-control" id="password" name="password" maxlength="255" value="" />
                                @if ($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('confirm_password')) has-error @endif">
                                <label class="control-label">{{ trans('admin.profile.lb_confirm_password') }}</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" maxlength="255" value="" />
                                @if ($errors->has('confirm_password'))
                                <p class="help-block">{{ $errors->first('confirm_password') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('phone_number')) has-error @endif">
                                <label class="control-label">{{ trans('admin.profile.lb_phone_number') }}</label>
                                <input type="text" class="form-control" id="company_name" name="phone_number" 
                                       maxlength="255" value="{{ old('phone_number', isset($user->phone_number) ? $user->phone_number : '') }}" />
                                @if ($errors->has('phone_number'))
                                  <p class="help-block">{{ $errors->first('phone_number') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('country')) has-error @endif">
                                <label class="control-label">{{ trans('admin.profile.lb_country') }}</label>
                                <select name="country" id="country" class="form-control">
                                    <option value="">------</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}"  @if (old('country', isset($user->country_id) ? $user->country_id : '') == $country->id) selected="selected" @endif>{{ $country->name }}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('country'))
                                <p class="help-block">{{ $errors->first('country') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">{{ trans('admin.profile.btn_submit') }}</button>
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