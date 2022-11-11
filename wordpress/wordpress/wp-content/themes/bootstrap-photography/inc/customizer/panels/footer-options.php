<?php
/**
 * Footer Settings
 */

add_action( 'customize_register', 'bootstrap_photography_customize_register_footer_panel' );

function bootstrap_photography_customize_register_footer_panel( $wp_customize ) {
	$wp_customize->add_panel( 'bootstrap_photography_footer_panel', array(
	    'priority'    => 11,
	    'title'       => esc_html__( 'Footer Options', 'bootstrap-photography' ),
	    'description' => esc_html__( 'Choose Footer layout', 'bootstrap-photography' ),
	) );
}