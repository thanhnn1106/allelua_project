@extends('front.layout')
@section('content')

<div class="container">
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
                                <div class="detail-article" >
                                    {!! $pageInfo->content or null !!}
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
</div>
@endsection

@section('footer_script')
<script>

</script>
@endsection
