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
        <h1>{{ trans('admin.contact_page.lb_title_list') }}
            <small>{{ trans('admin.contact_page.lb_title_list_small') }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <div class="box">
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="sortable" class="table table-bordered table-striped dataTable table-hover">
                                    @if (count($contactList)==0)
                                        <tr><td colspan="6" align="center">Data not found</td></tr>
                                    @else
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>{{ trans('admin.contact_page.lb_email') }}</th>
                                                <th>{{ trans('admin.contact_page.lb_subject') }}</th>
                                                <th>{{ trans('admin.contact_page.lb_message') }}</th>
                                                <th>{{ trans('admin.contact_page.lb_image') }}</th>
                                                <th>{{ trans('admin.contact_page.lb_status') }}</th>
                                                <th>{{ trans('admin.contact_page.lb_action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0 ?>
                                            @foreach ($contactList as $item)
                                            <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->subject }}</td>
                                                <td>{{ $item->message }}</td>
                                                <td>
                                                    <img style="width:100px; height:100px" src="{{ asset('images/' . $item->image) }}" />
                                                </td>
                                                <td>{!! $statusLabel= getContactStatus($item->status) !!}</td>
                                                <td>
                                                    <a href="{{ route('admin_view_contacts', ['contact_id' => $item->id]) }}" class="btn btn-default btn-xs">
                                                        {{ trans('admin.contact_page.btn_detail') }}
                                                    </a>
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