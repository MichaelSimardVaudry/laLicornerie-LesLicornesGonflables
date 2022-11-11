<?php
/**
 * bootstrap-photography Theme Customizer
 *
 * @package Bootstrap Photography
 */

$panels   = array( 'general-options', 'header-options', 'blog-options', 'footer-options'  );

add_action( 'customize_register', 'bootstrap_photography_change_homepage_settings_options' );
function bootstrap_photography_change_homepage_settings_options( $wp_customize )  {
    
	$wp_customize->get_section( 'title_tagline' )->priority = 12;
	$wp_customize->get_section( 'static_front_page' )->priority = 13;

	$wp_customize->remove_control( 'header_textcolor' );

    require get_template_directory() . '/inc/google-fonts.php';    
}

$general_sections = array( 'colors', 'fonts', 'container-width' );
$header_sections = array(  'header-layout');
$footer_sections = array(  'footer-layout','footer-copyright');
$blog_sections = array(  'blog-section-options');


if( ! empty( $panels ) ) {
	foreach( $panels as $panel ){
	    require get_template_directory() . '/inc/customizer/panels/' . $panel . '.php';
	}
}


if( ! empty( $general_sections ) ) {
	foreach( $general_sections as $section ) {
	    require get_template_directory() . '/inc/customizer/sections/general-options/' . $section . '.php';
	}
}

if( ! empty( $header_sections ) ) {
    foreach( $header_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/header-options/' . $section . '.php';
    }
}

if( ! empty( $blog_sections ) ) {
    foreach( $blog_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/blog-options/' . $section . '.php';
    }
}

if( ! empty( $footer_sections ) ) {
    foreach( $footer_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/footer-options/' . $section . '.php';
    }
}


/**
 * Enqueue the customizer javascript.
 */
function bootstrap_photography_customize_preview_js() {
 	wp_enqueue_script( 'bootstrap-photography-customizer-preview', get_template_directory_uri() . '/js/customizer.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'bootstrap_photography_customize_preview_js' );


/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

add_action( 'customize_register', 'bootstrap_photography_site_identity_settings' );

function bootstrap_photography_site_identity_settings( $wp_customize ) {

    $wp_customize->add_setting( 'site_title_color_option', array(
        'capability'  => 'edit_theme_options',
        'default'     => '#4169e1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_color_option', array(
        'label'      => esc_html__( 'Site Title Color', 'bootstrap-photography' ),
        'section'    => 'title_tagline',
        'settings'   => 'site_title_color_option',
    ) ) );

    $wp_customize->add_setting( 'site_title_size', array(
        'default'           => 30,
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( new Bootstrap_photography_Slider_Control( $wp_customize, 'site_title_size', array(
        'section' => 'title_tagline',
        'settings' => 'site_title_size',
        'label'   => esc_html__( 'Logo Size', 'bootstrap-photography' ),
        'choices'     => array(
            'min'   => 15,
            'max'   => 60,
            'step'  => 1,
        )
    ) ) );

    $wp_customize->add_setting( 'site_identity_font_family', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'bootstrap_photography_sanitize_google_fonts',
        'default'     => 'Poppins',
    ) );

    $wp_customize->add_control( 'site_identity_font_family', array(
        'settings'    => 'site_identity_font_family',
        'label'       =>  esc_html__( 'Site Identity Font Family', 'bootstrap-photography' ),
        'section'     => 'title_tagline',
        'type'        => 'select',
        'choices'     => google_fonts(),
    ) );
    
}
