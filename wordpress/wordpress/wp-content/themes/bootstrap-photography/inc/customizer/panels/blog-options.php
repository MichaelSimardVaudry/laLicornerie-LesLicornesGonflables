<?php
/**
 * General Settings
 *
 * @package bootstrap_photography
 */

add_action( 'customize_register', 'bootstrap_photography_customize_blog_options_panel' );

function bootstrap_photography_customize_blog_options_panel( $wp_customize ) {
	$wp_customize->add_panel( 'bootstrap_photography_blog_options', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Blog Options', 'bootstrap-photography' ),
	    'description' => esc_html__( 'Blog Options', 'bootstrap-photography' ),
	) );
}