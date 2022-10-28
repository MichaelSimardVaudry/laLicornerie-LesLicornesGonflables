<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Vandana_Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		
        <?php 
        /**
         * vandana_lite_page_header - 10
        */
        do_action( 'vandana_lite_before_posts_content' );
        ?>
        
        <main id="main" class="site-main">

		<?php
		if ( have_posts() ) : 
        
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
        
        <?php
        /**
         * After Posts hook
         * @hooked vandana_lite_navigation - 15
        */
        do_action( 'vandana_lite_after_posts_content' );
        ?>
        
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
