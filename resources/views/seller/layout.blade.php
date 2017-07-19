<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js ie6 oldie" lang="en"><![endif]-->
<!--[if IE 7]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <title>alletula</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0" name="viewport">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,700italic,400italic,300italic,300&subset=vietnamese&coz=20170520090756">
        <link href="{{ asset_front('js/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css">
        <link href="{{ asset_front('js/font-awesome/4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/owl-carousel/owl.theme.min.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/ion.rangeSlider/2.1.4/css/ion.rangeSlider.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/ion.rangeSlider/2.1.4/css/ion.rangeSlider.skinModern.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/jquery.scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/select2/dist/css/select2.css') }}" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="{{ asset_front('css/style.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset_front('css/style_custom.css') }}" >
    </head>
    <body>

        <div class="page clearfix {{ $cssClass or null }}">
            <!--BEGIN HEADER-->
            <header class="header" id="header" >
                @include('front.header')
            </header>
            <!--END HEADER-->

            <!--BEGIN CONTENT-->
            <div class="page-main clearfix">
                <div class="container">
                    <div class="inner-page-main" data-align-height="wrap" >
                        <div class="row" >
                            <div class="clearfix save-marle col-ex-10 col-lg-9 col-md-8 col-sm-12 col-xs-12 col-ex-push-2 col-lg-push-3 col-md-push-4 col-sm-push-0" >
                                <div class="page-right clearfix" >
                                    @yield('content')
                                </div>
                            </div>
                            <div class="sizebar-left col-ex-2 col-lg-3 col-md-4 col-sm-12 col-xs-12 col-ex-pull-10 col-lg-pull-9 col-md-pull-8 col-sm-pull-0" data-align-height="right" data-bottom="20" >
                                <div class="inner-sizebar clearfix" >
                                    <aside class="box-aside" >
                                        <div class="clearfix">
                                            <div class="allelua-card hovercard" >
                                                <div class="allelua-cardheader"></div>
                                                <div class="allelua-card-avatar">
                                                    <img alt="adm team" src="dataimages/no-photo-100x100.png">
                                                </div>
                                                <div class="allelua-card-info">
                                                    <div class="allelua-card-title">
                                                        <a href="/profile">
                                                            admin team                            
                                                        </a>
                                                    </div>
                                                    <div class="allelua-card-desc">
                                                        updating                        
                                                    </div>
                                                    <div class="allelua-card-desc">test@yahoo.com.vn</div>
                                                    <div class="allelua-card-desc">
                                                        0 Điểm                        
                                                    </div>
                                                </div>
                                                <div class="allelua-card-bottom">
                                                    <a class="btn allelua-card-btn btn-primary btn-twitter btn-sm" href="">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                    <a class="btn allelua-card-btn btn-danger btn-sm" rel="publisher" href="">
                                                        <i class="fa fa-google-plus"></i>
                                                    </a>
                                                    <a class="btn allelua-card-btn btn-primary btn-sm" rel="publisher" href="">
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
                                                            <a href="{{ route('seller_notification') }}" class="nav-link" >
                                                                <span>
                                                                    <i class="fa fa-bell-o" aria-hidden="true"></i> 
                                                                    {{ trans('front.menu_seller.lb_notification') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item" >
                                                            <a href="{{ route('seller_account_management') }}" class="nav-link" >
                                                                <span>
                                                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                                                    {{ trans('front.menu_seller.lb_account_management') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item" >
                                                            <a href="{{ route('seller_new_post') }}" title="Áo Thun" class="nav-link" >
                                                                <span>
                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                    {{ trans('front.menu_seller.lb_new_post') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item" >
                                                            <a href="{{ route('seller_product_list') }}" class="nav-link" >
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

                                </div>
                            </div>

                        </div>
                    </div><!-- end inner-page-main -->

                </div>
            </div>
            <!--END CONTENT-->

            <!--BEGIN FOOTER-->
            <footer class="footer">
                @include('front.footer')
            </footer>
            <!--END FOOTER-->
        </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset_front('js/tether/dist/js/tether.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/responsive-bootstrap-toolkit/src/bootstrap-toolkit.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/html5shiv/html5shiv.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/jquery-migrate/jquery-migrate-1.2.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/owl-carousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/jquery.scrollbar/jquery.scrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/ion.rangeSlider/2.1.4/js/ion.rangeSlider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/sly/dist/sly.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/elevatezoom/3.0.8/jquery.elevateZoom-3.0.8.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/script.js') }}"></script>

    <!--Embed from Zopim Live Chat Wordpress Plugin v1.4.3-->
    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
    $.src='http://v2.zopim.com/?3VhEhbO2nxa9L1z9byqjeegpUZaCo5xL';z.t=+new Date;$.
    type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
    </script><script>$zopim( function() {
    })</script><!--End of Zopim Live Chat Script-->
    </body>
</html>