<div class="sizebar-left col-ex-2 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-ex-pull-10 col-lg-pull-9 col-md-pull-9 col-sm-pull-0" >
    <div class="inner-sizebar clearfix" >
        <aside class="box-aside categories-home" data-align-height="left"  data-bottom="20" >
            <div class="aside-heading">
                <h2 class="title-aside clearfix" >
                    <button type="button" class="pull-xs-left" data-toggle="collapse" href="#navMiniCategory" aria-controls="navMiniCategory">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <span class="pull-xs-left" >
                        {{ trans('front.menu.index') }}
                    </span>    
                    <a href="javascript:void(0);" data-btn="moreMenu" class="pull-xs-right hidden-md-down" >
                        {{ trans('front.menu.view_all') }} >
                    </a>
                </h2>
            </div>

            <!-- BEGIN MEGAMENU -->
            <div class="megamenu hidden-md-down" >
                <div class="inner-megamenu" >
                    @if(isset($categories))
                    <ul class="nav-mmega clearfix" >
                        @foreach($categories as $id => $items)
                        <li>
                            <a href="{{ makeSlug($items['slug']) }}" title="{{ $items['title'] }}" >{{ $items['title'] }}</a>
                            @if(isset($items['childs']))
                            <ul class="ch-nav-mmega" >
                                @foreach($items['childs'] as $sub)
                                <li>
                                    <a href="{{ makeSlug($sub['slug'], $sub['id'], false) }}" title="{{ $sub['title'] }}" >{{ $sub['title'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif;
                </div>
            </div>
            <!-- END MEGAMENU -->

            <div class="aside-content" >
                <div id="cssScrollBarHome" ></div>
                <div class="clearfix scrollbar scrollbar-dynamic" data-place="scrollbarHome" >
                    <nav class="nav-category navbar-toggleable-lg collapse in" id="navMiniCategory" >
                        @if(isset($categories))
                        <ul class="nav navbar-pills">
                            <?php $indexC = 0; ?>
                            @foreach($categories as $id => $items)
                            <?php 
                            $indexC += 1;
                            if($indexC > 13) { break; }
                            ?>
                            <li class="nav-item" >
                                <a href="{{ makeSlug($items['slug']) }}" title="{{ $items['title'] }}" class="nav-link"><span>{{ $items['title'] }}</span></a>
                                <span class="nav-icon-direct" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                                    <i class="fa fa-angle-right" ></i>
                                </span>
                                @if(isset($items['childs']))
                                <ul class="dropdown-menu">
                                    @foreach($items['childs'] as $sub)
                                    <li class="dropdown-submenu nav-item">
                                        <a class="nav-link" href="{{ makeSlug($sub['slug'], $sub['id'], false) }}" title="{{ $items['title'] }}" >{{ $sub['title'] }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </nav>
                </div>
            </div>
        </aside>

    </div>
</div>