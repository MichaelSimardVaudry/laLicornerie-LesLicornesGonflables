<?php
/**
 * Active Callback
 * 
 * @package Vandana_Lite
*/

/**
 * Active Callback for Notification Bar.
*/
function vandana_lite_notification( $control ){
    
    $ed_notification_bar    = $control->manager->get_setting( 'notification_bar_area' )->value();
    
    if ( $ed_notification_bar ) return true;

    return false;
}

if( ! function_exists( 'vandana_lite_banner_ac' ) ) :
/**
 * Active Callback for Banner Slider
*/
function vandana_lite_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type = $control->manager->get_setting( 'slider_type' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'banner_newsletter' && $banner == 'static_nl_banner' ) return true;    
    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_caption' && $banner == 'slider_banner' ) return true;          
    if ( $control_id == 'slider_readmore' && $banner == 'slider_banner' ) return true;     
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'hr' && $banner == 'slider_banner' ) return true;
    
    return false;
}
endif;

/**
 * Active Callback for Blog View All Button
*/
function vandana_lite_blog_view_all_ac( $control ){
    $ed_blog_section = $control->manager->get_setting( 'ed_blog_section' )->value();

    $blog = get_option( 'page_for_posts' );
    if( $ed_blog_section && $blog ) return true;
    
    return false; 
}

/**
 * Active Callback for post/page
*/
function vandana_lite_blog_section_ac( $control ){
    
    $ed_blog_section = $control->manager->get_setting( 'ed_blog_section' )->value();
    
    if ( $ed_blog_section ) return true;
    
    return false;
}

/**
 * Active Callback for post/page
*/
function vandana_lite_about_section_ac( $control ){
    
    $ed_about_section = $control->manager->get_setting( 'ed_about_section' )->value();
    
    if ( $ed_about_section ) return true;
    
    return false;
}

/**
 * Active Callback for post/page
*/
function vandana_lite_post_page_ac( $control ){
    
    $ed_related = $control->manager->get_setting( 'ed_related' )->value();
    $control_id = $control->id;
    
    if ( $control_id == 'related_post_title' && $ed_related == true ) return true;
    
    return false;
}

/**
 * Active Callback for Shop page description
*/
function vandana_lite_shop_description_ac( $control ){
    $ed_shop_archive_desc = $control->manager->get_setting( 'ed_shop_archive_description' )->value();
    $control_id = $control->id;
    
    if( $control_id == 'shop_archive_description' && $ed_shop_archive_desc == true && vandana_lite_is_woocommerce_activated() ) return true;
    
    return false;
}

/**
 * Active Callback for comment toggle.
*/
function vandana_lite_comments_toggle( $control ){
    
    $comment_toggle = $control->manager->get_setting( 'ed_comments' )->value();
    
    if ( $comment_toggle == true ) return true;
    
    return false;
}

/**
 * Active Callback for Wheel of Life
*/
function vandana_lite_wheeloflife_ac(){
    $ed_wheeloflife = get_theme_mod( 'ed_wheeloflife_section' , false );

    if( $ed_wheeloflife ) return true;
    
    return false; 
}

/**
 * Active Callback for local fonts
*/
function vandana_lite_ed_localgoogle_fonts(){
    $ed_localgoogle_fonts = get_theme_mod( 'ed_localgoogle_fonts' , false );

    if( $ed_localgoogle_fonts ) return true;
    
    return false; 
}

