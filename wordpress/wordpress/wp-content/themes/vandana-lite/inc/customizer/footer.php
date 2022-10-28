<?php
/**
 * Footer Setting
 *
 * @package Vandana_Lite
 */

function vandana_lite_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'vandana-lite' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );
    
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'   => __( 'Footer Copyright Text', 'vandana-lite' ),
            'section' => 'footer_settings',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector' => '.site-info .copyright',
        'render_callback' => 'vandana_lite_get_footer_copyright',
    ) );
        
}
add_action( 'customize_register', 'vandana_lite_customize_register_footer' );