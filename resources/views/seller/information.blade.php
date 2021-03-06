<aside class="box-aside" >
    <div class="clearfix">
        <div class="allelua-card hovercard" >
            <div class="allelua-cardheader"></div>
            <div class="allelua-card-avatar">
                <img alt="adm team" src="{{ asset_front('dataimages/no-photo-100x100.png') }}">
            </div>
            <div class="allelua-card-info">
                <div class="allelua-card-title">
                    <a href="/profile">
                        {{ Auth::user()->company_name }}
                    </a>
                </div>
                <div class="allelua-card-desc">
                    {{ config('allelua.user_statua.label.' . Auth::user()->company_name) }}
                </div>
                <div class="allelua-card-desc">{{ Auth::user()->email }}</div>
                <div class="allelua-card-desc">
                    0 Điểm                        
                </div>
            </div>
            <div class="allelua-card-bottom">
                <a class="btn allelua-card-btn btn-primary btn-twitter btn-sm" href="#">
                    <i class="fa fa-twitter"></i>
                </a>
                <a class="btn allelua-card-btn btn-danger btn-sm" rel="publisher" href="#">
                    <i class="fa fa-google-plus"></i>
                </a>
                <a class="btn allelua-card-btn btn-primary btn-sm" rel="publisher" href="#">
                    <i class="fa fa-facebook"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="aside-content" >
        <div class="clearfix" >
            <nav class="navbar-toggleable-lg collapse in" >
                <ul class="nav navbar-pills nav-member">
                    <li class="nav-item" >
                        <a href="{{ route('seller_account_management') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                {{ trans('front.menu_seller.lb_account_management') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('seller_product_create') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                {{ trans('front.menu_seller.lb_new_post') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('seller_product_index') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-folder-o" aria-hidden="true"></i>
                                {{ trans('front.menu_seller.lb_post_management') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('seller_change_password') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-cog"></i>
                                {{ trans('front.menu_seller.lb_change_password') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('seller_manange_order') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-list"></i>
                                {{ trans('front.menu_seller.lb_manage_order') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('logout') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                {{ trans('front.menu_seller.lb_logout') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>