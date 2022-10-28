<?php
/**
 * Layout Settings
 *
 * @package Vandana_Lite
 */

function vandana_lite_customize_register_layout( $wp_customize ) {
    
    /** Layout Settings */
    $wp_customize->add_panel( 
        'layout_settings',
         array(
            'priority'    => 30,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Layout Settings', 'vandana-lite' ),
            'description' => __( 'Change different page layout from here.', 'vandana-lite' ),
        ) 
    );

    /** Blog Page Layout Settings */
    $wp_customize->add_section(
        'blog_layout',
        array(
            'title'    => __( 'Blog Page Layout', 'vandana-lite' ),
            'priority' => 40,
            'panel'    => 'layout_settings',
        )
    );
    
    $wp_customize->add_setting( 
        'blog_page_layout', 
        array(
            'default'           => 'classic-layout',
            'sanitize_callback' => 'vandana_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Radio_Image_Control(
            $wp_customize,
            'blog_page_layout',
            array(
                'section'     => 'blog_layout',
                'label'       => __( 'Blog Page Layout', 'vandana-lite' ),
                'description' => __( 'Choose the blog page layout for your site.', 'vandana-lite' ),
                'choices'     => array(
                    'classic-layout' => esc_url( get_template_directory_uri() . '/images/blog/classic.jpg' ),
                    'grid-layout'    => esc_url( get_template_directory_uri() . '/images/blog/grid.jpg' ),
                    'list-layout'    => esc_url( get_template_directory_uri() . '/images/blog/listing.jpg' ),
                )
            )
        )
    );

    /** Home Page  Sidebar Layout Settings */
    $wp_customize->add_section(
        'general_layout_settings',
        array(
            'title'    => __( 'General Sidebar Layout', 'vandana-lite' ),
            'priority' => 55,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'vandana_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Radio_Image_Control(
            $wp_customize,
            'page_sidebar_layout',
            array(
                'section'     => 'general_layout_settings',
                'label'       => __( 'Page Sidebar Layout', 'vandana-lite' ),
                'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in respective page.', 'vandana-lite' ),
                'choices'     => array(
                    'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'centered'      => esc_url( get_template_directory_uri() . '/images/1cc.jpg' ),
                    'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
                )
            )
        )
    );
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'vandana_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Radio_Image_Control(
            $wp_customize,
            'post_sidebar_layout',
            array(
                'section'     => 'general_layout_settings',
                'label'       => __( 'Post Sidebar Layout', 'vandana-lite' ),
                'description' => __( 'This is the general sidebar layout for posts & custom post. You can override the sidebar layout for individual post in respective post.', 'vandana-lite' ),
                'choices'     => array(
                    'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'centered'      => esc_url( get_template_directory_uri() . '/images/1cc.jpg' ),
                    'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
                )
            )
        )
    );
    
    /** Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'vandana_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Vandana_Lite_Radio_Image_Control(
            $wp_customize,
            'layout_style',
            array(
                'section'     => 'general_layout_settings',
                'label'       => __( 'Default Sidebar Layout', 'vandana-lite' ),
                'description' => __( 'This is the general sidebar layout for whole site.', 'vandana-lite' ),
                'choices'     => array(
                    'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
                )
            )
        )
    );
    
}
add_action( 'customize_register', 'vandana_lite_customize_register_layout' );