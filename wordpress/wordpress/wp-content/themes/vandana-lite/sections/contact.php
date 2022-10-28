<?php
/**
 * Contact Section
 * 
 * @package Vandana_Lite
 */

$contact_title 		= get_theme_mod( 'contact_sec_title', __( 'Get in Touch Today', 'vandana-lite' ) );
$contact_subtitle 	= get_theme_mod( 'contact_subtitle', __( 'You can modify this section from Appearance > Customize > Front Page Settings > Contact Section.', 'vandana-lite' ) );

if( is_active_sidebar( 'contact' ) ){ ?>
<section id="contact_section" class="contact-section">
	<div class="container">
		<?php if( $contact_title || $contact_subtitle ) : ?>
			<div class="section-header">
				<?php if( $contact_title ) echo '<h2 class="section-title">' . esc_html( $contact_title ) . '</h2>'; ?>
				<?php if( $contact_subtitle ) echo '<div class="section-content">' . wpautop( wp_kses_post( $contact_subtitle ) ) . '</div>'; ?>
	    	</div>
	    <?php endif; ?>
    	<div class="section-grid">
    		<?php dynamic_sidebar( 'contact' ); ?>
    	</div>
	</div>
</section> <!-- .testimonial-section -->
<?php
}