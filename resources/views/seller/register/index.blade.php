@include('notifications')
<form action="{{ route('seller_register') }}" method="post">
    <div class="form-group">
        <label for="companyName">{{ trans('auth.register.lb_company_name') }}</label>
        <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Enter company name" value="{{ old('company_name') }}" />
    </div>
    <div class="form-group">
        <label for="phoneNumber">{{ trans('auth.register.lb_phone_number') }}</label>
        <input type="text" class="form-control" id="phoneNumber" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}" />
    </div>
    <div class="form-group">
        <label for="email">{{ trans('auth.register.lb_email') }}</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" />
    </div>
    <div class="form-group">
        <label for="password">{{ trans('auth.register.lb_password') }}</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
    </div>
    <div class="form-group">
        <label for="confirmPassword">{{ trans('auth.register.lb_confirm_password') }}</label>
        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Enter confirm password" />
    </div>
    <div class="form-group">
        <label for="country">{{ trans('auth.register.lb_country') }}</label>
        <select class="form-control col-md-9" name="country_id">
            @foreach ($countryList as $item)
                <option value="{{ $item->id }}" {{ (old('country_id') === $item->id) ? 'selected' : ''}}>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-xs-4">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">{{ trans('auth.register.btn_register') }}</button>
    </div>
</form>
