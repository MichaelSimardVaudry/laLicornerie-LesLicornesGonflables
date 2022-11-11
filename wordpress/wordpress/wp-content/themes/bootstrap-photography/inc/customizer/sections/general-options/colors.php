<?php
/**
 * Colors Settings
 *
 * @package Bootstrap Photography
 */


add_action( 'customize_register', 'bootstrap_photography_change_colors_panel' );

function bootstrap_photography_change_colors_panel( $wp_customize)  {
    $wp_customize->get_section( 'colors' )->priority = 1;
    $wp_customize->get_section( 'colors' )->panel = 'bootstrap_photography_general_panel';
}


add_action( 'customize_register', 'bootstrap_photography_customize_color_options' );

function bootstrap_photography_customize_color_options( $wp_customize ) {
            
    $wp_customize->add_setting( 'header_bg_colors', array(
        'default'     => '#fff',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_colors', array(
        'label'      => esc_html__( 'Header Background Color', 'bootstrap-photography' ),
        'section'    => 'colors',
        'settings'   => 'header_bg_colors',
        'priority'   => 1
    ) ) );

    $wp_customize->add_setting( 'header_text_colors', array(
        'default'     => '#ff0000',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_colors', array(
        'label'      => esc_html__( 'Menu Text Color', 'bootstrap-photography' ),
        'section'    => 'colors',
        'settings'   => 'header_text_colors',
        'priority'   => 1
    ) ) );

    $wp_customize->add_setting( 'menu_dropdown_bg_colors', array(
        'default'     => '#999',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_dropdown_bg_colors', array(
        'label'      => esc_html__( 'Menu Dropdown Background Color', 'bootstrap-photography' ),
        'section'    => 'colors',
        'settings'   => 'menu_dropdown_bg_colors',
        'priority'   => 2
    ) ) );

    $wp_customize->add_setting( 'footer_bg_colors', array(
        'default'     => '#f5f5f5',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_colors', array(
        'label'      => esc_html__( 'Footer Background Color', 'bootstrap-photography' ),
        'section'    => 'colors',
        'settings'   => 'footer_bg_colors',
        'priority'   => 2
    ) ) );

    $wp_customize->add_setting( 'footer_text_colors', array(
        'default'     => '#999',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_colors', array(
        'label'      => esc_html__( 'Footer Text Color', 'bootstrap-photography' ),
        'section'    => 'colors',
        'settings'   => 'footer_text_colors',
        'priority'   => 2
    ) ) );

    $wp_customize->add_setting( 'footer_title_colors', array(
        'default'     => '#000',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title_colors', array(
        'label'      => esc_html__( 'Footer Title Color', 'bootstrap-photography' ),
        'section'    => 'colors',
        'settings'   => 'footer_title_colors',
        'priority'   => 2
    ) ) );
    $wp_customize->add_setting( 'footer_link_colors', array(
        'default'     => '#000',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_colors', array(
        'label'      => esc_html__( 'Footer Link Color', 'bootstrap-photography' ),
        'section'    => 'colors',
        'settings'   => 'footer_link_colors',
        'priority'   => 2
    ) ) );
}


