jQuery(document).ready(function($) {
    
    //sticky t bar toggle
    $(".sticky-t-bar .close").on( 'click', function() {
        $(".sticky-bar-content").slideToggle();
        $(".sticky-t-bar").toggleClass("active");
    });

    //header search toggle js
    $(".header-search-wrap").fadeOut();
    $(".header-search .search-toggle").on( 'click', function(e) {
        $("body").addClass("search-active");
        $(this).siblings(".header-search-wrap").fadeIn("slow");
    });

    $(".header-search .search-form").on( 'click', function(e) {
        e.stopPropagation();
    });

    $(".header-search-wrap").on( 'click', function() {
        $("body").removeClass("search-active");
        $(this).fadeOut("slow");
    });

    $(window).on('resize load', function() {

        var adminBarHeight = $('#wpadminbar').outerHeight();

        $('.widget-sticky .widget-area .widget:last-child, .single-post .site-main article.sticky-meta .article-meta-inner').css('top', adminBarHeight + 30);

    });

    $('.nav-menu .menu-item-has-children').find('> a').after('<button class="submenu-toggle"><i class="fas fa-chevron-down"></i></button>');
    $('.menu-item-has-children .submenu-toggle').on( 'click', function() {
        $(this).parent('.menu-item-has-children').toggleClass('active');
        $(this).siblings('ul').slideToggle();
    });

    $('body, html').on( 'click', function(e) {
        $('.secondary-menu').removeClass('menu-toggled');
        $('body').removeClass('menu-active');
    });

    //mobile menu toggle
    $('.mobile-header .menu-toggle').on( 'click', function() {
        $('.mobile-header .mobile-menu').fadeIn();
    });

    $('.mobile-header .mbl-menu-wrap .close').on( 'click', function () {
        $('.mobile-header .mobile-menu').fadeOut();
    });

    $(window).on( 'keyup', function(e) {
        if(e.key == 'Escape') {
            $('.mobile-header .mobile-menu').fadeOut();
        }
    });
    
    //mobile menu top space
    $(window).on('resize load scroll', function() {
        var adminBarHeight = $('#wpadminbar').outerHeight();
        var stickyBarHeight = $('.sticky-t-bar').outerHeight();
        var mblHeaderHeight = $('.mobile-header').outerHeight();
        var mblAddedHeight1 = parseInt(mblHeaderHeight) + parseInt(stickyBarHeight) + parseInt(adminBarHeight);
        var mblAddedHeight2 = parseInt(mblHeaderHeight) + parseInt(stickyBarHeight);
        var mblAddedHeight3 = parseInt(mblHeaderHeight) + parseInt(adminBarHeight);

        if($('.admin-bar').length == '1' && $('.sticky-t-bar').length == '1'){
            $('.mobile-header .mobile-menu').css('top', mblAddedHeight1);
            $('.sticky-t-bar .close').on( 'click', function() {
                
                if($('.sticky-t-bar').hasClass('active')) {
                    $('.mobile-header .mobile-menu').css('top', mblAddedHeight1);
                } else {
                    $('.mobile-header .mobile-menu').css('top', mblAddedHeight1 - stickyBarHeight);
                }

            });
        } else if($('.admin-bar').length != '1' && $('.sticky-t-bar').length == '1') {
            $('.mobile-header .mobile-menu').css('top', mblAddedHeight2);

            $('.sticky-t-bar .close').on( 'click', function () {

                if ($('.sticky-t-bar').hasClass('active')) {
                    $('.mobile-header .mobile-menu').css('top', mblAddedHeight2);
                } else {
                    $('.mobile-header .mobile-menu').css('top', mblHeaderHeight);
                }

            });

        } else if ($('.admin-bar').length == '1' && $('.sticky-t-bar').length != '1') {
            $('.mobile-header .mobile-menu').css('top', mblAddedHeight3);

        } else {
            $('.mobile-header .mobile-menu').css('top', mblHeaderHeight);
        }
    });

    //add class when back to top is enable
    if ($('.back-to-top').length == '1' ) {
        $('.footer-b').addClass('has-backtotop');
    } else {
        $('.footer-b').removeClass('has-backtotop');
    }

    //back to top js
    $(window).on( 'scroll', function() {
        if ($(this).scrollTop() > 200) {
            $(".back-to-top").addClass("active");
        } else {
            $(".back-to-top").removeClass("active");
        }
    });

    $(".back-to-top").on( 'click', function() {
        $("body, html").animate(
        {
            scrollTop: 0
        },
        700
        );
    });

    //cta section
    $(window).on('resize load', function() {
        var ctaContentHeight = $('section.cta-section.style-one .widget .blossomtheme-cta-container').outerHeight() + 100;
        if($(this).width() <= 767) {
            $('section.cta-section.style-one .widget > div').css('margin-bottom', ctaContentHeight - 40);
        } else if($(this).width() < 1025) {
            $('section.cta-section.style-one .widget > div').css('margin-bottom', ctaContentHeight);
        } else {
            $('section.cta-section.style-one .widget > div').css('margin-bottom', '0');
        }
    });

    //for accessibility
    $(window).on("keyup", function(event) {
      if (event.key == "Escape") {
        $("body").removeClass("search-active");
        $(".header-search-wrap").fadeOut("slow");
        $(".secondary-menu").removeClass("menu-toggled");
        $("body").removeClass("menu-active");
        $('.post-thumbnail .social-networks').slideUp();
        $('.faq-content').slideUp();
        $('.faq-block').removeClass('active');
        $('.mobile-header').removeClass('menu-active');
        $('body').css('overflow', 'visible');
      }
    });

    $('.main-navigation ul li a, .secondary-menu ul li a, .main-navigation ul li button, .secondary-menu ul li button').on( 'focus', function() {
        $(this).parents('li').addClass('hover');
    }).on( 'blur', function() {
        $(this).parents('li').removeClass('hover');
    });

    //Guttenberg alignfull js
    $(window).on('load resize', function() {
        var gbWindowWidth = $(window).width();
        var gbContainerWidth = $('.blp-has-blocks .site-content > .container').width();
        var gbContentWidth = $('.blp-has-blocks .site-main .entry-content').width();
        var gbMarginFull = (parseInt(gbContainerWidth) - parseInt(gbWindowWidth)) / 2;
        var articleMetaWidth = $('.single .site-main .article-meta').width() + 30;
        var articleMetaWidthCenter = $('.single .site-main .article-meta').width() - 25;
        var gbTMarginFull = parseInt(gbMarginFull) - parseInt(articleMetaWidth);
        var gbMarginCenter = (parseInt(gbContentWidth) - parseInt(gbWindowWidth)) / 2;
        var gbTMarginCenter = parseInt(gbMarginCenter) - parseInt(articleMetaWidthCenter);

        $(".blp-has-blocks.full-width .site-main .entry-content .alignfull").css({"max-width": gbWindowWidth, "width": gbWindowWidth, "margin-left": gbMarginFull});

        $(".blp-has-blocks.full-width-centered .site-main .entry-content .alignfull").css({"max-width": gbWindowWidth, "width": gbWindowWidth, "margin-left": gbMarginCenter});

        if($(window).width() > 767) {
            $(".single-post.blp-has-blocks.full-width .site-main .entry-content .alignfull").css({ "max-width": gbWindowWidth, "width": gbWindowWidth, "margin-left": gbTMarginFull });
        } else {
            $(".blp-has-blocks.full-width .site-main .entry-content .alignfull").css({ "max-width": gbWindowWidth, "width": gbWindowWidth, "margin-left": gbMarginFull });
        }

        if ($(window).width() > 767 && $(window).width() < 1025) {
            $(".blp-has-blocks.full-width-centered .site-main .entry-content .alignfull").css({ "max-width": gbWindowWidth, "width": gbWindowWidth, "margin-left": gbTMarginCenter });
        } else {
            $(".blp-has-blocks.full-width-centered .site-main .entry-content .alignfull").css({ "max-width": gbWindowWidth, "width": gbWindowWidth, "margin-left": gbMarginCenter });
        }
    });

    var slider_auto, slider_loop, rtl;
    
    if( vandana_lite_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( vandana_lite_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }

    if (vandana_lite_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }


    //Slider one section
    if ($(".site-banner").hasClass("slider-one")) {
        $('.item-wrapper').owlCarousel({
            items: 1,
            nav: true,
            dots: false,
            autoplaySpeed: vandana_lite_data.speed,
            autoplay: slider_auto,
            autoplayTimeout: 5000, //time between 2 autoplay slides change
            loop: slider_loop,
            rtl: rtl,
            navText: ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z"></path></svg>', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M24.707 38.101L4.908 57.899c-4.686 4.686-4.686 12.284 0 16.971L185.607 256 4.908 437.13c-4.686 4.686-4.686 12.284 0 16.971L24.707 473.9c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L41.678 38.101c-4.687-4.687-12.285-4.687-16.971 0z"></path></svg>'],
            responsive : {
                0 : {
                    nav: false,
                    dots: true,
                }, 
                768 : {
                    nav: true,
                    dots: false,
                }
            }
        });  
    }

    //Testimonial section
    if($(".testimonial-section").hasClass("style-one")) {
        $('.testimonial-section .testimonial-wrap').owlCarousel({
            items: 1,
            nav: false,
            dots: true,
            autoplaySpeed: 700,
            autoplay: false,
            rtl: rtl,
        });
    }

    //promotional section
    $('.promo-section .bttk-itw-holder li').wrapInner('<div class="itw-inner-wrap"></div>');

});//close document