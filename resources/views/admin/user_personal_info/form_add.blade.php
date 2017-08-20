@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.personal_info.lb_title_list') }}
            <small>{{ $title }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('notifications')
                <form role="form" action="{{ route('admin_user_personal_add') }}" id="form-product" method="POST" enctype="multipart/form-data">
                <div class="nav-tabs-custom">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-sm">{{ trans('admin.personal_info.btn_add') }}</button>
                        <a href="{{ route('admin_user_personal_list') }}" class="btn btn-default btn-sm">{{ trans('admin.personal_info.btn_back') }}</a>
                    </div>
                    <div class="box-body">
                        <hr>
                        <div class="row">
                            <!-- left -->
                            <div class="col-md-6">
                                <div class="form-group input-group-sm @if ($errors->has('seller_id')) has-error @endif">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_company_name') }}</label>
                                    <input type="text" class="form-control border-corner" data-url="{{ route('ajax_load_seller_personal') }}" name="seller" id="seller" placeholder="Input ..." value="{{ old('seller') }}" />
                                    <input type="hidden" name="user_id" id="user_id" value="{{ old('user_id') }}">
                                    @if ($errors->has('seller') || $errors->has('user_id'))
                                      <p class="help-block">{{ $errors->first('user_id') }}</p>
                                    @endif
                                </div>
                                <div class="form-group input-group-sm @if ($errors->has('tax_code')) has-error @endif">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_taxcode') }}</label>
                                    <input type="text" name="tax_code" id="tax_code" class="form-control border-corner" placeholder="Input ..." value="{{ old('tax_code') }}" />
                                    @if ($errors->has('tax_code'))
                                      <p class="help-block">{{ $errors->first('tax_code') }}</p>
                                    @endif
                                </div>
                                <div class="form-group input-group-sm @if ($errors->has('license_business')) has-error @endif">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_license_business') }}</label>
                                    <input type="text" name="license_business" id="license_business" class="form-control border-corner" placeholder="Input ..." value="{{ old('license_business') }}" />
                                    @if ($errors->has('license_business'))
                                      <p class="help-block">{{ $errors->first('license_business') }}</p>
                                    @endif
                                </div>
                                <div id="load_style">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <!-- left -->
                            <div class="col-md-6">
                                <div class="form-group input-group-sm @if ($errors->has('bank_account')) has-error @endif">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_bank_account_number') }}</label>
                                    <input type="text" name="bank_account" id="bank_account" class="form-control border-corner" placeholder="Input ..." value="{{ old('bank_account') }}" />
                                    @if ($errors->has('bank_account'))
                                      <p class="help-block">{{ $errors->first('bank_account') }}</p>
                                    @endif
                                </div>
                                <div class="form-group input-group-sm @if ($errors->has('bank_name')) has-error @endif">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_bank_name') }}</label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control border-corner" placeholder="Input ..." value="{{ old('bank_name') }}" />
                                    @if ($errors->has('bank_name'))
                                      <p class="help-block">{{ $errors->first('bank_name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group input-group-sm @if ($errors->has('bank_address')) has-error @endif">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_bank_address') }}</label>
                                    <input type="text" name="bank_address" id="bank_address" class="form-control border-corner" placeholder="Input ..." value="{{ old('bank_address') }}" />
                                    @if ($errors->has('bank_address'))
                                      <p class="help-block">{{ $errors->first('bank_address') }}</p>
                                    @endif
                                </div>
                                <div id="load_style">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <ul class="nav nav-tabs">
                            @foreach ($languages as $lang)
                            <li @if($lang->iso2 === 'vi') class="active" @endif><a href="#tab_{{ $lang->iso2 }}" data-toggle="tab">{{ $lang->name }}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($languages as $lang)
                            <div class="tab-pane @if($lang->iso2 === 'vi') active @endif" id="tab_{{ $lang->iso2 }}">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="box">
                                            <div class="box-body">
                                                <?php 
                                                    $introduceCompany = 'introduce_company_'.$lang->iso2;
                                                ?>
                                                <div class="form-group @if ($errors->has($introduceCompany)) has-error @endif">
                                                    <label class="control-label">{{ trans('admin.personal_info.lb_company_des_' . $lang->iso2) }}</label>
                                                    <textarea type="text" value="" rows="10" class="form-control border-corner title-slug" lang="{{ $lang->iso2 }}" id="{{ $introduceCompany }}}" name="{{ $introduceCompany }}" placeholder="Input ...">{{ old($introduceCompany) }}</textarea>
                                                    @if ($errors->has($introduceCompany))
                                                        <p class="help-block">{{ $errors->first($introduceCompany) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                </form>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
@endsection

@section('footer_script')
<script>
$(function() {
    // Autocomplete postal code
    var urlSeller = $( "#seller" ).attr('data-url');
    $( "#seller" ).autocomplete({
        source: function (request, response) {
            $.ajax({
                data: {
                    term: request.term
                },
                global: false,
                type: 'GET',
                url: urlSeller,
                success: function (data) {
                    if(data.length) {
                        response(data);
                    } else {
                        $('#seller_id').val('');
                    }
                }
            });
        },
        minLength: 5,
        select: function( event, ui ) {
            $('#seller').val(ui.item.value);
            $('#user_id').val(ui.item.id);
        }
    });
    $('.title-cate').bind('keyup change', function () {
       createSlugLink($(this));
    });
    function createSlugLink(obj) {
        var lang = $(obj).attr('lang');
        var str = $(obj).val();
        var slug = formatSlug(str);
        $(obj).closest('.box-body').find('.slug-'+lang).html(slug);
    }
});
</script>

@endsection