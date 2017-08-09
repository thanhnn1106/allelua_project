<div class="clearfix save-marle col-ex-10 col-lg-9 col-md-9 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-3 col-sm-push-0" data-align-height="right"  data-bottom="20" >
    <div class="page-right clearfix" >
        <div class="row" >
            <div class="col-sm-12" >
                <div class="content-center" >
                    <div class="inner-content-center clearfix" >
                        <div class="list-product clearfix" data-total="@if(isset($products)) {{ $products->total() }} @endif" data-start="@if(isset($products)) {{ $products->currentPage() }} @endif">
                            <!-- BEGIN PRODUCT LISTS -->
                            @include('front.product.partial.list_product')
                            <!-- END PRODUCT LISTS -->
                        </div>
                        <div class="nav-paging clearfix" >
                            <nav class="pull-right">
                                {{ $products->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>