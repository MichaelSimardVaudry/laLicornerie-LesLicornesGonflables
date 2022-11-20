<?php
/**
 * Agent Shortcode `sliders_pack`
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to handle testimonial shortcode
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.1
 */
function wp_spaios_slider_shortcode( $atts, $content = null) {

	// Taking some globals
	global $post;

	$atts = shortcode_atts( array(
		'id' => '',
	), $atts, 'sliders_pack');

	$atts['slider_id'] = ! empty( $atts['id'] ) ? $atts['id'] : array();

	extract( $atts );

	// Taking some variables
	$slider_conf	= '';
	$count			= 0;
	$prefix			= WP_APAIOIS_META_PREFIX;
	$unique			= wp_spaios_get_unique();

	// Taking some general variable
	$check_post_gallery	= get_post_meta( $slider_id, $prefix.'check_post_gallery', true );
	$slider_type		= get_post_meta( $slider_id, $prefix.'slider_type', true );

	// Taking common parameters
	$arrow				= get_post_meta( $slider_id, $prefix.'arrow', true );
	$pagination			= get_post_meta( $slider_id, $prefix.'pagination', true );
	$speed				= get_post_meta( $slider_id, $prefix.'speed', true );
	$autoplay			= get_post_meta( $slider_id, $prefix.'autoplay', true );
	$autoplay_speed		= get_post_meta( $slider_id, $prefix.'autoplay_speed', true );
	$loop				= get_post_meta( $slider_id, $prefix.'loop', true );
	$caption			= get_post_meta( $slider_id, $prefix.'caption', true );
	$link_target		= get_post_meta( $slider_id, $prefix.'link_target', true );
	$slide_media_size	= get_post_meta( $slider_id, $prefix.'slide_media_size', true );
	$fancy_box			= get_post_meta( $slider_id, $prefix.'fancy_box', true );
	$link_target		= ! empty( $link_target )	? $link_target : '_blank';
	$show_caption		= ( $caption == 'true' )	? 1 : 0;
	$fancy_box			= ( $fancy_box == 'true' )	? 1 : 0;

	// If fancybox is there
	if( $fancy_box ) {

		$fancy_conf = array(
						'loop'				=> 'true',
						'transitionEffect'	=> 'slide',
					);

		// Enqueue Style & Script
		wp_enqueue_style( 'wpos-fancybox-style' );
		wp_enqueue_script( 'wpos-fancybox-jquery' );
	}

	// If type is "Gallery" is there
	if( $check_post_gallery == 'gallery' ) {
		$gallery_imgs = get_post_meta( $slider_id, $prefix.'gallery_id', true );
	}

	// If type is "ACF Gallery" is there
	if( $check_post_gallery == 'acf-gallery' ) {
		$acf_field	= get_post_meta( $slider_id, $prefix.'acf_field_name', true );
		$acf_images	= get_field( $acf_field );
	}

	// If type is "WordPress Post" is there
	if( $check_post_gallery == 'post' ) {

		// Include category 
		$include_category	= get_post_meta( $id, $prefix.'include_category', true );
		$include_category	= ! empty( $include_category ) ? explode(',', $include_category) : '';

		$limit			= get_post_meta( $slider_id, $prefix.'slide_ptype_limit', true );
		$show_title		= get_post_meta( $slider_id, $prefix.'slide_ptype_title', true );
		$show_content	= get_post_meta( $slider_id, $prefix.'slide_ptype_content', true );
		$show_readmore	= get_post_meta( $slider_id, $prefix.'slide_ptype_readmorebtn', true );
		$readmore_text	= get_post_meta( $slider_id, $prefix.'content_readmore_text', true );
		$show_category	= get_post_meta( $slider_id, $prefix.'slide_ptype_cat_name', true );
		$words_limit	= get_post_meta( $slider_id, $prefix.'content_word_limit', true );
		$show_title		= ( $show_title == 'true' )		? 1 : 0;
		$show_content	= ( $show_content == 'true' )	? 1 : 0;
		$show_readmore	= ( $show_readmore == 'true' )	? 1 : 0;
		$show_category	= ( $show_category == 'true' )	? 1 : 0;
		$words_limit	= ! empty( $words_limit ) ? $words_limit : '30';

		//Post Type Parameter
		$support_post_types = 'post';
		$texonmy_terms 		= 'category';
		$content_tail 		= "...";

		// Query Parameter
		$args = array (
			'post_type'			=> 'post',
			'post_status'		=> array( 'publish' ),
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'posts_per_page'	=> $limit,
		);

		// Category Parameter
		if( ! empty( $include_category ) ) {

			$args['tax_query'] = array(
									array( 
										'taxonomy'			=> 'category',
										'field'				=> 'term_id',
										'terms'				=> $include_category,
								));

		}

		//WP Query
		$query = new WP_Query( $args );
	}

	// Taking Bx Slider Parameters
	if( $slider_type == 'bxslider' ) {

		$ticker_bx				= get_post_meta( $slider_id, $prefix.'ticker_bx', true );		
		$ticker_hover_bx		= get_post_meta( $slider_id, $prefix.'ticker_hover_bx', true );		
		$height_start_bx		= get_post_meta( $slider_id, $prefix.'height_start_bx', true );
		$random_start_bx		= get_post_meta( $slider_id, $prefix.'random_start_bx', true );
		$mode_bx				= get_post_meta( $slider_id, $prefix.'mode_bx', true );
		$slide_to_show_bx		= get_post_meta( $slider_id, $prefix.'slide_to_show_bx', true );
		$max_slide_to_show_bx	= get_post_meta( $slider_id, $prefix.'max_slide_to_show_bx', true );
		$slide_to_scroll_bx		= get_post_meta( $slider_id, $prefix.'slide_to_scroll_bx', true );
		$slide_margin_bx		= get_post_meta( $slider_id, $prefix.'slide_margin_bx', true );
		$slide_width_bx			= get_post_meta( $slider_id, $prefix.'slide_width_bx', true );
		$start_slide_bx			= get_post_meta( $slider_id, $prefix.'start_slide_bx', true );

		$slide_to_show_bx		= ! empty( $slide_to_show_bx ) ? $slide_to_show_bx : 1;
		$max_slide_to_show_bx	= ! empty( $max_slide_to_show_bx ) ? $max_slide_to_show_bx : 1;
		$slide_to_scroll_bx		= ! empty( $slide_to_scroll_bx ) ? $slide_to_scroll_bx : 1;
		$start_slide_bx			= ! empty( $start_slide_bx ) ? $start_slide_bx : 0;
		$slide_width_bx			= ! empty( $slide_width_bx ) ? $slide_width_bx : 580;				
 
		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop', 'mode_bx', 'slide_to_show_bx', 'max_slide_to_show_bx', 'slide_to_scroll_bx', 'slide_margin_bx', 'slide_width_bx', 'start_slide_bx', 'ticker_bx', 'ticker_hover_bx', 'height_start_bx', 'random_start_bx', 'caption');

		// Enquque Style & Script
		wp_enqueue_style( 'wpos-bxslider-style');
		wp_enqueue_script( 'wpos-bxslider-jquery' );
	}
	
	// Taking Flex Slider Parameters
	if( $slider_type == 'flexslider' ) {

		$animation_flex			= get_post_meta( $slider_id, $prefix.'animation_flex', true );
		$slide_to_show_flex		= get_post_meta( $slider_id, $prefix.'slide_to_show_flex', true );
		$max_slide_to_show_flex	= get_post_meta( $slider_id, $prefix.'max_slide_to_show_flex', true );
		$slide_to_scroll_flex	= get_post_meta( $slider_id, $prefix.'slide_to_scroll_flex', true );
		$slide_margin_flex		= get_post_meta( $slider_id, $prefix.'slide_margin_flex', true );
		$slide_width_flex		= get_post_meta( $slider_id, $prefix.'slide_width_flex', true );
		$start_slide_flex		= get_post_meta( $slider_id, $prefix.'start_slide_flex', true );
		$height_auto_flex		= get_post_meta( $slider_id, $prefix.'height_auto_flex', true );
		$random_start_flex		= get_post_meta( $slider_id, $prefix.'random_start_flex', true );
		$ticker_hover_flex		= get_post_meta( $slider_id, $prefix.'ticker_hover_flex', true );

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop', 'animation_flex', 'slide_to_show_flex','max_slide_to_show_flex', 'slide_to_scroll_flex', 'slide_margin_flex', 'slide_width_flex', 'start_slide_flex', 'ticker_hover_flex', 'height_auto_flex', 'random_start_flex');

		// Enqueue Style & Script
		wp_enqueue_style( 'wpos-flexslider-style');
		wp_enqueue_script( 'wpos-flexslider-jquery' );
	}

	// Taking OWL Carousel Slider Parameters
	if( $slider_type == 'owl-slider' ) {

		$slide_to_show_owl		= get_post_meta( $slider_id, $prefix.'slide_to_show_owl', true );
		$slide_show_ipad_owl	= get_post_meta( $slider_id, $prefix.'slide_show_ipad_owl', true );
		$slide_show_tablet_owl	= get_post_meta( $slider_id, $prefix.'slide_show_tablet_owl', true );
		$slide_show_mobile_owl	= get_post_meta( $slider_id, $prefix.'slide_show_mobile_owl', true );
		$slide_to_scroll_owl	= get_post_meta( $slider_id, $prefix.'slide_to_scroll_owl', true );
		$slide_margin_owl		= get_post_meta( $slider_id, $prefix.'slide_margin_owl', true );
		$slide_padding_owl		= get_post_meta( $slider_id, $prefix.'slide_padding_owl', true );
		$start_slide_owl		= get_post_meta( $slider_id, $prefix.'start_slide_owl', true );
		$slide_center_owl		= get_post_meta( $slider_id, $prefix.'slide_center_owl', true );
		$slide_autowidth_owl	= get_post_meta( $slider_id, $prefix.'slide_autowidth_owl', true );
		$height_auto_owl		= get_post_meta( $slider_id, $prefix.'height_auto_owl', true );
		$slide_freeDrag_owl		= get_post_meta( $slider_id, $prefix.'slide_freeDrag_owl', true );
		$slide_rtl_owl			= get_post_meta( $slider_id, $prefix.'slide_rtl_owl', true );

		$slide_to_show_owl		= ! empty( $slide_to_show_owl )		? $slide_to_show_owl		: 3;
		$slide_to_scroll_owl	= ! empty( $slide_to_scroll_owl )	? $slide_to_scroll_owl		: 1;
		$slide_margin_owl		= ! empty( $slide_margin_owl )		? (int)$slide_margin_owl	: 5;
		$slide_padding_owl		= ! empty( $slide_padding_owl )		? (int)$slide_padding_owl	: '';

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop','slide_to_show_owl', 'slide_show_ipad_owl', 'slide_show_tablet_owl', 'slide_show_mobile_owl', 'slide_to_scroll_owl', 'slide_margin_owl', 'slide_padding_owl', 'start_slide_owl', 'slide_center_owl', 'slide_autowidth_owl', 'slide_freeDrag_owl', 'height_auto_owl', 'slide_rtl_owl');

		// Enqueue Style & Script
		wp_enqueue_style( 'wpos-owlcarousel-style');
		wp_enqueue_script( 'wpos-owl-slider-jquery' );
	}
	
	// Taking Nivo Slider Parameters
	if( $slider_type == 'nivo-slider' ) {

		$effect_nivo		= get_post_meta( $slider_id, $prefix.'effect_nivo', true );
		$width_nivo			= get_post_meta( $slider_id, $prefix.'width_nivo', true );
		$start_nivo			= get_post_meta( $slider_id, $prefix.'start_nivo', true );
		$pauseon_over_nivo	= get_post_meta( $slider_id, $prefix.'pauseon_over_nivo', true );
		$random_start_nivo	= get_post_meta( $slider_id, $prefix.'random_start_nivo', true );

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'show_caption', 'start_nivo', 'effect_nivo', 'pauseon_over_nivo', 'random_start_nivo');

		// Enquque Style & Script
		wp_enqueue_style( 'wpos-nivoslider-style');
		wp_enqueue_script( 'wpos-nivo-slider-jquery' );
	}

	// Taking 3D Slider Parameters
	if( $slider_type == '3dslider' ) {

		$slide_to_show_3d		= get_post_meta( $slider_id, $prefix.'slide_to_show_3d', true );
		$slide_show_tablet_3d	= get_post_meta( $slider_id, $prefix.'slide_show_tablet_3d', true );
		$slide_show_mobile_3d	= get_post_meta( $slider_id, $prefix.'slide_show_mobile_3d', true );
		$slide_to_scroll_3d		= get_post_meta( $slider_id, $prefix.'slide_to_scroll_3d', true );
		$space_between_3d		= get_post_meta( $slider_id, $prefix.'space_between_3d', true );
		$centermode_3d			= get_post_meta( $slider_id, $prefix.'centermode_3d', true );
		$auto_stop_3d			= get_post_meta( $slider_id, $prefix.'auto_stop_3d', true );
		$depth					= get_post_meta( $slider_id, $prefix.'depth', true );
		$modifier				= get_post_meta( $slider_id, $prefix.'modifier', true );

		$slide_to_show_3d		= ! empty( $slide_to_show_3d )		? $slide_to_show_3d		: 3;
		$slide_show_tablet_3d	= ! empty( $slide_show_tablet_3d )	? $slide_show_tablet_3d	: 1;
		$slide_show_mobile_3d	= ! empty( $slide_show_mobile_3d )	? $slide_show_mobile_3d	: 1;
		$slide_to_scroll_3d		= ! empty( $slide_to_scroll_3d )	? $slide_to_scroll_3d	: 1;
		$space_between_3d		= ! empty( $space_between_3d )		? $space_between_3d		: 0;
		$depth					= ! empty( $depth )					? $depth				: 20;
		$modifier				= ! empty( $modifier )				? $modifier				: 20;

		// Slider Configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop','slide_to_show_3d', 'slide_show_tablet_3d', 'slide_show_mobile_3d', 'slide_to_scroll_3d', 'centermode_3d', 'space_between_3d', 'auto_stop_3d', 'depth', 'modifier' );

		// Enqueue Style & Script
		wp_enqueue_style( 'wpos-swiper-style');
		wp_enqueue_script( 'wpos-swiper-jquery' );
	}

	// Taking Swiper Slider Parameters
	if( $slider_type == 'swiperslider' ) {

		$slide_to_show_swpr		= get_post_meta( $slider_id, $prefix.'slide_to_show_swpr', true );
		$slide_show_tablet_swpr	= get_post_meta( $slider_id, $prefix.'slide_show_tablet_swpr', true );
		$slide_show_mobile_swpr	= get_post_meta( $slider_id, $prefix.'slide_show_mobile_swpr', true );
		$slide_to_scroll_swpr	= get_post_meta( $slider_id, $prefix.'slide_to_scroll_swpr', true );
		$auto_stop_swpr			= get_post_meta( $slider_id, $prefix.'auto_stop_swpr', true );
		$space_between_swpr		= get_post_meta( $slider_id, $prefix.'space_between_swpr', true );
		$centermode_swpr		= get_post_meta( $slider_id, $prefix.'centermode_swpr', true );
		$animation_swpr			= get_post_meta( $slider_id, $prefix.'animation_swpr', true );
		$height_auto_swiper		= get_post_meta( $slider_id, $prefix.'height_auto_swiper', true );

		$slide_to_show_swpr		= ! empty( $slide_to_show_swpr )		? $slide_to_show_swpr		: 1;
		$slide_show_tablet_swpr	= ! empty( $slide_show_tablet_swpr )	? $slide_show_tablet_swpr	: 1;
		$slide_show_mobile_swpr	= ! empty( $slide_show_mobile_swpr )	? $slide_show_mobile_swpr	: 1;
		$slide_to_scroll_swpr	= ! empty( $slide_to_scroll_swpr )		? $slide_to_scroll_swpr		: 1;
		$space_between_swpr		= ! empty( $space_between_swpr )		? $space_between_swpr		: 0;

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop','slide_to_show_swpr', 'slide_show_tablet_swpr', 'slide_show_mobile_swpr', 'slide_to_scroll_swpr', 'auto_stop_swpr', 'centermode_swpr', 'space_between_swpr', 'animation_swpr', 'height_auto_swiper');

		// Enquque Style & Script
		wp_enqueue_style( 'wpos-swiper-style');
		wp_enqueue_script( 'wpos-swiper-jquery' );
	}

	// Enqueue Style & Script for Polaroids Gallery
	if( $slider_type == 'polaroids-gallery' ) {
		wp_enqueue_style( 'wpos-polaroids-gallery-style');
		wp_enqueue_script( 'wpos-classie-jquery' );
		wp_enqueue_script( 'wpos-modernizr-jquery' );
		wp_enqueue_script( 'wpos-polaroids-gallery-jquery' );
	}

	// Taking Wallop Slider Parameters
	if( $slider_type == 'wallop-slider' ) {
		$mode_wallop = get_post_meta( $slider_id, $prefix.'mode_wallop', true );

		// Slider Configuration
		$slider_conf = compact('arrow', 'pagination', 'autoplay', 'autoplay_speed');

		// Enqueue Style & Script
		wp_enqueue_style( 'wpos-wallop-style');
		wp_enqueue_script( 'wpos-wallop-slider-jquery' );
	}

	// Taking Un Slider Parameters
	if( $slider_type == 'un-slider' ) {

		$mode_un		= get_post_meta( $slider_id, $prefix.'mode_un', true );
		$height_auto_un	= get_post_meta( $slider_id, $prefix.'height_auto_un', true );

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'height_auto_un', 'mode_un');

		// Enquque Style & Script
		wp_enqueue_style( 'wpos-unslider-style');
		wp_enqueue_script( 'wpos-unslider-jquery' );
	}

	// Enqueue Public Style & Script
	wp_enqueue_style( 'wp-spaios-public-css' );
	wp_enqueue_script( 'wp-spaios-public-script' );

	// Design File
	$design_file_path	= WP_APAIOIS_DIR . '/templates/' . $check_post_gallery.'/'.$slider_type.'/design-1.php';
	$design_file_path	= file_exists( $design_file_path ) ? $design_file_path : '';

	// Taking some variable
	$slider_style	= '';
	$slider_inr_cls	= '';
	$slider_cls		= "wp-spaios-{$slider_type} wp-spaios-{$check_post_gallery}";
	$slider_id		= "wp-spaios-{$slider_type}-{$unique}";

	// If nivo slider is there
	if( $slider_type == 'nivo-slider' ) {
		$slider_style = "max-width: {$width_nivo}px; margin: 0 auto;";
	}

	// Sliders Class
	if( $slider_type == 'flexslider' ) {

		$slider_inr_cls .= " slides";

	} else if( $slider_type == 'owl-slider' ) {

		$slider_cls .= " owl-carousel";

	} else if( $slider_type == '3dslider' || $slider_type == 'swiperslider' ) {

		$slider_cls		.= " swiper-container";
		$slider_inr_cls	.= " swiper-wrapper";

	} else if( $slider_type == 'polaroids-gallery' ) {

		$slider_cls		.= " photostack";
		$slider_inr_cls	.= "";

	} else if( $slider_type == 'wallop-slider' ) {

		$slider_cls		.= " Wallop";
		$slider_inr_cls	.= " Wallop-list Wallop--{$mode_wallop}";

	} else {

		$slider_cls .= " {$slider_type}";
	}

	ob_start(); ?>

	<div class="wp-spaios-slider-wrap wp-spaios-row-clearfix" data-conf="<?php echo htmlspecialchars(json_encode( $slider_conf )); ?>">
		<div class="wp-spaios-slider <?php echo $slider_cls; ?>" id="<?php echo $slider_id; ?>" style="<?php echo $slider_style; ?>">
			<?php if( $slider_type == 'flexslider' || $slider_type == '3dslider' || $slider_type == 'swiperslider' || $slider_type == 'polaroids-gallery' || $slider_type == 'wallop-slider' ) { ?>
			<div class="<?php echo $slider_inr_cls; ?>">
			<?php } if( $slider_type == 'un-slider' ) { echo '<ul>'; } ?>
			<?php
				// If type "Gallery" is there
				if( $check_post_gallery == 'gallery' ) {
					if( $gallery_imgs ) {
						foreach ($gallery_imgs as $gallery_key => $gallery_val) {

							// Taking some variable
							$image_data	= get_post( $gallery_val );
							$captions	= $image_data->post_excerpt;
							$image_title = $image_data->post_title;
							$image		= wp_get_attachment_image_src( $gallery_val, $slide_media_size );
							$img_link	= get_post_meta( $gallery_val, $prefix.'attachment_link',true );
							$alt_text	= get_post_meta( $image, '_wp_attachment_image_alt', true );

							// Include shortcode html file
							if( $design_file_path ) {
								include( $design_file_path );
							}

							$count++;
						}
					}
				}

				// If type "WordPress Post" is there
				if( $check_post_gallery == 'post' ) {
					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post();

							// Taking some variable
							$post_title		= get_the_title();
							$post_content	= wp_trim_words( get_the_content(), $words_limit, '' );
							$post_image		= get_the_post_thumbnail_url( $post->ID, $slide_media_size );
							$post_link		= get_the_permalink();
							$terms			= get_the_terms( $post->ID, 'category' );
							$term_links		= array();

							// Category
							if( $terms ) {
								foreach ( $terms as $term ) {
									$term_link		= get_term_link( $term );
									$term_links[]	= '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
								}
							}

							$cat_name = join( "-", $term_links );

							// Include shortcode html file
							if( $design_file_path ) {
								include( $design_file_path );
							}

							$count++;

						endwhile;
					endif;
				}

				// If type "ACF Gallery" is there
				if( $check_post_gallery == 'acf-gallery' ) {

					$acf_images = (array)$acf_images;

					if( $acf_images ) {
						foreach ($acf_images as $acf_image_key => $acf_image_data) {

							// Taking some variable
							$captions	= $acf_image_data['caption'];
							$image		= $acf_image_data['url'];
							$image_title = $acf_image_data['title'];
							$alt_text	= $acf_image_data['alt'];

							// Include shortcode html file
							if( $design_file_path ) {
								include( $design_file_path );
							}

							$count++;
						}
					}
				}
			?>
			<?php if( $slider_type == 'flexslider' || $slider_type == '3dslider' || $slider_type == 'swiperslider' || $slider_type == 'polaroids-gallery' || $slider_type == 'wallop-slider' ) { ?>
			</div>
			<?php } if( $slider_type == 'un-slider' ) { echo '</ul>'; } ?>

			<?php
				// If swiper slider and 3d slider is there
				if( $slider_type == '3dslider' || $slider_type == 'swiperslider' ) {

					// Add Arrow
					if( $arrow == 'true' ) { ?>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					<?php }
					
					// Add Pagination
					if( $pagination == 'true' ) { ?>
						<div class="swiper-pagination"></div>
					<?php }
			}

			// If Wallop Slider is there
			if( $slider_type == 'wallop-slider' ) {

				// Add Arrow
				if( $arrow == 'true' ) { ?>
					<a href="javascript:void(0)" class="Wallop-button Wallop-buttonPrevious">Previous</a>
					<a href="javascript:void(0)" class="Wallop-button Wallop-buttonNext">Next</a>
				<?php }

				// Add Pagination
				if( $pagination == 'true' ) { ?>
					<div class="Wallop-pagination">
						<?php for( $i = 1; $i <= $count; $i++ ) { ?>
							<a href="javascript:void(0)" class="Wallop-dot"></a>
						<?php } ?>
					</div>
				<?php }
			} ?>
		</div><!-- end .wp-spaios-slider -->
	</div><!-- end .wp-spaios-slider-wrap -->
	<?php
	wp_reset_postdata(); // Reset WP Query
	$content .= ob_get_clean();
	return $content;
}

// SlidersPack Shortcode
add_shortcode( 'sliders_pack', 'wp_spaios_slider_shortcode' );