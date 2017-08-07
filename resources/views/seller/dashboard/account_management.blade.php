@extends('front.layout')

@section('content')
<div class="clearfix">
    <ul class="breadcrumbs">
        <li class="home">
            <a href="{{ route('home') }}">{{ trans('front.bread_crum.home') }}</a>
        </li>
        <li><span>{{ trans('front.account_manage_page.lb_title') }}</span></li>
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
                                        <h3><strong>{{ trans('front.account_manage_page.lb_title') }}</strong></h3>
                                    </div>
                                    <form role="form" action="{{ route('seller_account_management') }}" id="form-product" method="POST" enctype="multipart/form-data">
                                        <div class="nav-tabs-custom">
                                            <div class="box-footer">
                                                {{ csrf_field() }}
                                                <!--For Add new -->
                                                <input type="hidden" id="seller_id" name="seller_id" value="{{ (isset($userInfo->user_id)) ? $userInfo->user_id : Auth::user()->id }}" />
                                                <!--For update-->
                                                <input type="hidden" id="user_id" name="user_id" value="{{ (isset($userInfo->user_id)) ? $userInfo->user_id : Auth::user()->id }}" />
                                                <input type="hidden" id="action" name="action" value="{{ $action }}" />
                                                <button type="submit" class="btn btn-primary btn-sm">{{ ($action === 'update') ? trans('front.account_manage_page.btn_update') : trans('front.account_manage_page.btn_add')}}</button>
                                            </div>
                                            <div class="box-body">
                                                <hr>
                                                <div class="row">
                                                    <!-- left -->
                                                    <div class="col-md-6">
                                                        <div class="form-group input-group-sm @if ($errors->has('tax_code')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_taxcode') }} (*)</label>
                                                            <input type="text" name="tax_code" id="tax_code" class="form-control border-corner" placeholder="" value="{{ (isset($userInfo->tax_code)) ? $userInfo->tax_code : ''}}" />
                                                            @if ($errors->has('tax_code'))
                                                            <p class="help-block">{{ $errors->first('tax_code') }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group input-group-sm @if ($errors->has('license_business')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_license_business') }} (*)</label>
                                                            <input type="text" name="license_business" id="license_business" class="form-control border-corner" placeholder="" value="{{ (isset($userInfo->license_business)) ? $userInfo->license_business : ''}}" />
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
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_bank_account_number') }} (*)</label>
                                                            <input type="text" name="bank_account" id="bank_account" class="form-control border-corner" placeholder="" value="{{ (isset($userBankInfo->account_bank)) ? $userBankInfo->account_bank : '' }}" />
                                                            @if ($errors->has('bank_account'))
                                                            <p class="help-block">{{ $errors->first('bank_account') }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group input-group-sm @if ($errors->has('bank_name')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_bank_name') }} (*)</label>
                                                            <input type="text" name="bank_name" id="bank_name" class="form-control border-corner" placeholder="" value="{{ (isset($userBankInfo->name_bank)) ? $userBankInfo->name_bank : '' }}" />
                                                            @if ($errors->has('bank_name'))
                                                            <p class="help-block">{{ $errors->first('bank_name') }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group input-group-sm @if ($errors->has('bank_address')) has-error @endif">
                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_bank_address') }} (*)</label>
                                                            <input type="text" name="bank_address" id="bank_address" class="form-control border-corner" placeholder="" value="{{ (isset($userBankInfo->address_bank)) ? $userBankInfo->address_bank : '' }}" />
                                                            @if ($errors->has('bank_address'))
                                                            <p class="help-block">{{ $errors->first('bank_address') }}</p>
                                                            @endif
                                                        </div>
                                                        <div id="load_style">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="clearfix" >
                                                    <ul class="nav nav-inline nav-tab-detailspro clearfix" role="tablist">
                                                        @foreach ($languages as $lang)
                                                        <li class="nav-item" >
                                                            <a class="nav-link <?php if ($lang->iso2 === 'vi') echo 'active'; ?>" data-toggle="tab" href="#tab_{{ $lang->iso2 }}" role="tab" rel="nofollow" >
                                                                {{ $lang->name }}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="tab-content">
                                                    @foreach ($languages as $lang)
                                                    <div class="tab-pane @if($lang->iso2 === 'vi') active @endif" id="tab_{{ $lang->iso2 }}">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="box">
                                                                    <div class="box-body">
                                                                        <?php
                                                                            $introduceCompany = 'introduce_company_' . $lang->iso2;
                                                                        ?>
                                                                        <div class="form-group @if ($errors->has($introduceCompany)) has-error @endif">
                                                                            <label class="control-label">{{ trans('front.account_manage_page.lb_company_des_' . $lang->iso2) }} (*)</label>
                                                                            @if ($userTranslateInfo != null)
                                                                                @foreach ($userTranslateInfo as $item)
                                                                                    @if ($item->language_code === $lang->iso2)
                                                                                        <textarea type="text" value="" rows="10" class="form-control border-corner title-slug" lang="{{ $lang->iso2 }}" id="{{ $introduceCompany }}}" name="{{ $introduceCompany }}" placeholder="">{{ $item->introduce_company }}</textarea>
                                                                                        @if ($errors->has($introduceCompany))
                                                                                        <p class="help-block">{{ $errors->first($introduceCompany) }}</p>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <textarea type="text" value="" rows="10" class="form-control border-corner title-slug" lang="{{ $lang->iso2 }}" id="{{ $introduceCompany }}}" name="{{ $introduceCompany }}" placeholder=""></textarea>
                                                                                @if ($errors->has('introduce_company_vi') || $errors->has('introduce_company_en'))
                                                                                    <p class="help-block">{{ $errors->first('introduce_company_vi') }} {{ $errors->first('introduce_company_en') }}</p>
                                                                                @endif
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
