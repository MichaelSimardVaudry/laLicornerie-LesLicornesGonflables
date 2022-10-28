<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vandana_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
        /**
         * Post Thumbnail
         * 
         * @hooked vandana_lite_post_thumbnail
        */
        do_action( 'vandana_lite_before_page_entry_content' );
    
        /**
         * Entry Content
         * 
         * @hooked vandana_lite_entry_content - 15
         * @hooked vandana_lite_entry_footer  - 20
        */
        do_action( 'vandana_lite_page_entry_content' );    
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
