@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.product.lb_title_product') }}
            <small>{{ trans('admin.product.lb_title_list') }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <div class="box">
                    <div class="box-header with-border">
                        <a href="{{ route('admin_product_add') }}" class="btn btn-default btn-sm">{{ trans('admin.product.lb_add_new') }}</a>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped dataTable table-hover">
                                      @if (count($products)==0)
                                        <tr><td colspan="9" align="center">Data not found</td></tr>
                                      @else
                                        <tr>
                                            <th>#ID</th>
                                            <th>{{ trans('admin.product.lb_category') }}</th>
                                            <th>{{ trans('admin.product.lb_seller') }}</th>
                                            <th>{{ trans('admin.product.lb_price') }}</th>
                                            <th>{{ trans('admin.product.lb_quantity') }}</th>
                                            <th>{{ trans('admin.product.lb_payment_method') }}</th>
                                            <th>{{ trans('admin.product.lb_shipping_method') }}</th>
                                            <th>{{ trans('admin.product.lb_status') }}</th>
                                            <th>{{ trans('admin.product.lb_created_date') }}</th>
                                            <th>{{ trans('admin.product.lb_action') }}</th>
                                        </tr>
                                        @foreach($products as $product)
                                        <tr class="odd">
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <a target="_blank" href="{{ route('admin_category_sub', ['id' => $product->category_id]) }}">{!! getCategoryName($product->category_names) !!}</a>
                                            </td>
                                            <td>{{ $product->company_name }}</td>
                                            <td>{{ formatNumber($product->price) }}</td>
                                            <td>{{ formatNumber($product->quantity) }}</td>
                                            <td>{{ getPaymentMethod($product->payment_method) }}</td>
                                            <td>{{ getShippingMethod($product->shipping_method) }}</td>
                                            <td>
                                                <a href="javascript:void(0);" data-url="{{ route('admin_product_change', ['id' => $product->id]) }}" onclick="fncUpdateStatus(this);">
                                                    <span class="label {{ getProductStatusIcon($product->status) }}">{{ getProductStatus($product->status) }}</span>
                                                </a>
                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin_product_edit', ['id' => $product->id]) }}" class="btn btn-default btn-xs">
                                                    {{ trans('admin.product.btn_edit') }}
                                                </a>
                                                <a href="javascript:void(0);" onclick="fncDelete('{{ route('admin_product_delete', array('id' => $product->id)) }}');" class="btn btn-danger btn-xs">
                                                    {{ trans('admin.product.btn_delete') }}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $products->firstItem() }} to {{ $products->count() }} of {{ $products->total() }} entries</div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        {{ $products->links() }}
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
function fncUpdateStatus(obj)
{
    var url = $(obj).attr('data-url');
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