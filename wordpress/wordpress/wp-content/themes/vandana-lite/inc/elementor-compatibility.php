<?php 
/**
 * Elementor activation
 */

function vandana_lite_elementor_support(){
	update_option( 'elementor_cpt_support', array( 'blossom-portfolio', 'post','page' ) );
	update_option( 'elementor_default_generic_fonts', 'Halant' );
}
add_action( 'after_switch_theme', 'vandana_lite_elementor_support' );

/**
 * Filter to alter Default Font and Default Color
 */
function vandana_lite_elementor_defaults( $config ) {

	$primary_font    = get_theme_mod( 'primary_font', 'Nunito Sans' );
	$secondary_font  = get_theme_mod( 'secondary_font', 'Halant' );
	$primary_color   = get_theme_mod( 'primary_color', '#fbaca5' ); 
	$secondary_color = get_theme_mod( 'secondary_color', '#fff3f3' ); 

	$config['default_schemes']['color']['items'] = [
		'1' => $primary_color,
		'2' => $secondary_color,
		'3' => '#171717',
		'4' => $primary_color
	];

	$config['default_schemes']['typography']['items'] = [
		'1' => array(
			'font_family' => $primary_font,
	        'font_weight' => '400',
		),
		'2' => array(
			'font_family' => $primary_font,
	        'font_weight' => '400',
		),
		'3' => array(
			'font_family' => $primary_font,
	        'font_weight' => '400',
		),
		'4' => array(
			'font_family' => $secondary_font,
	        'font_weight' => '600',
		)];

	$config['i18n']['global_colors'] = __( 'Vandana Lite Color','vandana-lite' );
	$config['i18n']['global_fonts']  = __( 'Vandana Lite Fonts','vandana-lite' );

	return $config;
}
add_filter('elementor/editor/localize_settings', 'vandana_lite_elementor_defaults', 99 );