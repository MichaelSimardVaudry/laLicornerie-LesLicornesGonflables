<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vandana_Lite
 */
    
    /**
     * After Content
     * 
     * @hooked vandana_lite_content_end - 20
    */
    do_action( 'vandana_lite_before_footer' );
    
    /**
     * Before footer
     * 
     * @hooked vandana_lite_instagram     - 10
     * @hooked vandana_lite_newsletter    - 20
    */
    do_action( 'vandana_lite_before_footer_start' );

    /**
     * Footer
     *
     * @hooked vandana_lite_footer_start  - 20
     * @hooked vandana_lite_footer_top    - 30
     * @hooked vandana_lite_footer_bottom - 40
     * @hooked vandana_lite_back_to_top   - 45
     * @hooked vandana_lite_footer_end    - 50
    */
    do_action( 'vandana_lite_footer' );
    
    /**
     * After Footer
     * 
     * @hooked vandana_lite_page_end    - 20
    */
    do_action( 'vandana_lite_after_footer' );

    wp_footer(); ?>

</body>
</html>
