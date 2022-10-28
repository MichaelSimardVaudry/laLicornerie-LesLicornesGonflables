<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vandana_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); if( ! is_single() ) echo ' itemscope itemtype="https://schema.org/Blog"'; ?>>
	<?php 
        /**
         * @hooked vandana_lite_post_thumbnail - 10
        */
        do_action( 'vandana_lite_before_post_entry_content' );

        if( is_singular( 'post' ) ) vandana_lite_single_meta_header();
        
        echo '<div class="content-wrap">';
        
        /**
         * @hooked vandana_lite_entry_header   - 10 
         * @hooked vandana_lite_entry_content - 15
         * @hooked vandana_lite_entry_footer  - 20
        */
        do_action( 'vandana_lite_post_entry_content' );

        echo '</div>';
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
