@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.contact_page.lb_title_list') }}
            <small>{{ trans('admin.contact_page.lb_detail') }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('notifications')
                <form role="form" action="{{ route('admin_view_contacts', ['contact_id' => $contactDetail->id]) }}" id="form-product" method="POST" enctype="multipart/form-data">
                <div class="nav-tabs-custom">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-sm">{{ trans('admin.contact_page.btn_save') }}</button>
                        <a href="{{ route('admin_manage_contacts') }}" class="btn btn-default btn-sm">{{ trans('admin.contact_page.btn_back') }}</a>
                    </div>
                    <div class="box-body">
                        <hr>
                        <div class="row">
                            <!-- left -->
                            <div class="col-md-12">
                                <label class="control-label col-md-2">{{ trans('admin.contact_page.lb_email') }}</label>
                                <span class="col-md-6">{{ $contactDetail->email }}</span>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-md-2">{{ trans('admin.contact_page.lb_subject') }}</label>
                                <span class="text-default col-md-6">{{ $contactDetail->subject }}</span>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-md-2">{{ trans('admin.contact_page.lb_message') }}</label>
                                <span class="text-default col-md-6">{{ $contactDetail->message }}</span>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-md-2">{{ trans('admin.contact_page.lb_image') }}</label>
                                <span class="text-default col-md-6">
                                    <img style="width:200px; height:200px" src="{{ asset('images/' . $contactDetail->image) }}" />
                                </span>
                            </div>
                            <div class="col-md-12" style="margin-top:10px">
                                <label class="control-label col-md-2">{{ trans('admin.contact_page.lb_noted') }}</label>
                                <div class="col-md-6">
                                    <textarea rows="5" type="text" name="noted" id="noted" class="form-control border-corner" value="" placeholder="">{{ $contactDetail->noted }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top:10px">
                                <label class="control-label col-md-2">{{ trans('admin.contact_page.lb_update_status') }}</label>
                                <div class="col-md-6">
                                    <select class="col-md-6" name="status" id="status">
                                        <option class="col-md-6" @if ($contactDetail->status == '0') selected @endif value="0">{{ trans('admin.contact_page.lb_waiting') }}</option>
                                        <option class="col-md-6" @if ($contactDetail->status == '1') selected @endif value="1">{{ trans('admin.contact_page.lb_processing') }}</option>
                                        <option class="col-md-6" @if ($contactDetail->status == '2') selected @endif value="2">{{ trans('admin.contact_page.lb_done') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
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
</script>

@endsection