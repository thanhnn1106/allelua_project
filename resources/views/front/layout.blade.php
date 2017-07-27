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
                    @yield('content')
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
    @yield('footer_script')
    </body>
</html>