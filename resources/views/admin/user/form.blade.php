@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Users
            <small>Add new</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <div class="box box-primary">
                    <form role="form" action="{{ $action }}" id="form-user" method="post">
                        <div class="box-body">
                            <div class="form-group input-group-sm @if ($errors->has('company_name')) has-error @endif">
                                <label class="control-label">Company name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" 
                                       maxlength="255" value="{{ old('company_name', isset($user->company_name) ? $user->company_name : '') }}" />
                                @if ($errors->has('company_name'))
                                  <p class="help-block">{{ $errors->first('company_name') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('email')) has-error @endif">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" maxlength="255" 
                                       value="{{ old('email', isset($user->email) ? $user->email : '') }}" @if(isset($user) && $user->id) disabled="disabled" @endif />
                                @if ($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('password')) has-error @endif">
                                <label class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" maxlength="255" value="" />
                                @if ($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('confirm_password')) has-error @endif">
                                <label class="control-label">Confirm password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" maxlength="255" value="" />
                                @if ($errors->has('confirm_password'))
                                <p class="help-block">{{ $errors->first('confirm_password') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('phone_number')) has-error @endif">
                                <label class="control-label">Phone number</label>
                                <input type="text" class="form-control" id="company_name" name="phone_number" 
                                       maxlength="255" value="{{ old('phone_number', isset($user->phone_number) ? $user->phone_number : '') }}" />
                                @if ($errors->has('phone_number'))
                                  <p class="help-block">{{ $errors->first('phone_number') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('roles')) has-error @endif">
                                <label class="control-label">Roles</label>
                                <select name="roles" id="roles" class="form-control">
                                    <option value="">------</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}"  @if (old('roles', isset($user->role_id) ? $user->role_id : '') == $role->id) selected="selected" @endif>{{ $role->role }}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('roles'))
                                <p class="help-block">{{ $errors->first('roles') }}</p>
                                @endif
                            </div>

                            <div class="form-group input-group-sm @if ($errors->has('country')) has-error @endif">
                                <label class="control-label">Country</label>
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

                            <div class="form-group @if ($errors->has('status')) has-error @endif">
                                <input type="radio" name="status" id="status_1" value="{{ config('allelua.user_status_value.active') }}" @if (old('status', isset($user->status) ? $user->status : '') == 1) checked="checked" @endif />
                                <label for="status_1">Active</label>

                                <input type="radio" name="status" id="status_0" value="{{ config('allelua.user_status_value.inactive') }}" @if (old('status', isset($user->status) ? $user->status : '') != 1) checked="checked" @endif />
                                <label for="status_0">Inactive</label>
                                @if ($errors->has('type_available'))
                                <p class="help-block">{{ $errors->first('type_available') }}</p>
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