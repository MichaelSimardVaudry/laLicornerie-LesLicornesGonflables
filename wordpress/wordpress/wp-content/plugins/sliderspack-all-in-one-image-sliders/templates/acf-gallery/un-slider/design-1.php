<?php
/**
 * Template for Un Slider ACF Gallery Design 1
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<li>
	<?php if( $fancy_box ) { ?>
		<a class="wp-spaios-img-link" href="<?php echo esc_url( $image ); ?>" data-fancybox="acf-gallery" data-options="<?php echo htmlspecialchars(json_encode( $fancy_conf )); ?>">
			<img class="wp-spaios-slider-image" src="<?php echo esc_url( $image ); ?>" alt="<?php echo wp_spaios_esc_attr( $alt_text ); ?>" title="<?php echo wp_spaios_esc_attr( $image_title ); ?>" />
		</a>
	<?php } else { ?>
		<img class="wp-spaios-slider-image" src="<?php echo esc_url( $image ); ?>" alt="<?php echo wp_spaios_esc_attr( $alt_text ); ?>" title="<?php echo wp_spaios_esc_attr( $image_title ); ?>" />
	<?php } ?>

	<?php if( $show_caption && $captions ) { ?>
		<div class="un-caption"><?php echo $captions; ?></div>
	<?php } ?>
</li>