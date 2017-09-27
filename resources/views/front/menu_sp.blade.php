<div class="mask-mobie-menu" ></div>
<div class="coz-mobie-menu" >
    <div class="close-mobie-menu" >
        <a href="javascript:void(0);" >
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
    </div>
    <div class="inner-mobie-menu scrollbar scrollbar-dynamic" data-place="scrollbarMenuMobile" >
        <div class="coz-mobie-menu-content clearfix" >
            <div class="mm-mobie-search" >
                <form action="/search" class="clearfix" method="GET" >
                    <div class="mim-mobie-search clearfix" >
                        <input type="text" name="keyword" class="input-mobie-search" placeholder="keyword ..." >
                        <button type="submit" class="mm-btn-search" >
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="mm-mobie-language" >
                <?php $iLang = 0; ?>
                @foreach($languages as $keyLang => $titleLang)
                <?php $iLang++; ?>
                <a href="{{ route('home_lang', ['lt' => $keyLang]) }}" title="{{ $titleLang }}" rel="nofollow" class="link-mobie-language @if(App::getLocale() == $keyLang) active @endif" >{{ $titleLang }}</a>
                @if($iLang < count($languages))
                <span class="separator-mobie-language" >|</span>
                @endif
                @endforeach
            </div>
            <div class="mm-mobie-nav" >
                <div class="mm-mobie-nav-static" >
                    <ul class="list-nav-mmobie" >

                        <li class="has-sub"  >
                            <a href="" class="nav-item-mmobile has-ic-left" >
                                <span class="mm-left-ic" >
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                                <span class="mm-text" >Tài khoản</span>
                                <span class="mm-right-ic" >
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </span>
                            </a>
                            <div class="sub-nav-mmobile" >
                                <ul class="list-nav-mmobie" >
                                    @if(Auth::user())
                                        @if (Auth::user()->role_id === config('allelua.roles.administrator'))
                                        <li >
                                            <a title="{{ Auth::user()->company_name }}" href="{{ route('admin_dashboard') }}" class="nav-item-mmobile has-ic-left" >
                                                <span class="mm-left-ic" >
                                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                </span>
                                                <span class="mm-text" >{{ trans('front.menu_seller.lb_say_hi') }} {{ Auth::user()->company_name }}</span>
                                            </a>
                                        </li>
                                        @elseif (isSeller())
                                            <li>
                                                <a title="{{ Auth::user()->company_name }}" href="{{ route('seller_account_management') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_seller.lb_say_hi') }} {{ Auth::user()->company_name }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('front.menu_seller.lb_new_post') }}" href="{{ route('seller_product_create') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_seller.lb_new_post') }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('front.menu_seller.lb_post_management') }}" href="{{ route('seller_product_index') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_seller.lb_post_management') }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('front.menu_seller.lb_change_password') }}" href="{{ route('seller_change_password') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_seller.lb_change_password') }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('front.menu_seller.lb_manage_order') }}" href="{{ route('seller_manange_order') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_seller.lb_manage_order') }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('front.menu_seller.lb_logout') }}" href="{{ route('logout') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_seller.lb_logout') }}</span>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a title="{{ Auth::user()->company_name }}" href="{{ route('user_account_management') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_seller.lb_say_hi') }} {{ Auth::user()->company_name }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('front.menu_seller.lb_bought_product') }}" href="{{ route('user_order_history') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_user.lb_bought_product') }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('front.menu_seller.lb_change_password') }}" href="{{ route('user_change_password') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_user.lb_change_password') }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="{{ trans('front.menu_seller.lb_logout') }}" href="{{ route('logout') }}" class="nav-item-mmobile has-ic-left" >
                                                    <span class="mm-left-ic" >
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="mm-text" >{{ trans('front.menu_user.lb_logout') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @else
                                    <li>
                                        <a title="{{ trans('front.menu_seller.lb_sign_in') }}" href="{{ route('seller_login') }}" class="nav-item-mmobile has-ic-left" >
                                            <span class="mm-left-ic" >
                                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                                            </span>
                                            <span class="mm-text" >{{ trans('front.menu_seller.lb_sign_in') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="{{ trans('front.menu_user.lbl_sign_in') }}" href="{{ route('user_login') }}" class="nav-item-mmobile has-ic-left" >
                                            <span class="mm-left-ic" >
                                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                                            </span>
                                            <span class="mm-text" >{{ trans('front.menu_user.lbl_sign_in') }}</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>

                        @if(isUser() || ! Auth::user())
                        <li>
                            <a href="{{ route('cart_list') }}" title="" class="nav-item-mmobile has-ic-left">
                                <span class="mm-left-ic" >
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </span>
                                <span class="mm-text">Giỏ hàng( {{ $cartCount }} )</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>

                @if(isset($sp_categories))
                <div class="mm-mobie-nav-tree" >
                    <ul class="list-nav-tree-mmobie" >
                        @foreach($sp_categories as $id => $items)
                        <li class="has-sub" >
                            <a href="{{ makeSlug($items['slug']) }}" title="{{ $items['title'] }}" title="{{ $items['title'] }}" class="nav-item-mmobile">
                                <span class="mm-text">{{ $items['title'] }}</span>
                                <span class="mm-right-ic" >
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </span>
                            </a>
                            @if(isset($items['childs']))
                            <div class="sub-nav-mmobile">
                                <ul class="list-nav-mmobie">
                                    @foreach($items['childs'] as $sub)
                                    <li class="has-sub">
                                        <a href="{{ makeSlug($sub['slug'], $sub['id'], false) }}" title="{{ $sub['title'] }}" class="nav-item-mmobile has-ic-left">
                                            <span class="mm-left-ic" >
                                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                                            </span>
                                            <span class="mm-text">{{ $sub['title'] }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>