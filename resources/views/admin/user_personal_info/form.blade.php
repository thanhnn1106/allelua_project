@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Personal info
            <small>{{ $title }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('notifications')
                <form role="form" action="{{ route('admin_user_personal_update') }}" id="form-product" method="POST" enctype="multipart/form-data">
                <div class="nav-tabs-custom">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <input type="hidden" id="user_id" name="user_id" value="{{ $userInfo->user_id }}" />
                        <button type="submit" class="btn btn-primary btn-sm">{{ trans('admin.personal_info.btn_update') }}</button>
                        <a href="{{ route('admin_user') }}" class="btn btn-default btn-sm">{{ trans('admin.personal_info.btn_back') }}</a>
                    </div>
                    <div class="box-body">
                        <hr>
                        <div class="row">
                            <!-- left -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_taxcode') }}</label>
                                    <input type="text" name="tax_code" id="tax_code" class="form-control border-corner" placeholder="Input ..." value="{{ $userInfo->tax_code }}" />
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_license_business') }}</label>
                                    <input type="text" name="license_business" id="license_business" class="form-control border-corner" placeholder="Input ..." value="{{ $userInfo->license_business }}" />
                                    <p class="help-block"></p>
                                </div>
                                <div id="load_style">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <!-- left -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_bank_account_number') }}</label>
                                    <input type="text" name="bank_account" id="bank_account" class="form-control border-corner" placeholder="Input ..." value="{{ $userBankInfo->account_bank }}" />
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_bank_name') }}</label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control border-corner" placeholder="Input ..." value="{{ $userBankInfo->name_bank }}" />
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ trans('admin.personal_info.lb_bank_address') }}</label>
                                    <input type="text" name="bank_address" id="bank_address" class="form-control border-corner" placeholder="Input ..." value="{{ $userBankInfo->address_bank }}" />
                                    <p class="help-block"></p>
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
                                                <div class="form-group">
                                                    <label class="control-label">{{ trans('admin.personal_info.lb_company_des_' . $lang->iso2) }}</label>
                                                    @foreach ($userTranslateInfo as $item)
                                                        @if ($item->language_code === $lang->iso2)
                                                           <textarea type="text" value="" rows="10" class="form-control border-corner title-slug" lang="{{ $lang->iso2 }}" id="{{ $introduceCompany }}}" name="{{ $introduceCompany }}" placeholder="Input ...">{{ $item->introduce_company }}</textarea>
                                                        @endif
                                                    @endforeach
                                                    <p class="help-block"></p>
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
<script src="{{ asset_admin('js/product.js') }}"></script>
<script>
$(function() {
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