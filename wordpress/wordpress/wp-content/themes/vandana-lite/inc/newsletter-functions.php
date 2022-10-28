<?php
/**
 * Blossomthemes Email Newsletter Functions.
 *
 * @package Vandana_Lite
 */

if( ! function_exists( 'vandana_lite_add_inner_div' ) ) :
    function vandana_lite_add_inner_div(){
        return true;
    }
endif;
add_filter( 'bt_newsletter_shortcode_inner_wrap_display', 'vandana_lite_add_inner_div' );

if( ! function_exists( 'vandana_lite_start_inner_div' ) ) :
    function vandana_lite_start_inner_div(){
        echo '<div class="container">';
    }
endif;
add_action( 'bt_newsletter_shortcode_inner_wrap_start', 'vandana_lite_start_inner_div' );

if( ! function_exists( 'vandana_lite_end_inner_div' ) ) :
    function vandana_lite_end_inner_div(){
        echo '</div>';
    }
endif;
add_action( 'bt_newsletter_shortcode_inner_wrap_close', 'vandana_lite_end_inner_div' );