<?php
/**
 * General Settings
 *
 * @package Bootstrap Photography
 */

add_action( 'customize_register', 'bootstrap_photography_customize_register_general_panel' );

function bootstrap_photography_customize_register_general_panel( $wp_customize ) {
	$wp_customize->add_panel( 'bootstrap_photography_general_panel', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'General Options', 'bootstrap-photography' ),
	    'description' => esc_html__( 'General Options', 'bootstrap-photography' ),
	) );
}