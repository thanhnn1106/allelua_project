console.log('v1.0');
coz = {};
coz.banner = {
    width : 428
}
scrollbarHome = $('[data-place="scrollbarHome"]');
/*
updateScrollBarHome = function(){
    try{
        h = $('.megamenu').height();
        h = Math.max(h, 50);
        var cw = $('[data-place="groupBannerHome"] .item-banner').eq(0).width();
        rw = Math.min(cw, 428)/428;
        _style = '.aside-heading{padding: '+(15*rw)+'px}';
        _style += '.aside-heading .title-aside{font-size: '+(100*rw)+'%}';
        _style += '.nav-mmega > li >a{font-size: '+(100*rw)+'%}';
        _style += '.navbar-pills >li> a{padding: '+(10*rw)+'px '+(15*rw)+'px}';
        _style += '.navbar-pills >li> a>img{width: '+(16*rw)+'px;margin-right: '+(10*rw)+'px}';
        _style += '.navbar-pills >li> a{padding: '+(10*rw)+'px '+(15*rw)+'px;border-left: '+(4*rw)+'px solid #FFF;font-size: '+(100*rw)+'%}';
        $('#cssScrollBarMega').html('<style>.inner-megamenu{min-height:'+h+'px}'+_style+'</style>');
    }catch(e){}
};
*/
updateScrollBarHome = function(){
    try{
        h = $('.megamenu').height();
        h = Math.max(h, 50);
        var cw = $('[data-place="groupBannerHome"] .item-banner').eq(0).width();
        rw = Math.min(cw, 428)/428;
        _style = '.aside-heading{padding: '+(15*rw)+'px}';
        //_style += '.aside-heading .title-aside{font-size: '+(100*rw)+'%}';
       // _style += '.nav-mmega > li >a{font-size: '+(100*rw)+'%}';
        _style += '.navbar-pills >li> a{padding: '+(10*rw)+'px '+(15*rw)+'px}';
        _style += '.navbar-pills >li> a>img{width: '+(16*rw)+'px;margin-right: '+(10*rw)+'px}';
        _style += '.navbar-pills >li> a{padding: '+(9*rw-2)+'px '+(15*rw)+'px;border-left: '+(4*rw)+'px solid #FFF}';
        $('#cssScrollBarMega').html('<style>.inner-megamenu{min-height:'+h+'px}'+_style+'</style>');
    }catch(e){}
};
alignHeight = function(){
    $('[data-align-height="wrap"]').each(function(i ,el){
        if( $('[data-align-height="left"]', el).length >0
            && $('[data-align-height="right"]', el).length >0 ){
            if( $(window).width() >= 768 ){
                hl = $('[data-align-height="left"]', el).height();
                hr = $('[data-align-height="right"]', el).height();
                bt = $('[data-align-height="right"]', el).data('bottom');
                if( typeof bt == 'undefined' || parseInt(bt) <= 0 ){
                    bt = 0;
                }
                console.log(bt);
                ha = Math.max(hl, hr);
                $('[data-align-height="left"]', el).css({'min-height': (hr-bt)+'px'});
            }else{
                $('[data-align-height="left"]', el).css({'min-height': '0px'});
            }
        }
    });
};
$( document ).ready(function() {
    if( $('[data-neo="owlCarousel"]').length > 0 ){
        $('[data-neo="owlCarousel"]').each(function(index, el) {
            if( typeof $(el).data('owlCarousel') == 'undefined' ){
                var config = $(el).data();
                var navText = [];
                if( typeof config.navtextleft != 'undefined' ){
                    navText.push(config.navtextleft);
                }
                if( typeof config.navtextright != 'undefined' ){
                    navText.push(config.navtextright);
                }
                if( navText.length >0 ){
                    config.navText = navText;
                }
                config.callbacks = true;
                config.onInitialized = function( e ){};
                $(el).owlCarousel(config).addClass('pjax-init').on('resized.owl.carousel', function(event) {
                }).on('refreshed.owl.carousel', function(event) {
                }).on('changed.owl.carousel', function(event) {
                });
            }
        });
    }

    $('.categories-home .navbar-pills li').hover(function(){
        if( $(this).find('>.dropdown-menu').length >0 ){
            $('.categories-home .scroll-element.scroll-y').hide();
        }
    }, function(){
        $('.categories-home .scroll-element.scroll-y').attr('style', '');
    });

    try{
        if( $('[data-neo="ionRangeSlider"]').not('.pjax-init').length>0 ){
            var $ionRangeSlider = $('[data-neo="ionRangeSlider"]').not('.pjax-init');
            $ionRangeSlider.addClass('pjax-init').ionRangeSlider({
                type: "double",
                min: 1000000,
                max: 2000000,
                grid: true,
                onStart: function (data) {},
                onChange: function (data) {
                    $('[data-place="valueRangerFrom"]').html(data.from);
                    $('[data-place="valueRangerTo"]').html(data.to);
                },
                onFinish: function (data) {
                    alert('Fillter nha');
                    var form_ = $ionRangeSlider.parents('form').eq(0);
                    form_.submit();
                },
                onUpdate: function (data) {}
            });
        }
    }catch(e){console.log(e);};

    $(document).on('click', '.fillter-toogle', function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).parents('.fillter-item').eq(0).toggleClass('closed');
    });

    $(document).on('click', '.coz-item-check', function(e){
        e.preventDefault();
        e.stopPropagation();
        if( $(this).find('input[type="checkbox"]').eq(0).is(':checked') ){
            $(this).removeClass('checked').find('input[type="checkbox"]').eq(0).attr('checked', false);
        }else{
            $(this).addClass('checked').find('input[type="checkbox"]').eq(0).attr('checked', true);
        }
    });

    /*menu mobile*/
    $(document).on('click', '.btn-togle-mm', function(e){
        e.preventDefault();
        e.stopPropagation();
        if( $('body').hasClass('coz-mm-open') ){
            $('.coz-mobie-menu').stop(true, true).animate({left : '-70%'}, 300, function(){
                $('body').removeClass('coz-mm-open');
                $(this).hide();
            });
        }else{
            $('.coz-mobie-menu').stop(true, true).show().animate({left : 0}, 300, function(){
                $('body').addClass('coz-mm-open');
            });
        }
    });
    $(document).on('click', '.mask-mobie-menu, .close-mobie-menu', function(e){
        e.preventDefault();
        e.stopPropagation();
        $('.coz-mobie-menu').stop(true, true).animate({left : '-70%'}, 300, function(){
            $('body').removeClass('coz-mm-open');
            $(this).hide();
        });
    });
    $(document).on('click', '.nav-item-mmobile .mm-right-ic', function(e){
        e.preventDefault();
        e.stopPropagation();
        p = $(this).parents('li').eq(0);
        if( p.hasClass('has-sub') ){
            p.toggleClass('open');
        }
    });
    $(document).on('click', '.nav-mm .btn-search', function(e){
        if( !$('.nav-mm').hasClass('open-search') ){
            e.preventDefault();
            e.stopPropagation();
            $('.nav-mm').addClass('open-search').find('.form-search').eq(0).width(40).stop(true, true).animate({width: '100%'}, 500, function(){
                $('.nav-mm .form-search').attr('style', '');
                $('.nav-mm.open-search  .input-search').focus();
            });
            $('.nav-mm .input-search').fadeIn(500, function(){
                $(this).attr('style', '');
            });
        }else{
            if( $.trim($('.nav-mm.open-search  .input-search').val()).length <=0 ){
                e.preventDefault();
                e.stopPropagation();
                alert('BÃ¡ÂºÂ¡n chÃ†Â°a nhÃ¡ÂºÂ­p keyword ?');
                $('.nav-mm.open-search  .input-search').focus();
            }
        }
    });
    $(document).on('click', function(e){
        if( $(e.target).closest('.nav-mm.open-search .form-search').length <=0 ){
            $('.nav-mm .form-search').eq(0).stop(true, true).animate({width: '0px'}, 500, function(){
                $('.nav-mm').removeClass('open-search');
                $('.nav-mm .form-search').attr('style', '');
            });
            $('.nav-mm .input-search').fadeOut(500, function(){
                $(this).attr('style', '');
            });
        }
    });
    /*end menu mobile*/

    /*detail*/
    // Active image thumb and change image featured ( product detail )
    jQuery(document).on("click", ".product-thumb img", function() {
        smallImage = jQuery(this).attr("data-image");
        largeImage = jQuery(this).attr("data-zoom-image");
        jQuery('.product-thumb').removeClass('active');
        jQuery(this).parents('.product-thumb').addClass('active');
        jQuery(".product-image-feature").attr("src",smallImage);
        jQuery(".product-image-feature").attr("data-zoom-image",largeImage);
        var ez =   $('.product-image-feature').data('elevateZoom');
        ez.swaptheimage(smallImage, largeImage); 
    });

    // Active image thumb and change image featured ( product detail )
    jQuery(document).on("click", "a.search-toggle", function() {
        if( !jQuery(this).hasClass('active') ){
            jQuery(this).addClass('active');
            jQuery('.wrap-search-box').addClass('show');
        }else{
            jQuery(this).removeClass('active');
            jQuery('.wrap-search-box').removeClass('show');
        }
    });

    $(document).on("click", ".btn-more-product-description", function(e) {
        e.preventDefault();
        $(this).hide();
        $('.mini-product-description').hide();
        $('.full-product-description').show();
        $('.btn-mini-product-description').show();
    });

    $(document).on("click", ".btn-mini-product-description", function(e) {
        e.preventDefault();
        $(this).hide();
        $('.mini-product-description').show();
        $('.full-product-description').hide();
        $('.btn-more-product-description').show();
    });

    if( $(".product-image-feature").length > 0 ) {
        if( $(window).width() >= 1200 ){
            jQuery(".product-image-feature").elevateZoom({
                gallery:'sliderproduct',
                scrollZoom : true
            });
        }else{
            jQuery(".product-image-feature").elevateZoom({
                gallery:'sliderproduct',
                zoomEnabled : false
            });
        }
    }
    if( $('#sly_thumb').length >0 ){
        $('#sly_thumb').sly({
            itemNav: 'basic',
            smart: 1,
            activateOn: 'click',
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            startAt: 0,
            scrollBy: 1,
            activatePageOn: 'click',
            speed: 300,
            elasticBounds: 1,
            dragHandle: 1,
            dynamicHandle: 1,
            clickBar: 1,
            prev: $('.btn-up-sly'),
            next: $('.btn-down-sly')
        }, {
            load: function () {},
            move: [
                function () {},
                function () {}
            ]
        });
    }
    /*detail*/

    $('.input-select2').select2({ width: '100%' }).on("change", function(e) {
        var val = $(this).val();
    });

    $(document).on('click', '[data-btn="closeBoxError"]', function(e){
        $(this).parents('.box-error').eq(0).hide();
    });

    $(document).on('click', '[data-input="imgRadio"]', function(e){
        in_ = $(this).find('input').eq(0);
        if( !in_.is(':checked') ){
            nin_ = in_.attr('name');
            $('[data-input="imgRadio"] input[name="'+nin_+'"]:checked').each(function(i, el){
                $(el).attr('checked', false).parents('[data-input="imgRadio"]').eq(0).removeClass('checked');
            });
            $(this).addClass('checked').find('input').eq(0).attr('checked', true);
        }
    });

    $(document).on('submit', '[data-form="editProfile"]', function(e){
        flag = true;
        
        $('input[name="first_name"]', '[data-form="editProfile"]').removeClass('has-eror');
        $('.input-error[data-input="first_name"]', '[data-form="editProfile"]').remove();
        if( $.trim($('input[name="first_name"]', '[data-form="editProfile"]').val()).length <=0 ){
            $('.box-error').show();
            $('input[name="first_name"]', '[data-form="editProfile"]').addClass('has-eror')
                .after('<div class="input-error" data-input="first_name" >Frist name khÃ´ng Ä‘Æ°á»£c bá» trá»‘ng</div>');
            flag = false;
        }

        $('input[name="last_name"]', '[data-form="editProfile"]').removeClass('has-eror');
        $('.input-error[data-input="last_name"]', '[data-form="editProfile"]').remove();
        if( $.trim($('input[name="last_name"]', '[data-form="editProfile"]').val()).length <=0 ){
            $('.box-error').show();
            $('input[name="last_name"]', '[data-form="editProfile"]').addClass('has-eror')
                .after('<div class="input-error" data-input="last_name" >Last name khÃ´ng Ä‘Æ°á»£c bá» trá»‘ng</div>');
            flag = false;
        }

        $('input[name="phone"]', '[data-form="editProfile"]').removeClass('has-eror');
        $('.input-error[data-input="phone"]', '[data-form="editProfile"]').remove();
        if( $.trim($('input[name="phone"]', '[data-form="editProfile"]').val()).length <=0 ){
            $('.box-error').show();
            $('input[name="phone"]', '[data-form="editProfile"]').addClass('has-eror')
                .after('<div class="input-error" data-input="phone" >Phone khÃ´ng Ä‘Æ°á»£c bá» trá»‘ng</div>');
            flag = false;
        }

        if( flag ){
            $('.box-error').hide();
        }else{
            $('.box-error').show();
        }

        return flag;
    });

    $(document).on('click', '[data-btn="moreMenu"]', function(e){
        if( $('.categories-home').hasClass('full') ){
            $('.categories-home').removeClass('full');
            $(this).html($(this).attr('data-expand'));
        }else{
            $('.categories-home').addClass('full');
            $(this).html($(this).attr('data-collapse'));
        }
    });

    updateScrollBarHome();
    $('[data-place="scrollbarMenuMobile"]').scrollbar();
    $('.inner-megamenu').scrollbar();
    alignHeight();
});
$( window ).resize( function(){
    updateScrollBarHome();
    alignHeight();
});
window.onload = function(){
    alignHeight();
};
$( window ).scroll( function(){
    if( $('[data-place="detectLoadMore"]').length >0 
        && !$('[data-place="detectLoadMore"]').hasClass('active') ){
        var nt = $('[data-place="detectLoadMore"]').eq(0).offset().top;
        if( nt <= (parseInt($(window).scrollTop()) + parseInt($(window).height())) ){
            $('[data-place="detectLoadMore"]').addClass('active');
            var url = $('[data-place="detectLoadMore"]').attr('data-url');
            var start = $('#productList').attr('data-start');
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: url + '&page='+start,
                data: {},
                success: function (data) {
                    $('[data-place="detectLoadMore"]').removeClass('active');
                    if(data.error == 0) {
                        isFinalProduct = data.isFinalProduct;
                        if( isFinalProduct == true || isFinalProduct == 'true' ) {
                            $('[data-place="detectLoadMore"]').eq(0).remove();
                        }
                        $('#productList').attr('data-start', data.start);
                        var rsel = $('<div class="tml-el" >'+data.result.toString()+'</div>');
                        var rselHtml = rsel.html();
                        if( rsel.find('.row').length > 0 ){
                            rselHtml = rsel.find('.row').eq(0).html();
                        }
                        $('#productList>.row').eq(0).append(rselHtml);
                    }else{
                        $('[data-place="detectLoadMore"]').eq(0).remove();
                    }
                },
                error: function(e){
                    console.log(e);
                    $('[data-place="detectLoadMore"]').removeClass('active');
                }
            });
        }
    }
});

(function($, viewport){
    $(document).ready(function() {
        if(viewport.is('xs')) {
        }

        if(viewport.is('>=sm')) {
        }

        if(viewport.is('<md')) {
        }

        $(window).resize(
            viewport.changed(function() {
                if(viewport.is('<md')) {
                    try{
                        var ezApi = $('.product-image-feature').data('elevateZoom');
                        ezApi.changeState('enable');
                        $('.zoomContainer').show();
                        $('#sly_thumb').sly('reload');
                    }catch(e){}
                }else{
                    try{
                        var ezApi = $('.product-image-feature').data('elevateZoom');
                        ezApi.changeState('disable');
                        $('.zoomContainer').hide();
                    }catch(e){}
                }
            })
        );
    });
})(jQuery, ResponsiveBootstrapToolkit);