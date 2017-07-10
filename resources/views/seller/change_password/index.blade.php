@extends('layout')
@include('notifications')
<h1>Seller change password</h1>
<form action="{{ route('seller_change_password') }}" method="post">
    <div class="form-group">
        <label for="current_password">{{ trans('auth.change_password.lb_current_password') }}</label>
        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password" value="{{ old('current_password') }}" />
    </div>
    <div class="form-group">
        <label for="new_password">{{ trans('auth.change_password.lb_new_password') }}</label>
        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" value="{{ old('new_password') }}" />
    </div>
    <div class="form-group">
        <label for="confirm_password">{{ trans('auth.change_password.lb_confirm_new_password') }}</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter new password" value="{{ old('confirm_password') }}">
    </div>
    <div class="col-xs-4">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">{{ trans('auth.change_password.btn_save') }}</button>
    </div>
</form>
