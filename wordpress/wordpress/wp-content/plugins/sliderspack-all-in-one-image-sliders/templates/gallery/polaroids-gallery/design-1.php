<?php
/**
 * Template for Polaroids Gallery Slider Gallery Design 1
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<figure>
	<?php if( $fancy_box ) { ?>
		<a class="wp-spaios-img-link" href="<?php echo esc_url( $image[0] ); ?>" data-fancybox="gallery" data-options="<?php echo htmlspecialchars(json_encode( $fancy_conf )); ?>">
			<img class="wp-spaios-slider-image" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo wp_spaios_esc_attr( $alt_text ); ?>" title="<?php echo wp_spaios_esc_attr( $image_title ); ?>" />
		</a>
	<?php } elseif( ! empty( $img_link ) ) { ?>
		<a class="wp-spaios-img-link" href="<?php echo esc_url( $img_link ); ?>" target="<?php echo wp_spaios_esc_attr( $link_target ); ?>">
			<img class="wp-spaios-slider-image" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo wp_spaios_esc_attr( $alt_text ); ?>" title="<?php echo wp_spaios_esc_attr( $image_title ); ?>" />
		</a>
	<?php } else { ?>
		<img class="wp-spaios-slider-image" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo wp_spaios_esc_attr( $alt_text ); ?>" title="<?php echo wp_spaios_esc_attr( $captions ); ?>" />
	<?php } ?>

	<?php if( $show_caption && $captions ) { ?>
		<figcaption>
			<h2 class="photostack-title"><?php echo $captions; ?></h2>							
		</figcaption>
	<?php } ?>
</figure>