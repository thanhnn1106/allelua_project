<div class="sizebar-left col-ex-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-ex-pull-10 col-lg-pull-9 col-md-pull-9 col-sm-pull-0" >
    <div class="inner-sizebar clearfix" >
        <aside class="box-aside fillter" data-align-height="left"  data-bottom="20" >
            <div class="aside-heading">
                <h2 class="title-aside clearfix" >
                    <button type="button" class="fa fa-bars pull-xs-left" data-toggle="collapse" href="#navFillter" aria-controls="navFillter">
                        <i class="fa fa-bars pull-xs-left" aria-hidden="true"></i>
                    </button>
                    <span class="pull-xs-left" >@if (isset($cateObj)) {{ $cateObj->title }} @endif</span>
                </h2>
            </div>

            <!-- BEGIN SUB CATEGORY -->
            @include('front.product.partial.sub_category')
            <!-- END SUB CATEGORY -->

            <div class="aside-content" >
                <div class="navbar-toggleable-lg collapse in" id="navFillter" >
                    <div class="bar-fillter clearfix" >
                        <form action="{{ $urlSearch or null }}" method="GET">
                        <!-- filter style: color, brand, size, position_user,... -->
                        @include('front.product.partial.filter_style')
                        <!-- filter style: color, brand, size, position_user,... -->
                        </form>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>