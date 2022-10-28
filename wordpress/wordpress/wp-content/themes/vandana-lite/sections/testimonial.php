<?php
/**
 * Testimonial Section
 * 
 * @package Vandana_Lite
 */

$testimonial_title 			= get_theme_mod( 'testimonial_title', __( 'Testimonials', 'vandana-lite' ) );
$testimonial_subtitle 		= get_theme_mod( 'testimonial_subtitle', __( 'Words of praise by my valuable clients.', 'vandana-lite' ) );
$testimonial_bg 			= get_theme_mod( 'testimonial_bg', esc_url( get_template_directory_uri() . '/images/flower-bg.png' ) );

if( is_active_sidebar( 'testimonial' ) ){ ?>
<section id="testimonial_section" class="testimonial-section style-one">
	<div class="container">
		<?php if( $testimonial_title || $testimonial_subtitle ) : ?>
			<div class="section-header">
				<?php if( $testimonial_title ) echo '<h2 class="section-title">' . esc_html( $testimonial_title ) . '</h2>'; ?>
				<?php if( $testimonial_subtitle ) echo '<div class="section-content">' . wp_kses_post( wpautop( $testimonial_subtitle ) ) . '</div>'; ?>
	    	</div>
	    <?php endif; ?>
    	<div class="section-grid" <?php if( $testimonial_bg ) { ?> style="background-image: url( '<?php echo esc_url( $testimonial_bg ); ?>' );" <?php } ?>>
			<div class="testimonial-wrap owl-carousel">
    			<?php dynamic_sidebar( 'testimonial' ); ?>
    		</div>
    	</div>
	</div>
</section> <!-- .testimonial-section -->
<?php
}