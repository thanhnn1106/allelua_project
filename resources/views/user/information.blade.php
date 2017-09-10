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
                        {{ Auth::user()->full_name }}
                    </a>
                </div>
                <div class="allelua-card-desc">
                    {{ config('allelua.user_status.label.' . Auth::user()->status) }}
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
                        <a href="{{ route('user_account_management') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                {{ trans('front.menu_user.lb_account_management') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('user_product_favorite_lists') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                {{ trans('front.menu_user.lb_favorite_product') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('user_order_history') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-folder-o" aria-hidden="true"></i>
                                {{ trans('front.menu_user.lb_bought_product') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('user_change_password') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-cog"></i>
                                {{ trans('front.menu_user.lb_change_password') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('logout') }}" class="nav-link" >
                            <span>
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                {{ trans('front.menu_user.lb_logout') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>