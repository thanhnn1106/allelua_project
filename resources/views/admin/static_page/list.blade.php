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
        <h1>{{ trans('admin.static_page.lb_title_list') }}
            <small>{{ trans('admin.static_page.lb_title_list_small') }}</small>
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
                                    @if (count($pageInfoList)==0)
                                        <tr><td colspan="6" align="center">Data not found</td></tr>
                                    @else
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>{{ trans('admin.static_page.lb_page_name') }}</th>
                                                @foreach($langs as $lang)
                                                <th>{{ trans('admin.static_page.lb_slug') }}({{ $lang->name }})</th>
                                                <th>{{ trans('admin.static_page.lb_page_content') }}({{ $lang->name }})</th>
                                                @endforeach
                                                <th>{{ trans('admin.static_page.lb_status_show') }}</th>
                                                <th>{{ trans('admin.static_page.lb_action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pageInfoList as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->title }}</td>
                                                <?php 
                                                    $titles = splitTitle($item->content, $item->langs);
                                                    $slug   = splitTitle($item->slug, $item->langs); 
                                                ?>
                                                @foreach($slug as $code => $slug)
                                                <td>{{ $slug }}</td>
                                                @endforeach
                                                @foreach($titles as $code => $title)
                                                <td>{{ $title }}</td>
                                                @endforeach
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <a href="{{ route('admin_edit_static_page', ['page_id' => $item->id]) }}" class="btn btn-default btn-xs">
                                                       {{ trans('admin.static_page.btn_edit') }}
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