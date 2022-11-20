<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WP_spaios_Script {

	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_spaios_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_spaios_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wp_spaios_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_spaios_admin_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_front_style() {

		// Swiper Slider Style
		if( ! wp_style_is( 'wpos-swiper-style', 'registered' ) ) {
			wp_register_style( 'wpos-swiper-style', WP_APAIOIS_URL.'assets/css/swiper.min.css', array(), WP_APAIOIS_VERSION );
		}

		// Flex Slider Style
		wp_register_style( 'wpos-flexslider-style', WP_APAIOIS_URL.'assets/css/flexslider.css', array(), WP_APAIOIS_VERSION );

		// Bx Slider Style
		wp_register_style( 'wpos-bxslider-style', WP_APAIOIS_URL.'assets/css/jquery.bxslider.css', array(), WP_APAIOIS_VERSION );

		// Nivo Slider Style
		wp_register_style( 'wpos-nivoslider-style', WP_APAIOIS_URL.'assets/css/nivo-slider.css', array(), WP_APAIOIS_VERSION );

		// OWL Carousel Slider Style
		wp_register_style( 'wpos-owlcarousel-style', WP_APAIOIS_URL.'assets/css/owl.carousel.css', array(), WP_APAIOIS_VERSION );

		// Polaroids Gallery Slider Style
		wp_register_style( 'wpos-polaroids-gallery-style', WP_APAIOIS_URL.'assets/css/polaroids-gallery.css', array(), WP_APAIOIS_VERSION );

		// Un Slider Style
		wp_register_style( 'wpos-unslider-style', WP_APAIOIS_URL.'assets/css/unslider.css', array(), WP_APAIOIS_VERSION );

		// Wallop Slider Style
		wp_register_style( 'wpos-wallop-style', WP_APAIOIS_URL.'assets/css/wallop.css', array(), WP_APAIOIS_VERSION );

		// Fancy Box Style
		if( ! wp_style_is( 'wpos-fancybox-style', 'registered' ) ) {
			wp_register_style( 'wpos-fancybox-style', WP_APAIOIS_URL.'assets/css/jquery.fancybox.min.css', null, WP_APAIOIS_VERSION );
		}

		// Public Style
		wp_register_style( 'wp-spaios-public-css', WP_APAIOIS_URL.'assets/css/wp-spaios-public.css', null, WP_APAIOIS_VERSION );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_front_script() {

		// Swiper Slider Script
		if( ! wp_script_is( 'wpos-swiper-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-swiper-jquery', WP_APAIOIS_URL.'assets/js/swiper.min.js', array('jquery'), WP_APAIOIS_VERSION, true );
		}

		// Bx Slider Script
		wp_register_script( 'wpos-bxslider-jquery', WP_APAIOIS_URL.'assets/js/jquery.bxslider.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// Flex Slider Script
		wp_register_script( 'wpos-flexslider-jquery', WP_APAIOIS_URL.'assets/js/jquery.flexslider-min.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// Nivo Slider Script
		wp_register_script( 'wpos-nivo-slider-jquery', WP_APAIOIS_URL.'assets/js/jquery.nivo.slider.pack.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// OWL Carousel Slider Script
		wp_register_script( 'wpos-owl-slider-jquery', WP_APAIOIS_URL.'assets/js/owl.carousel.min.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// Polaroids Gallery Slider Script
		wp_register_script( 'wpos-classie-jquery', WP_APAIOIS_URL.'assets/js/classie.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-modernizr-jquery', WP_APAIOIS_URL.'assets/js/modernizr.min.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-polaroids-gallery-jquery', WP_APAIOIS_URL.'assets/js/photostack.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// Un Slider Script
		wp_register_script( 'wpos-unslider-jquery', WP_APAIOIS_URL.'assets/js/unslider.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// Wallop Slider Script
		wp_register_script( 'wpos-wallop-slider-jquery', WP_APAIOIS_URL.'assets/js/wallop.min.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// Fancy Box Script
		wp_register_script( 'wpos-fancybox-jquery', WP_APAIOIS_URL.'assets/js/jquery.fancybox.min.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// Public Script
		wp_register_script( 'wp-spaios-public-script', WP_APAIOIS_URL.'assets/js/wp-spaios-public.js', array('jquery'), WP_APAIOIS_VERSION, true );
	}
	
	/**
	 * Enqueue admin styles
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_admin_style( $hook ) {

		global $post_type;

		if( $post_type == WP_APAIOIS_POST_TYPE || $hook == 'wpspaios_slider_page_welcome_sliderspack' ) {

			wp_register_style( 'wp-spaios-admin-style', WP_APAIOIS_URL.'assets/css/wp-spaios-admin.css', null, WP_APAIOIS_VERSION );
			wp_enqueue_style( 'wp-spaios-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_admin_script( $hook ) {

		global $wp_version, $post_type;

		$new_ui = $wp_version >= '3.5' ? '1' : '0';	// Check wordpress version for older scripts

		if( $post_type == WP_APAIOIS_POST_TYPE ) {

			wp_enqueue_script( 'jquery-ui-sortable' );	// UI Sortable
			wp_enqueue_media();							// For media uploader

			// Registring admin script
			wp_register_script( 'wp-spaios-admin-script', WP_APAIOIS_URL.'assets/js/wp-spaios-admin.js', array('jquery'), WP_APAIOIS_VERSION, true );
			wp_localize_script( 'wp-spaios-admin-script', 'WpSpaiosAdmin', array(
																	'new_ui' 				=>	$new_ui,
																	'img_edit_popup_text'	=> __('Edit Image in Popup', 'sliderspack-all-in-one-image-sliders'),
																	'attachment_edit_text'	=> __('Edit Image', 'sliderspack-all-in-one-image-sliders'),
																	'img_delete_text'		=> __('Remove Image', 'sliderspack-all-in-one-image-sliders'),
																));
			wp_enqueue_script( 'wp-spaios-admin-script' );
		}
	}
}

$wp_spaios_script = new WP_spaios_Script();