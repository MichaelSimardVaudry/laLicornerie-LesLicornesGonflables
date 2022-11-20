jQuery( document ).ready(function( $ ) {

	/* Mouse Enter Event*/
	$( ".wp-spaios-slider-image" ).mouseenter(function() {  
	var title = $(this).attr("title");
		$(this).attr("temp_title", title);
		$(this).attr("title","");
	});

	/* Mouse Leave Event*/
	$( ".wp-spaios-slider-image" ).mouseleave(function() {
		var title = $(this).attr("temp_title");
		$(this).attr("title", title);
		$(this).removeAttr("temp_title");
	});

	/* Bx Slider Initialize */
	$('.wp-spaios-bxslider').each(function( index ) {

		var slider_id	= $(this).attr('id');
		var slider_conf	= $.parseJSON( $(this).closest('.wp-spaios-slider-wrap').attr('data-conf'));

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

			jQuery('#'+slider_id).bxSlider({
				mode			: slider_conf.mode_bx,
				minSlides		: slider_conf.slide_to_show_bx,
				maxSlides		: slider_conf.max_slide_to_show_bx,
				moveSlides		: slider_conf.slide_to_scroll_bx,
				slideWidth		: slider_conf.slide_width_bx,
				pause			: parseInt( slider_conf.autoplay_speed ),
				speed			: parseInt( slider_conf.speed ),
				slideMargin		: parseInt( slider_conf.slide_margin_bx ),
				startSlide		: parseInt( slider_conf.start_slide_bx ),
				captions		: ( slider_conf.caption == 'true' )			? true : false,
				controls		: ( slider_conf.arrow == 'true' )			? true : false,
				pager			: ( slider_conf.pagination == 'true' )		? true : false,
				infiniteLoop	: ( slider_conf.loop == 'true' )			? true : false,
				auto			: ( slider_conf.autoplay == 'true' )		? true : false,
				adaptiveHeight	: ( slider_conf.height_start_bx == 'true' )	? true : false,
				randomStart		: ( slider_conf.random_start_bx == 'true' )	? true : false,
				ticker			: ( slider_conf.ticker_bx == 'true' )		? true : false,
				tickerHover		: ( slider_conf.ticker_hover_bx == 'true' )	? true : false,
				touchEnabled 	: false,
				onSliderLoad	: function() {
									$(this).css('visibility', 'visible');
								}
			});
		}
	});

	/* Flex Slider Initialize */
	$('.wp-spaios-flexslider').each(function( index ) {

		var slider_id	= $(this).attr('id');
		var slider_conf	= $.parseJSON( $(this).closest('.wp-spaios-slider-wrap').attr('data-conf'));

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

			jQuery('#'+slider_id).flexslider({
				selector		: '.slides > .flex-slide',
				animation		: slider_conf.animation_flex,
				minItems		: parseInt( slider_conf.slide_to_show_flex ),
				maxItems		: parseInt( slider_conf.max_slide_to_show_flex ),
				move			: parseInt( slider_conf.slide_to_scroll_flex ),
				itemWidth		: parseInt( slider_conf.slide_width_flex ),
				itemMargin		: parseInt( slider_conf.slide_margin_flex ),
				startAt			: parseInt( slider_conf.start_slide_flex ),
				slideshowSpeed	: parseInt( slider_conf.autoplay_speed ),
				animationSpeed	: parseInt( slider_conf.speed ),
				directionNav	: ( slider_conf.arrow == 'true' )				? true : false,
				controlNav		: ( slider_conf.pagination == 'true' )			? true : false,
				slideshow		: ( slider_conf.autoplay == 'true' )			? true : false,
				animationLoop	: ( slider_conf.loop == 'true' )				? true : false,
				smoothHeight	: ( slider_conf.height_auto_flex == 'true' )	? true : false,
				randomize		: ( slider_conf.random_start_flex == 'true' )	? true : false,
				pauseOnHover	: ( slider_conf.ticker_hover_flex == 'true' )	? true : false,
				start			: function(slider) {										
									slider.css('visibility', 'visible');
								}
			});
		}
	});

	/* OWL Carousel 2 Slider Initialize */
	$('.wp-spaios-owl-slider').each(function( index ) {

		var slider_id	= $(this).attr('id');
		var slider_conf	= $.parseJSON( $(this).closest('.wp-spaios-slider-wrap').attr('data-conf'));

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

			jQuery('#'+slider_id).owlCarousel({
				margin			: slider_conf.slide_margin_owl,
				stagePadding	: slider_conf.slide_padding_owl,
				autoplayTimeout	: parseInt( slider_conf.autoplay_speed ),
				autoplaySpeed	: parseInt( slider_conf.speed ),
				navSpeed		: parseInt( slider_conf.speed ),
				dotsSpeed		: parseInt( slider_conf.speed ),
				items			: parseInt( slider_conf.slide_to_show_owl ),
				slideBy			: parseInt( slider_conf.slide_to_scroll_owl ),
				startPosition	: parseInt( slider_conf.start_slide_owl ),
				nav				: ( slider_conf.arrow == 'true' )				? true : false,
				dots			: ( slider_conf.pagination == 'true' )			? true : false,
				autoplay		: ( slider_conf.autoplay == 'true' )			? true : false,
				loop			: ( slider_conf.loop == 'true' )				? true : false,
				center			: ( slider_conf.slide_center_owl == 'true' )	? true : false,
				autoWidth		: ( slider_conf.slide_autowidth_owl == 'true' )	? true : false,
				autoHeight		: ( slider_conf.height_auto_owl == 'true' )		? true : false,
				freeDrag		: ( slider_conf.slide_freeDrag_owl == 'true' )	? true : false,
				rtl				: ( slider_conf.slide_rtl_owl == 'true' )		? true : false,
				navText			: ['Prev', 'Next'],
				navElement		: 'div',
				responsive		: {
									0		: {
												items : parseInt( slider_conf.slide_show_mobile_owl ),
											},
									640		: {
												items : parseInt( slider_conf.slide_show_tablet_owl ),
											},
									768		: {
												items : parseInt( slider_conf.slide_show_ipad_owl ),
											},
									1024	: {
												items : parseInt( slider_conf.slide_to_show_owl ),
											},
								}
			});
		}
	});

	/* Nivo Slider Initialize */
	$('.wp-spaios-nivo-slider').each(function( index ) {

		var slider_id	= $(this).attr('id');
		var slider_conf	= $.parseJSON( $(this).closest('.wp-spaios-slider-wrap').attr('data-conf'));

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			jQuery('#'+slider_id).nivoSlider({
				captionOpacity	: 1,
				effect			: slider_conf.effect_nivo,
				startSlide		: parseInt( slider_conf.start_nivo ),
				pauseTime		: parseInt( slider_conf.autoplay_speed ),
				animSpeed		: parseInt( slider_conf.speed ),
				manualAdvance	: ( slider_conf.autoplay == 'true' )			? false	: true,
				directionNav	: ( slider_conf.arrow == 'true' )				? true	: false,
				controlNav		: ( slider_conf.pagination == 'true' )			? true	: false,
				randomStart		: ( slider_conf.random_start_nivo == 'true' )	? true	: false,
				pauseOnHover	: ( slider_conf.pauseon_over_nivo == 'true' )	? true	: false,

			});

			if( ! slider_conf.show_caption ) {
				$('#'+slider_id).find('.nivo-caption').remove();
			}
		}
	});

	/* Nivo Slider Initialize */
	$('.wp-spaios-3dslider').each(function( index ) {

		var slider_id	= $(this).attr('id');
		var slider_conf	= $.parseJSON( $(this).closest('.wp-spaios-slider-wrap').attr('data-conf'));

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			var swiper = new Swiper('#'+slider_id, {
				effect			: 'coverflow',
				speed			: parseInt( slider_conf.speed ),
				slidesPerView	: parseInt( slider_conf.slide_to_show_3d ),
				slidesPerGroup	: parseInt( slider_conf.slide_to_scroll_3d ),
				spaceBetween	: parseInt( slider_conf.space_between_3d ),
				centeredSlides	: ( slider_conf.centermode_3d == 'true' )	? true	: false,
				loop			: ( slider_conf.loop == 'true' )			? true	: false,
				navigation		: {
									nextEl			: '.swiper-button-next',
									prevEl			: '.swiper-button-prev',
								},
				pagination		: {
									el				: '.swiper-pagination',
									clickable		: true,
								},
				autoplay		: {
									delay			: parseInt( slider_conf.autoplay_speed ),
									stopOnLastSlide	: ( slider_conf.auto_stop_3d == 'true' ) ? true : false,
								},
				coverflowEffect	: {
									rotate			: 0,
									stretch			: 0,
									slideShadows	: false,
									depth			: parseInt( slider_conf.depth ),
									modifier		: parseInt( slider_conf.modifier ),
								},
				breakpoints		: {
									/* when window width is >= 320px */
									320	: {
											slidesPerView : parseInt( slider_conf.slide_show_mobile_3d ),
										},

									/* when window width is >= 480px */
									480	: {
											slidesPerView : parseInt( slider_conf.slide_show_tablet_3d ),
										},

									/* when window width is >= 640px */
									640	: {
											slidesPerView : parseInt( slider_conf.slide_to_show_3d ),
										},
								}
			});

			/* Autoplay Enable/Disable */
			if( slider_conf.autoplay == 'true' ) {
				swiper.autoplay.start();
			} else {
				swiper.autoplay.stop();
			}
		}
	});

	/* Swiper Slider Initialize */
	$('.wp-spaios-swiperslider').each(function( index ) {

		var slider_id	= $(this).attr('id');
		var slider_conf	= $.parseJSON( $(this).closest('.wp-spaios-slider-wrap').attr('data-conf'));

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			var swiper = new Swiper('#'+slider_id, {
				effect			: slider_conf.animation_swpr,
				direction		: 'horizontal',
				speed			: parseInt( slider_conf.speed ),
				slidesPerView	: parseInt( slider_conf.slide_to_show_swpr ),
				slidesPerGroup	: parseInt( slider_conf.slide_to_scroll_swpr ),
				spaceBetween	: parseInt( slider_conf.space_between_swpr ),
				centeredSlides	: ( slider_conf.centermode_swpr == 'true' )		? true	: false,
				autoHeight		: ( slider_conf.height_auto_swiper == 'true' )	? true	: false,
				loop			: ( slider_conf.loop == 'true' )				? true	: false,
				navigation		: {
									nextEl			: '.swiper-button-next',
									prevEl			: '.swiper-button-prev',
								},
				pagination		: {
									el				: '.swiper-pagination',
									clickable		: true,
								},
				autoplay		: {
									delay			: parseInt( slider_conf.autoplay_speed ),
									stopOnLastSlide	: ( slider_conf.auto_stop_swpr == 'true' ) ? true : false,
								},
				breakpoints		: {
									/* when window width is >= 320px */
									320	: {
											slidesPerView : parseInt( slider_conf.slide_show_mobile_swpr ),
										},

									/* when window width is >= 480px */
									480	: {
											slidesPerView : parseInt( slider_conf.slide_show_tablet_swpr ),
										},

									/* when window width is >= 640px */
									640	: {
											slidesPerView : parseInt( slider_conf.slide_to_show_swpr ),
										},
								}
			});

			/* Autoplay Enable/Disable */
			if( slider_conf.autoplay == 'true' ) {
				swiper.autoplay.start();
			} else {
				swiper.autoplay.stop();
			}
		}
	});

	/* Polaroids Gallery Slider Initialize */
	$('.wp-spaios-polaroids-gallery').each(function( index ) {

		var slider_id = $(this).attr('id');

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			new Photostack( document.getElementById( slider_id ), {
				callback : function( item ) {

				}
			});
		}
	});

	/* Swiper Slider Initialize */
	$('.wp-spaios-wallop-slider').each(function( index ) {

		var slider_id	= $(this).attr('id');
		var slider_conf	= $.parseJSON( $(this).closest('.wp-spaios-slider-wrap').attr('data-conf'));

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

			var wallop_id		= document.querySelector('#'+slider_id);
			var wallop			= new Wallop( wallop_id );
			var count 			= wallop.allItemsArray;
			var start 			= wallop.currentItemIndex;
			var end 			= count+1;
			var current_dot		= $(this).find('.Wallop-dot');
			var paginationDots	= Array.prototype.slice.call(current_dot);
			var autoplay		= slider_conf.autoplay;
			var autoplay_speed	= slider_conf.autoplay_speed;

			/* Pagination */
			paginationDots.forEach(function (dotEl, index) {
				dotEl.addEventListener('click', function() {
					wallop.goTo( index );
				});
			});

			/* Listen to wallop change and update classes */
			wallop.on('change', function(event) {
				$(this).find('.Wallop-dot--current').removeClass('Wallop-dot--current');		
				addClass(paginationDots[event.detail.currentItemIndex], 'Wallop-dot--current');
			});

			/* Add class function */
			function addClass(element, className) {
				if ( ! element ) {
					return;
				}
				element.className = element.className.replace(/\s+$/gi, '') + ' ' + className;
			}

			/* If autoplay is `true` */
			if( autoplay == 'true' ) {
				setInterval(function() {
					wallop.goTo( index );
					++index;
				}, autoplay_speed );
			}
		}
	});

	/* Un Slider Initialize */
	$('.wp-spaios-un-slider').each(function( index ) {

		var slider_id	= $(this).attr('id');
		var slider_conf	= $.parseJSON( $(this).closest('.wp-spaios-slider-wrap').attr('data-conf'));

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			jQuery('#'+slider_id).unslider({
				animation		: slider_conf.mode_un,
				delay			: parseInt( slider_conf.autoplay_speed ),
				speed			: parseInt( slider_conf.speed ),
				arrows			: ( slider_conf.arrow == 'true' )			? true : false,
				nav				: ( slider_conf.pagination == 'true' )		? true : false,
				autoplay		: ( slider_conf.autoplay == 'true' )		? true : false,
				animateHeight	: ( slider_conf.height_auto_un == 'true' )	? true : false,
			});
		}
	});
});