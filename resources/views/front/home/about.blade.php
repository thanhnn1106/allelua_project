@extends('front.layout')
@section('content')

<div class="col-sm-12" >
    <div class="breadcrumbs-box" >
        <div class="container" >
            <div class="clearfix" >
                <ul class="breadcrumbs" >
                    <li class="home" ><a href="{{ route('home') }}" >{{ trans('front.bread_crum.home') }}</a></li>
                    <li>
                        <span>Về Allelua.com</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-main clearfix" >
        <div class="container" >
            <div class="row" >
                <div class="col-sm-12" >
                    <div class="content-center" >
                        <div class="inner-content-center clearfix" >
                            <div class="row" >
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" >
                                    <div class="detail-article" >
                                        {!! $pageInfo->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <!-- BEGIN COUNTRY AND SERVICE -->
    @include('front.partial.country_service')
    <!-- END COUNTRY AND SERVICE -->

@endsection

@section('footer_script')
<script>

</script>
@endsection