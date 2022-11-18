<?php
/*
Plugin Name: XO Slider
Plugin URI: https://xakuro.com/wordpress/
Description: XO Slider is a plugin that allows you to easily create sliders.
Author: Xakuro
Author URI: https://xakuro.com/
License: GPLv2
Version: 3.4.1
Text Domain: xo-liteslider
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'XO_SLIDER_VERSION', '3.4.1' );

load_plugin_textdomain( 'xo-liteslider' );

require_once( __DIR__ . '/inc/main.php' );

$xo_slider = new XO_Slider();

/**
 * Display slider.
 *
 * @since 2.0.0
 *
 * @param int  $slider_id Optional, default is latest slider. Slider ID.
 * @param bool $echo      Optional, default is true. Set to false for return.
 * @return void|string Void if `$echo` argument is true, slider HTML if `$echo` is false.
 */
function xo_slider( $slider_id = 0, $echo = true ) {
	global $xo_slider;
	$slider = $xo_slider->get_slider( $slider_id );
	if ( $echo ) {
		echo $slider;
		return;
	}
	return $slider;
}

/**
 * Display slider.
 *
 * @since 1.0.0
 * @deprecated 2.0.0 Use xo_slider()
 * @see xo_slider()
 *
 * @param int $slider_id Optional, default is latest slider. Slider ID.
 * @return string Void Slider HTML.
 */
function xo_liteslider( $slider_id = 0 ) {
	xo_slider( $slider_id, true );
}
