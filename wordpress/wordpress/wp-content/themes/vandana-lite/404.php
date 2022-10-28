<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * 
 * @package Vandana_Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<div class="page-content">
					<div class="error-num"><?php esc_html_e( '404', 'vandana-lite' ); ?></div>
                    <h4><?php esc_html_e( 'Something Missing', 'vandana-lite' ); ?></h4>
					<p class="error-text"><?php esc_html_e( 'The Page You Are Looking For May Have Been Moved, Deleted, Or Possibly Never Existed.', 'vandana-lite' ); ?></p>
					<a class="btn-readmore" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to Homepage', 'vandana-lite' ); ?></a>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
		<?php
			/**
			 * @see vandana_lite_latest_posts
			*/
			do_action( 'vandana_lite_latest_posts' );
		?>
	</div><!-- #primary -->
    
    <?php
    
get_footer();