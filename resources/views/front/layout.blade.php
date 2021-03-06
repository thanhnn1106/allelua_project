<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js ie6 oldie" lang="en"><![endif]-->
<!--[if IE 7]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <title>{{ $generalDataArr['title'] }}</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0" name="viewport">
        <meta name="csrf-token" content="{!! csrf_token() !!}" />
        <meta name="keywords" content="{{ $generalDataArr['seo_keyword'] }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,700italic,400italic,300italic,300&subset=vietnamese&coz=20170520090756">
        <link href="{{ asset_front('js/bootstrap/4.0.0-alpha.2/css/bootstrap.css') }}" media="all" rel="stylesheet" type="text/css">
        <link href="{{ asset_front('js/font-awesome/4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/owl-carousel/owl.theme.min.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/ion.rangeSlider/2.1.4/css/ion.rangeSlider.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/ion.rangeSlider/2.1.4/css/ion.rangeSlider.skinModern.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/jquery.scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" >
        <link href="{{ asset_front('js/select2/dist/css/select2.css') }}" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="{{ asset_front('css/style.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset_front('css/style_custom.css') }}" >
        <link rel="shortcut icon" type="image/png" href="{{ asset_front('dataimages/favicon.png') }}"/>

        <meta property="og:title" content="@yield('og-title', $generalDataArr['title'])" />
        <meta name="description" content="@yield('meta-description', $generalDataArr['description'])" />
        <meta property="og:image" content="@yield('meta-image', asset_front('images/logo.png'))">
<!--         Start of allelua Zendesk Widget script 
        <script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="allelua.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
/*]]>*/</script>
         End of allelua Zendesk Widget script -->
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
                @yield('content')
            </div>
            <!--END CONTENT-->

            <!--BEGIN FOOTER-->
            <footer class="footer">
                @include('front.footer')
            </footer>
            <!--END FOOTER-->
        </div>
        
        @include('front.menu_sp')

        <div class="modal-loading"></div>

        <div id="dialog-search-form" title="Search image">
            <form id="front-search-image" class="fsearch clearfix" action="{{ route('search_page') }}" enctype="multipart/form-data" method="POST">
              <fieldset>
                <label for="name">File</label>
                <input type="file" name="search_image" id="search_image" value="Jane Smith" class="text ui-widget-content ui-corner-all">

                <br/><br/>
                <button type="submit" class="btn btn-style btn-heart" title="Search" >
                    <span>Search</span>
                </button>
                {{ csrf_field() }}
              </fieldset>
            </form>
        </div>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <link rel="stylesheet" href="{{ asset('plugins/jQueryUI/jquery-ui.min.css') }}">

    <script type="text/javascript" src="{{ asset_front('js/tether/dist/js/tether.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/responsive-bootstrap-toolkit/src/bootstrap-toolkit.js') }}"></script>
    <script src="{{ asset_admin('js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset_front('js/html5shiv/html5shiv.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/jquery-migrate/jquery-migrate-1.4.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/owl-carousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/jquery.scrollbar/jquery.scrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/ion.rangeSlider/2.1.4/js/ion.rangeSlider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/sly/dist/sly.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/elevatezoom/3.0.8/jquery.elevateZoom-3.0.8.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_front('js/script.js') }}"></script>
    <script type="text/javascript">function add_chatinline(){var hccid=67706874;var nt=document.createElement("script");nt.async=true;nt.src="https://mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
add_chatinline(); </script>
    <script>
    // Add token when use ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#search-button').click(function () {
        if($.trim($('#keyword').val()) === '') {
            return false;
        }
    });
    var dialogSearch;
    function fncSearchImage()
    {
        dialogSearch = $( "#dialog-search-form" ).dialog({
            autoOpen: false,
            width: 350,
            modal: true
        });
        dialogSearch.dialog( "open" );
    }
    </script>

    @yield('footer_script')
    </body>
</html>