@extends('admin.layout')
@section('content')
<style>
    .marker { opacity:0.0; }
</style>
<style name="impostor_size">
    .marker + tr { border-top-width:0px; }
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.personal_info.lb_title_list') }}
            <small>{{ trans('admin.personal_info.lb_title_list_small') }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <div class="box">
                    <div class="box-header with-border">
                        {{ csrf_field() }}
                        <a href="{{ route('admin_user_personal_add') }}" class="btn btn-primary btn-sm">
                            {{ trans('admin.personal_info.btn_add') }}
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="sortable" class="table table-bordered table-striped dataTable table-hover">
                                    @if (count($userPersonalInfoList)==0)
                                        <tr><td colspan="6" align="center">Data not found</td></tr>
                                    @else
                                        <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>{{ trans('admin.personal_info.lb_company_name') }}</th>
                                            <th>{{ trans('admin.personal_info.lb_taxcode') }}</th>
                                            <th>{{ trans('admin.personal_info.lb_license_business') }}</th>
                                            <th>{{ trans('admin.personal_info.lb_bank_account_number') }}</th>
                                            <th>{{ trans('admin.personal_info.lb_bank_name') }}</th>
                                            <th>{{ trans('admin.personal_info.lb_bank_address') }}</th>
                                            @foreach($langs as $lang)
                                            <th>{{ trans('admin.personal_info.lb_introduce_company') }} ({{ $lang->name }})</th>
                                            @endforeach
                                            <th>{{ trans('admin.personal_info.btn_action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($userPersonalInfoList as $personalInfo)
                                        <tr class="odd ui-state-default">
                                            <td>{{ $personalInfo->id }}</td>
                                            <td>{{ $personalInfo->company_name }}</td>
                                            <td>{{ $personalInfo->tax_code }}</td>
                                            <td>{{ $personalInfo->license_business }}</td>
                                            <td>{{ $personalInfo->account_bank }}</td>
                                            <td>{{ $personalInfo->name_bank }}</td>
                                            <td>{{ $personalInfo->address_bank }}</td>
                                            <?php $titles = splitTitle($personalInfo->introduce_company, $personalInfo->langs); ?>
                                            @foreach($titles as $code => $title)
                                            <td>{{ $title }}</td>
                                            @endforeach
                                            <td>
                                                <a href="{{ route('admin_user_personal_edit', ['id' => $personalInfo->user_id]) }}" class="btn btn-default btn-xs">{{ trans('admin.personal_info.btn_edit') }}</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
      </div>
    </section>
</div>
@endsection

@section('footer_script')
<script>
</script>
@endsection