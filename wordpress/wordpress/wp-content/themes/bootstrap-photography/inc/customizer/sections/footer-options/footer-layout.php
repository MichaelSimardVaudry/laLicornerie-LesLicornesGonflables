<?php
/**
 * Footer Layout Settings
 */

add_action( 'customize_register', 'bootstrap_photography_theme_footer_layout_section' );

function bootstrap_photography_theme_footer_layout_section( $wp_customize ) {

    $wp_customize->add_section( 'bootstrap_photography_theme_footer_layout_section', array(
        'title'          => esc_html__( 'Footer Layout', 'bootstrap-photography' ),
        'description'    => esc_html__( 'Choose Footer Layout', 'bootstrap-photography' ),
        'panel'          => 'bootstrap_photography_footer_panel',
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
    ) );

    $wp_customize->add_setting( 'bootstrap_photography_footer_layouts', array(
        'sanitize_callback' => 'bootstrap_photography_sanitize_choices',
        'default'     => 'one',
    ) );

    $wp_customize->add_control( new Bootstrap_Photography_Radio_Image_Control( $wp_customize, 'bootstrap_photography_footer_layouts', array(
        'label' => esc_html__( 'Footer Layout','bootstrap-photography' ),
        'section' => 'bootstrap_photography_theme_footer_layout_section',
        'settings' => 'bootstrap_photography_footer_layouts',
        'type'=> 'radio-image',
        'choices'     => array(
            'one'   => get_template_directory_uri() . '/images/homepage/footer-layouts/footer-layout-one.jpg',
            'two'   => get_template_directory_uri() . '/images/homepage/footer-layouts/footer-layout-two.jpg',
            'three'   => get_template_directory_uri() . '/images/homepage/footer-layouts/footer-layout-three.jpg',
        ),
    ) ) );

}