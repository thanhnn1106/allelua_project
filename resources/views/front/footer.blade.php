<footer class="footer" >
    <div class="container" >
        <div class="row" >
            <div class="col-ex-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <div class="row" >
                    <div class="col-lg-3 col-md-3 col-sm-3" >
                        <div class="col-footer" >
                            <h2 class="title-footer" >{{ trans('front.menu_footer.lb_allelua_information') }}</h2>
                            <ul class="nav-footer" >
                                <li>
                                    <a href="/page/{{ $staticPage['type_1']['slug'] }}" title="" >
                                        {{ $staticPage['type_1']['title'] }}
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/{{ $staticPage['type_2']['slug'] }}" title="" >
                                        {{ $staticPage['type_2']['title'] }}
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/{{ $staticPage['type_3']['slug'] }}" title="" >
                                         {{ $staticPage['type_3']['title'] }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3" >
                        <div class="col-footer" >
                            <h2 class="title-footer" >{{ trans('front.menu_footer.lb_customer_support') }}</h2>
                            <ul class="nav-footer" >
                                <li>
                                    <a href="/page/{{ $staticPage['type_4']['slug'] }}" title="" >
                                        {{ $staticPage['type_4']['title'] }}
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/{{ $staticPage['type_5']['slug'] }}" title="" >
                                        {{ $staticPage['type_5']['title'] }}
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/{{ $staticPage['type_6']['slug'] }}" title="" >
                                        {{ $staticPage['type_6']['title'] }}
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/{{ $staticPage['type_7']['slug'] }}" title="" >
                                        {{ $staticPage['type_7']['title'] }}
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/{{ $staticPage['type_8']['slug'] }}" title="" >
                                        {{ $staticPage['type_8']['title'] }}
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/{{ $staticPage['type_9']['slug'] }}" title="" >
                                        {{ $staticPage['type_9']['title'] }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3" >
                        <div class="col-footer" >
                            <h2 class="title-footer" >
                                {{ trans('front.menu_footer.lb_your_account') }}
                            </h2>
                            <ul class="nav-footer" >
                                <li>
                                    <a title="" href="{{ route('seller_login') }}">
                                        {{ trans('front.menu_seller.lb_sign_in') }}
                                    </a>
                                </li>
                                <li>
                                    <a title="" href="{{ route('seller_register') }}">
                                        {{ trans('front.menu_seller.lb_sign_up') }}
                                    </a>
                                </li>
                                <li>
                                    <a title="" href="{{ route('contact') }}">
                                        Gửi yêu cầu tìm kiếm
                                    </a>
                                </li>
                            </ul>
                            <h2 class="title-footer" >
                                {{ trans('front.menu_footer.lb_connect_with_allelua') }}
                            </h2>
                            <div class="nav-socal" >
                                <a href="" class="link-socal facebook" >
                                    <i class="fa fa-facebook" ></i>
                                </a>
                                <a href="" class="link-socal google" >
                                    <i class="fa fa-google" ></i>
                                </a>
                                <a href="" class="link-socal google" >
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3" >
                        <div class="col-footer" >
                            <h2 class="title-footer" >
                                {{ trans('front.menu_footer.lb_payment_method') }}
                            </h2>
                            <div class="img-payment" >

                            </div>

                            <div class="news-letter clearfix" >
                                <p class="note-news-letter" >
                                    {{ trans('front.menu_footer.lb_subscribe_text') }}
                                </p>
                                <div class="wrap-news-letter" >
                                    <form action="" class="clearfix form-news-letter" >
                                        <input type="text" name="email" class="input-news-letter" >
                                        <button class="btn-snews-letter" >
                                            {{ trans('front.menu_footer.lb_subscribe') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</footer>