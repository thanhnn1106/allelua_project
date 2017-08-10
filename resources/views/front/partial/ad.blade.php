<div class="clearfix save-marle col-ex-10 col-lg-9 col-md-9 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-3 col-sm-push-0" data-align-height="right"  data-bottom="20" >
    <div class="page-right clearfix" >
        <div class="row" >
            <div class="col-sm-12" >
                <div class="content-center" >
                    <div class="inner-content-center clearfix" >

                        <div class="banner-box" data-place="groupBannerHome" >
                            <div class="row" >
                                @if(count($cateHomes))
                                <div class="col-sm-8" >
                                    <div class="row" >

                                        <div class="col-sm-12" >
                                            <div class="row">
                                                @foreach($cateHomes as $itemH)
                                                <div class="col-xs-6">
                                                    <div class="item-banner text-xs-center" >
                                                        <a href="{{ makeSlug($itemH->slug) }}" title="{{ $itemH->title }}" class="banner-link" >
                                                            <img src="{{ asset_front('dataimages/'.$itemH->type.'.gif') }}" alt="{{ $itemH->title }}" class="img-fluid" >
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!--
                                        <div class="col-sm-12" >
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="item-banner text-xs-center" >
                                                        <a href="/" title="" class="banner-link" >
                                                            <img src="{{ asset_front('dataimages/bn3.jpg') }}" alt="" class="img-fluid" >
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="item-banner text-xs-center" >
                                                        <a href="/" title="" class="banner-link" >
                                                            <img src="{{ asset_front('dataimages/bn4.jpg') }}" alt="" class="img-fluid" >
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-4 col-xs-12" >
                                    <div class="item-banner text-xs-center" >
                                        <a href="/" title="" class="banner-link" >
                                            <img src="{{ asset_front('dataimages/ad1.gif') }}" alt="" class="img-fluid" >
                                        </a>
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