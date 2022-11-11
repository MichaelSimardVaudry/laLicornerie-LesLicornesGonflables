<?php
/**
 * Blog List Settings
 */


add_action( 'customize_register', 'bootstrap_photography_customize_blog_list_option' );

function bootstrap_photography_customize_blog_list_option( $wp_customize ) {

    $wp_customize->add_section( 'bootstrap_photography_blog_list_section', array(
        'title'          => esc_html__( 'Blog Options', 'bootstrap-photography' ),
        'panel'          => 'bootstrap_photography_blog_options',
    ) );

    $wp_customize->add_setting( 'blog_post_layout', array(
        'capability'  => 'edit_theme_options',        
        'sanitize_callback' => 'bootstrap_photography_sanitize_choices',
        'default'     => 'sidebar-right',
    ) );

    $wp_customize->add_control( new Bootstrap_Photography_Buttonset_Control( $wp_customize, 'blog_post_layout', array(
        'label' => esc_html__( 'Layouts :', 'bootstrap-photography' ),
        'section' => 'bootstrap_photography_blog_list_section',
        'settings' => 'blog_post_layout',
        'type'=> 'radio-buttonset',
        'choices'     => array(
            'sidebar-left' => esc_html__( 'Sidebar at left', 'bootstrap-photography' ),
            'no-sidebar'    =>  esc_html__( 'No sidebar', 'bootstrap-photography' ),
            'sidebar-right' => esc_html__( 'Sidebar at right', 'bootstrap-photography' ),            
        ),
    ) ) );


    $wp_customize->add_setting( 'blog_post_view', array(
        'capability'  => 'edit_theme_options',     
        'sanitize_callback' => 'bootstrap_photography_sanitize_choices',
        'default'     => 'grid-view',
    ) );

    $wp_customize->add_control( new Bootstrap_Photography_Buttonset_Control( $wp_customize, 'blog_post_view', array(
        'label' => esc_html__( 'Post View :', 'bootstrap-photography' ),
        'section' => 'bootstrap_photography_blog_list_section',
        'settings' => 'blog_post_view',
        'type'=> 'radio-buttonset',
        'choices'     => array(
            'grid-view' => esc_html__( 'Grid View', 'bootstrap-photography' ),
            'list-view' => esc_html__( 'List View', 'bootstrap-photography' ),
            'col-3-view' => esc_html__( 'Column 3 View', 'bootstrap-photography' ),
            'full-width-view' => esc_html__( 'Fullwidth View', 'bootstrap-photography' ),
        ),
    ) ) );           
    


}