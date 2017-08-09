<div class="link-menu-top hidden-sm-down mini-user" >
    <a href="javascript:void(0);" class="text-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
        <i class="ic i-user"></i>
        {{ trans('front.menu_seller.lb_say_hi') }} {{ Auth::user()->company_name }}
    </a>
    <div class="dropdown-menu">
        <a aria-hidden="true" title="" href="{{ route('seller_account_management') }}">
            <span class="dropdown-item">
                <i class="fa fa-user-o"></i>
                {{ trans('front.menu_seller.lb_account_management') }}
            </span>
        </a>
        <a aria-hidden="true" title="" href="{{ route('seller_new_post') }}">
            <span class="dropdown-item">
                <i class="fa fa-pencil-square-o"></i>
                {{ trans('front.menu_seller.lb_new_post') }}
            </span>
        </a>
        <a aria-hidden="true" title="" href="{{ route('seller_product_index') }}">
            <span class="dropdown-item">
                <i class="fa fa-folder-o"></i>
                {{ trans('front.menu_seller.lb_post_management') }}
            </span>
        </a>
        <a aria-hidden="true" title="" href="{{ route('seller_change_password') }}">
            <span class="dropdown-item">
                <i class="fa fa-cog"></i>
                {{ trans('front.menu_seller.lb_change_password') }}
            </span>
        </a>
        <a aria-hidden="true" title="" href="{{ route('logout') }}">
            <span class="dropdown-item">
                <i class="fa fa-power-off"></i>
                {{ trans('front.menu_seller.lb_logout') }}
            </span>
        </a>
    </div>
</div>