<div class="link-menu-top hidden-sm-down mini-user" >
    <a href="javascript:void(0);" class="text-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
        <i class="ic i-user"></i>
        {{ trans('front.menu_seller.lb_say_hi') }} {{ Auth::user()->company_name }}
    </a>
    <div class="dropdown-menu">
        <a title="{{ trans('front.menu_seller.lb_sign_in') }}" href="{{ route('seller_login') }}">
            <span class="dropdown-item">
                {{ trans('front.menu_seller.lb_sign_in') }}
            </span>
        </a>
        <a title="{{ trans('front.menu_user.lbl_sign_in') }}" href="{{ route('user_login') }}">
            <span class="dropdown-item">
                {{ trans('front.menu_user.lbl_sign_in') }}
            </span>
        </a>
    </div>
</div>