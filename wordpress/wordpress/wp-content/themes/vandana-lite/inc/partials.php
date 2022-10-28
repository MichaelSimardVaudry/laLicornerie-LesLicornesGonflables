<?php
/**
 * Vandana Lite Customizer Partials
 *
 * @package Vandana_Lite
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function vandana_lite_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function vandana_lite_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'vandana_lite_get_slider_readmore' ) ) :
/**
 * Slider Readmore
*/
function vandana_lite_get_slider_readmore(){
    return esc_html( get_theme_mod( 'slider_readmore', __( 'Read More', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_about_readmore' ) ) :
/**
 * About Readmore
*/
function vandana_lite_get_about_readmore(){
    return esc_html( get_theme_mod( 'about_readmore', __( 'Know More', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_service_label' ) ) :
/**
 * Service Label
*/
function vandana_lite_get_service_label(){
    return esc_html( get_theme_mod( 'service_label', __( 'View All', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_testimonial_title' ) ) :
/**
 * Testimonial Title
*/
function vandana_lite_get_testimonial_title(){
    return esc_html( get_theme_mod( 'testimonial_title', __( 'Testimonials', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_testimonial_subtitle' ) ) :
/**
 * Testimonials Subtitle
*/
function vandana_lite_get_testimonial_subtitle(){
    return wpautop( wp_kses_post( get_theme_mod( 'testimonial_subtitle', __( 'Words of praise by my valuable clients.', 'vandana-lite' ) ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_blog_section_title' ) ) :
/**
 * Blog Title
*/
function vandana_lite_get_blog_section_title(){
    return esc_html( get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_blog_section_subtitle' ) ) :
/**
 * Blog Subtitle
*/
function vandana_lite_get_blog_section_subtitle(){
    return wpautop( wp_kses_post( get_theme_mod( 'blog_section_subtitle', __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Front Page Settings > Blog Section.', 'vandana-lite' ) ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_blog_view_all' ) ) :
/**
 * View All
*/
function vandana_lite_get_blog_view_all(){
    return esc_html( get_theme_mod( 'blog_view_all', __( 'View All', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_contact_sec_title' ) ) :
/**
 * Contact Title
*/
function vandana_lite_get_contact_sec_title(){
    return esc_html( get_theme_mod( 'contact_sec_title', __( 'Get in Touch Today', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_contact_subtitle' ) ) :
/**
 * Contact Subtitle
*/
function vandana_lite_get_contact_subtitle(){
    return wpautop( wp_kses_post( get_theme_mod( 'contact_subtitle', __( 'You can modify this section from Appearance > Customize > Front Page Settings > Contact Section..', 'vandana-lite' ) ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_wol_section_title' ) ) :
    /**
     * Wheel of life section title
     */
    function vandana_lite_get_wol_section_title(){
        return esc_html( get_theme_mod( 'wol_section_title' ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_wol_section_content' ) ) :
    /**
     * Wheel of life section title
    */
    function vandana_lite_get_wol_section_content(){
        return esc_html( get_theme_mod( 'wol_section_content' ) );
}
endif;
    
if( ! function_exists( 'vandana_lite_get_about_testimonial_title' ) ) :
/**
 * About Testimonial Title
*/
function vandana_lite_get_about_testimonial_title(){
    return esc_html( get_theme_mod( 'about_testimonial_title', __( 'Testimonials', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_about_testimonial_subtitle' ) ) :
/**
 * About Testimonials Subtitle
*/
function vandana_lite_get_about_testimonial_subtitle(){
    return wpautop( wp_kses_post( get_theme_mod( 'about_testimonial_subtitle', __( 'Words of praise by my valuable clients.', 'vandana-lite' ) ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_read_more' ) ) :
/**
 * Display blog readmore button
*/
function vandana_lite_get_read_more(){
    return esc_html( get_theme_mod( 'read_more_text', __( 'Read More', 'vandana-lite' ) ) );    
}
endif;

if( ! function_exists( 'vandana_lite_get_author_title' ) ) :
/**
 * Display blog readmore button
*/
function vandana_lite_get_author_title(){
    return esc_html( get_theme_mod( 'author_title', __( 'About Author', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function vandana_lite_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'You may also like', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_related_portfolio_title' ) ) :
/**
 * Display blog readmore button
*/
function vandana_lite_get_related_portfolio_title(){
    return esc_html( get_theme_mod( 'related_portfolio_title', __( 'Related Projects', 'vandana-lite' ) ) );
}
endif;

if( ! function_exists( 'vandana_lite_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function vandana_lite_get_footer_copyright(){    
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'vandana-lite' );
        echo date_i18n( esc_html__( 'Y', 'vandana-lite' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( 'All Rights Reserved. ', 'vandana-lite' );
    }
    echo '</span>'; 
}
endif;