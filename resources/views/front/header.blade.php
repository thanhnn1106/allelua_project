<header class="header" id="header" >
    <div class="top-slider" >
        <div class="container" >
            <div class="row" >
                <div class="col-lg-3 col-md-4 col-sm-7 col-xs-6" >
                    <div class="mini-left-top-slide" >
                        <a class="btn-togle-mm" href="javascript:void(0);" data-toggle="collapse" data-target="#main-navigation" rel="nofollow">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        <span class="txt-type-com" >
                            <a href="/" title="" class="mini-gan" >
                                <span class="mini-logo hidden-sm-down" >
                                    <img src="{{ asset_front('images/logo-gray.png') }}" alt="" class="img-fluid" >
                                </span>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-5 col-xs-6 text-xs-right" >
                    <div class="menu-top clearfix" >
                        @if(Auth::user())
                            @if (Auth::user()->role_id === config('allelua.roles.administrator'))
                                @include('front.partial.header_admin')
                            @elseif (isSeller())
                                @include('front.partial.header_seller')
                            @else
                                @include('front.partial.header_user')
                            @endif
                        @else
                        <div class="link-menu-top hidden-sm-down mini-user" >
                            <a href="javascript:void(0);" class="text-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <i class="ic i-user"></i>
                                {{ trans('front.menu_seller.lb_account') }}
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
                        @endif
                        @if(isUser())
                        <a href="{{ route('cart_list') }}" class="link-menu-top" >
                            <span class="ic i-cart" >
                                <span>                     
                                    <span class="cartCount">{{ $cartCount }}</span>
                                </span>
                            </span>
                            <span class="hidden-md-down" >Giỏ hàng</span>
                        </a>
                        @endif
                        <a href="/" class="link-menu-top hidden-sm-down" >
                            <i class="ic i-phone" ></i>
                            (08) 8888 8888
                        </a>
                        <div class="link-menu-top lang-link" >
                            <a href="javascript:void(0);" class="text-lang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <span class="img-lang" >
                                    <img src="{{ asset_front('dataimages/'.App::getLocale().'.jpg') }}" alt="" class="img-fluid" >
                                </span>
                                <span class="hidden-md-down" >{{ App::getLocale() }}</span>
                                <i class="fa fa-angle-down" data-toggle="dropdown"></i>
                            </a>
                            <div class="dropdown-menu">
                                <span class="dropdown-label" >Chọn ngôn ngữ</span>
                                @foreach($languages as $keyLang => $titleLang)
                                <span class="dropdown-item">
                                    <a title="{{ $titleLang }}" href="{{ route('home_lang', ['lt' => $keyLang]) }}" >
                                        <span class="img-lang" >
                                            <img src="{{ asset_front('dataimages/'.$keyLang.'.jpg') }}" alt="{{ $titleLang }}" class="img-fluid" >
                                        </span>
                                        {{ $titleLang }}
                                    </a>
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="middle-header" >
        <div class="container" >
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2" >
                    <div class="logo-top text-xs-center" >
                        <div class="row" >
                            <div class="col-xs-6 col-xs-offset-3" >
                                <a href="/" title="" >
                                    <img src="{{ asset_front('images/logo.png') }}" alt="" class="img-fluid" >
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-search" >
                        <div class="inner-form-search clearfix" >
                            <form class="fsearch clearfix" action="{{ route('search_page') }}">
                                <div class="inner-fsearch" >
                                    <input type="text" name="q" class="input-search" value="{{ app('request')->input('q') }}" >
                                    <button class="btn-search" >
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <a href="javascript:void(0);" class="btn-capture" >
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>