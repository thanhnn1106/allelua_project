<div class="link-menu-top hidden-sm-down mini-user" >
    <a href="javascript:void(0);" class="text-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
        <i class="ic i-user"></i>
        {{ trans('front.menu_seller.lb_say_hi') }} {{ Auth::user()->full_name }}
    </a>
    <div class="dropdown-menu">
        <a aria-hidden="true" title="" href="{{ route('user_account_management') }}">
            <span class="dropdown-item">
                <i class="fa fa-user-o"></i>
                {{ trans('front.menu_user.lb_account_management') }}
            </span>
        </a>
        <a aria-hidden="true" title="" href="{{ route('user_order_history') }}">
            <span class="dropdown-item">
                <i class="fa fa-folder-o"></i>
                {{ trans('front.menu_user.lb_bought_product') }}
            </span>
        </a>
        <a aria-hidden="true" title="" href="{{ route('user_change_password') }}">
            <span class="dropdown-item">
                <i class="fa fa-cog"></i>
                {{ trans('front.menu_user.lb_change_password') }}
            </span>
        </a>
        <a aria-hidden="true" title="" href="{{ route('logout') }}">
            <span class="dropdown-item">
                <i class="fa fa-power-off"></i>
                {{ trans('front.menu_user.lb_logout') }}
            </span>
        </a>
    </div>
</div>
<a href="{{ route('user_product_favorite_lists') }}" class="link-menu-top hidden-sm-down"><i class="ic i-heart" ></i>Danh mục yêu thích</a>