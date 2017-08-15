@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.order_page.lb_title_list') }}
            <small>{{ trans('admin.order_page.lb_title_list_small') }}</small>
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
                                    <table class="table table-bordered table-striped dataTable table-hover">
                                      @if (count($orderList)==0)
                                        <tr><td colspan="9" align="center">Data not found</td></tr>
                                      @else
                                        <tr>
                                            <th>{{ trans('admin.order_page.lb_order_id') }}</th>
                                            <th>{{ trans('admin.order_page.lb_seller') }}</th>
                                            <th>{{ trans('admin.order_page.lb_customer_name') }}</th>
                                            <th>{{ trans('admin.order_page.lb_customer_email') }}</th>
                                            <th>{{ trans('admin.order_page.lb_product_name') }}</th>
                                            <th>{{ trans('admin.order_page.lb_price') }}</th>
                                            <th>{{ trans('admin.order_page.lb_quantity') }}</th>
                                            <th>{{ trans('admin.order_page.lb_total') }}</th>
                                            <th>{{ trans('admin.order_page.lb_status') }}</th>
                                            <th>{{ trans('admin.order_page.lb_created_at') }}</th>
                                        </tr>
                                        @foreach($orderList as $item)
                                        <tr class="odd">
                                            <td>{{ $item->order_id }}</td>
                                            <td>{{ $item->seller_name }}</td>
                                            <td>{{ $item->customer_full_name }}</td>
                                            <td>{{ $item->customer_email }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price*$item->quantity }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $orderList->firstItem() }} to {{ $orderList->count() }} of {{ $orderList->total() }} entries</div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        {{ $orderList->links() }}
                                    </div>
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
function fncUpdateStatus(url)
{
    if (!confirm('Are you sure active or inactive this product ?')) {
        return false;
    }
    window.location.href = url;
}
function fncDelete(url)
{
    if (!confirm('Are you sure delete this product ?')) {
        return false;
    }
    window.location.href = url;
}
</script>
@endsection