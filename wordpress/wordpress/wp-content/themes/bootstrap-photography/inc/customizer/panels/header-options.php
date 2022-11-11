<?php
/**
 * Header Settings
 */

add_action( 'customize_register', 'bootstrap_photography_customize_register_header_panel' );

function bootstrap_photography_customize_register_header_panel( $wp_customize ) {
	$wp_customize->add_panel( 'bootstrap_photography_header_panel', array(
	    'priority'    => 11,
	    'title'       => esc_html__( 'Header Options', 'bootstrap-photography' ),
	    'description' => esc_html__( 'Choose Header layout', 'bootstrap-photography' ),
	) );
}