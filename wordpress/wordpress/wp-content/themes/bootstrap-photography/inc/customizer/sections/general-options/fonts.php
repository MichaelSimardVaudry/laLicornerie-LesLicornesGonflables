<?php

/**
 * Fonts Settings
 *
 * @package Bootstrap Photography
 */


add_action( 'customize_register', 'bootstrap_photography_customize_register_fonts_section' );
function bootstrap_photography_customize_register_fonts_section( $wp_customize ) {

    $wp_customize->add_section( 'bootstrap_photography_fonts_section', array(
        'title'          => esc_html__( 'Fonts', 'bootstrap-photography' ),
        'description'    => esc_html__( 'Fonts :', 'bootstrap-photography' ),
        'panel'          => 'bootstrap_photography_general_panel',
        'priority'       => 2,        
    ) );
}

add_action( 'customize_register', 'bootstrap_photography_customize_font_family' );

function bootstrap_photography_customize_font_family( $wp_customize ) {
            
    $wp_customize->add_setting( 'font_family', array(
        'transport' => 'postMessage',
        'default'     => 'Montserrat',
        'sanitize_callback' => 'bootstrap_photography_sanitize_google_fonts',
    ) );

    $wp_customize->add_control( 'font_family', array(
        'settings'    => 'font_family',
        'label'       =>  esc_html__( 'Choose Font Family For Your Site', 'bootstrap-photography' ),
        'section'     => 'bootstrap_photography_fonts_section',
        'type'        => 'select',
        'choices'     => google_fonts(),
        'priority'    => 100
    ) );
}

