<?php
/**
 * Front Page
 * 
 * @package Vandana_Lite
 */

$home_sections = vandana_lite_get_home_sections();
$ed_elementor  = get_theme_mod( 'ed_elementor', false );

if ( 'posts' == get_option( 'show_on_front' ) ) { //Show Static Blog Page
    include( get_home_template() );
}elseif( vandana_lite_is_elementor_activated_post() && $ed_elementor ){ 
	get_header();
    get_template_part( 'template-parts/content-elementor' );
    get_footer();
}elseif( $home_sections ){ 
    get_header();
    //If any one section are enabled then show custom home page.
    foreach( $home_sections as $section ){
        get_template_part( 'sections/' . $section );  
    }
    get_footer();
}else {
    //If all section are disabled then show respective page template. 
    include( get_page_template() );
}