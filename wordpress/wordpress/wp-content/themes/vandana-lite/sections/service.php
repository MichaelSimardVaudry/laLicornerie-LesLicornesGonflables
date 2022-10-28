<?php
/**
 * Services Section
 * 
 * @package Vandana_Lite
 */

$service_label  = get_theme_mod( 'service_label', __( 'View All', 'vandana-lite' ) );
$service_url 	= get_theme_mod( 'service_url', '#' );

if( is_active_sidebar( 'service' ) ){ ?>
<section id="service_section" class="service-section style-one">
	<div class="container">
		<div class="section-grid">
    		<?php dynamic_sidebar( 'service' ); ?>
    	</div>
    	<?php if( $service_label && $service_url ){ ?>
            <div class="button-wrap">
    			<a href="<?php echo esc_url( $service_url ); ?>" class="btn-readmore"><?php echo esc_html( $service_label ); ?></a>
    		</div>
        <?php } ?>
    </div>
</section> <!-- .service-section -->
<?php
}