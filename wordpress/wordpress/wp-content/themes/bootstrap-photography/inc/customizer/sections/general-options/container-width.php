<?php

/**
 * Container Width Settings
 *
 * @package bootstrap_photography
 */



add_action( 'customize_register', 'bootstrap_photography_customize_container_width' );

function bootstrap_photography_customize_container_width( $wp_customize ) {

    $wp_customize->add_section( 'bootstrap_photography_container_width', array(
        'title'          => esc_html__( 'Container Width', 'bootstrap-photography' ),
        'description'    => esc_html__( 'Container Width :', 'bootstrap-photography' ),
        'panel'          => 'bootstrap_photography_general_panel',
        'priority'       => 2,        
    ) );
            
    $wp_customize->add_setting( 'container_width', array(
        'default'           => 1140,
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( new Bootstrap_Photography_Slider_Control( $wp_customize, 'container_width', array(
        'section' => 'bootstrap_photography_container_width',
        'settings' => 'container_width',
        'label'   => esc_html__( 'Container Width', 'bootstrap-photography' ),
        'choices'     => array(
            'min'   => 1024,
            'max'   => 1600,
            'step'  => 1,
        )
    ) ) );

    
}

