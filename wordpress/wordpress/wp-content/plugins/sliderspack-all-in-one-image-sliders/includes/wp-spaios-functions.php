<?php
/**
 * Plugin generic functions file
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_esc_attr($data) {
	return esc_attr( $data );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'wp_spaios_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash($data);
	}
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_clean_number( $var, $fallback = null, $type = 'int' ) {

	if ( $type == 'number' ) {
		$data = intval( $var );
	} else if ( $type == 'abs' ) {
		$data = abs( $var );
	} else {
		$data = absint( $var );
	}

	return ( empty($data) && isset($fallback) ) ? $fallback : $data;
}

/**
 * Sanitize color value and return fallback value if it is blank
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_clean_color( $color, $fallback = null ) {

	if ( false === strpos( $color, 'rgba' ) ) {
		
		$data = sanitize_hex_color( $color );

	} else {

		$red	= 0;
		$green	= 0;
		$blue	= 0;
		$alpha	= 0.5;

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		$data = 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
	}

	return ( empty($data) && $fallback ) ? $fallback : $data;
}

/**
 * Sanitize url
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_clean_url( $url ) {
	return esc_url_raw( trim($url) );
}

/**
 * Strip Slashes From Array
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_clean_html($data = array(), $flag = false) {

	if( $flag != true ) {
		$data = wp_spaios_nohtml_kses( $data );
	}

	$data = stripslashes_deep( $data );
	
	return $data;
}

/**
 * Strip Html Tags
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_nohtml_kses($data = array()) {

	if ( is_array($data) ) {

	$data = array_map('wp_spaios_nohtml_kses', $data);

	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}

	return $data;
}

/**
 * Sanitize Multiple HTML class
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_sanitize_html_classes($classes, $sep = " ") {
	$return = "";

	if( $classes && !is_array($classes) ) {
		$classes = explode($sep, $classes);
	}

	if( !empty($classes) ) {
		foreach($classes as $class){
			$return .= sanitize_html_class($class) . " ";
		}
		$return = trim( $return );
	}

	return $return;
}

/**
 * Function to add array after specific key
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_add_array(&$array, $value, $index, $from_last = false) {

	if( is_array($array) && is_array($value) ) {

		if( $from_last ) {
			$total_count    = count($array);
			$index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
		}
		
		$split_arr  = array_splice($array, max(0, $index));
		$array      = array_merge( $array, $value, $split_arr);
	}

	return $array;
}

/**
 * Function to unique number value
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to get slider style type
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_slider_type() {
	$slider_type = array(
					'bxslider'				=> esc_html__('bxSlider','sliderspack-all-in-one-image-sliders'),
					'flexslider'			=> esc_html__('FlexSlider 2','sliderspack-all-in-one-image-sliders'),
					'owl-slider'			=> esc_html__('Owl Slider/Carousel 2','sliderspack-all-in-one-image-sliders'),
					'nivo-slider'			=> esc_html__('Nivo Slider','sliderspack-all-in-one-image-sliders'),
					'3dslider'				=> esc_html__('3D Slider','sliderspack-all-in-one-image-sliders'),
					'swiperslider'			=> esc_html__('Swiper Slider','sliderspack-all-in-one-image-sliders'),
					'polaroids-gallery'		=> esc_html__('Scattered Polaroids Gallery','sliderspack-all-in-one-image-sliders'),
					'wallop-slider'			=> esc_html__('Wallop Slider','sliderspack-all-in-one-image-sliders'),
					'un-slider'				=> esc_html__('Unslider','sliderspack-all-in-one-image-sliders'),
				);
	return apply_filters('wp_spaios_slider_type', $slider_type );
}

/**
 * Function to get post excerpt
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

	$has_excerpt 	= false;
	$word_length 	= ! empty( $word_length ) ? $word_length : '55';

	// If post id is passed
	if( ! empty( $post_id ) ) {
		if ( has_excerpt( $post_id ) ) {

			$has_excerpt 	= true;
			$content 		= get_the_excerpt();

		} else {
			$content = ! empty( $content ) ? $content : get_the_content();
		}
	}

	if( ! empty( $content ) && ( ! $has_excerpt ) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}

	return $content;
}

/**
 * Function to get nivo slider effect
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_nivo_effect() {
	$nivo_effect = array(
					'sliceDown'				=> esc_html__('sliceDown','sliderspack-all-in-one-image-sliders'),
					'sliceDownLeft'			=> esc_html__('sliceDownLeft','sliderspack-all-in-one-image-sliders'),
					'sliceUp'				=> esc_html__('sliceUp','sliderspack-all-in-one-image-sliders'),
					'sliceUpLeft'			=> esc_html__('sliceUpLeft','sliderspack-all-in-one-image-sliders'),
					'sliceUpDown'			=> esc_html__('sliceUpDown','sliderspack-all-in-one-image-sliders'),
					'sliceUpDownLeft'		=> esc_html__('sliceUpDownLeft','sliderspack-all-in-one-image-sliders'),
					'fold'					=> esc_html__('fold','sliderspack-all-in-one-image-sliders'),
					'fade'					=> esc_html__('fade','sliderspack-all-in-one-image-sliders'),
					'random'				=> esc_html__('random','sliderspack-all-in-one-image-sliders'),
					'slideInRight'			=> esc_html__('slideInRight','sliderspack-all-in-one-image-sliders'),
					'slideInLeft'			=> esc_html__('slideInLeft','sliderspack-all-in-one-image-sliders'),
					'boxRandom'				=> esc_html__('boxRandom','sliderspack-all-in-one-image-sliders'),
					'boxRain'				=> esc_html__('boxRain','sliderspack-all-in-one-image-sliders'),
					'boxRainReverse'		=> esc_html__('boxRainReverse','sliderspack-all-in-one-image-sliders'),
					'boxRainGrow'			=> esc_html__('boxRainGrow','sliderspack-all-in-one-image-sliders'),
					'boxRainGrowReverse'	=> esc_html__('boxRainGrowReverse','sliderspack-all-in-one-image-sliders'),
				);
	return apply_filters('wp_spaios_nivo_effect', $nivo_effect );
}

/**
 * Function to get bx slider effect
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_bx_effect() {
	$bx_effect = array(
					'horizontal'	=> esc_html__('Horizontal','sliderspack-all-in-one-image-sliders'),
					'vertical'		=> esc_html__('Vertical','sliderspack-all-in-one-image-sliders'),
					'fade'			=> esc_html__('Fade','sliderspack-all-in-one-image-sliders'),
				);
	return apply_filters('wp_spaios_bx_effect', $bx_effect );
}

/**
 * Function to get flex slider animation
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_flex_animation() {
	$flex_animation = array(
						'slide'	=> esc_html__( 'Slide','sliderspack-all-in-one-image-sliders' ),
						'fade'	=> esc_html__( 'Fade','sliderspack-all-in-one-image-sliders' ),
					);
	return apply_filters( 'wp_spaios_flex_animation', $flex_animation );
}

/**
 * Function to get wallop slider effect
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_wallop_mode() {
	$wallop_mode = array(
					'slide'				=> esc_html__( 'Slide','sliderspack-all-in-one-image-sliders' ),
					'vertical-slide'	=> esc_html__( 'Vertical','sliderspack-all-in-one-image-sliders' ),
					'fade'				=> esc_html__( 'Fade','sliderspack-all-in-one-image-sliders' ),
					'scale'				=> esc_html__( 'Scale','sliderspack-all-in-one-image-sliders' ),
					'fade'				=> esc_html__( 'Fade','sliderspack-all-in-one-image-sliders' ),
					'rotate'			=> esc_html__( 'Rotate','sliderspack-all-in-one-image-sliders' ),
					'fold'				=> esc_html__( 'Fold','sliderspack-all-in-one-image-sliders' ),
				);
	return apply_filters( 'wp_spaios_wallop_mode', $wallop_mode );
}

/**
 * Function to get un slider effect
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_un_effect() {
	$un_effect = array(
					'horizontal'	=> esc_html__('Horizontal','sliderspack-all-in-one-image-sliders'),
					'vertical'		=> esc_html__('Vertical','sliderspack-all-in-one-image-sliders'),
				);
	return apply_filters('wp_spaios_un_effect', $un_effect );
}