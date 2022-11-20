<?php
/**
 * Template for Flex Slider Post Design 1
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="flex-slide">
	<?php if( $fancy_box ) { ?>
		<a class="wp-spaios-img-link" href="<?php echo esc_url( $post_image ); ?>" data-fancybox="wordpress-post" data-options="<?php echo htmlspecialchars(json_encode( $fancy_conf )); ?>">
			<img class="wp-spaios-slider-image" src="<?php echo esc_url( $post_image ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
		</a>
	<?php } else { ?>
		<a class="wp-spaios-img-link" href="<?php echo esc_url( $post_link ); ?>" target="<?php echo wp_spaios_esc_attr( $link_target ); ?>">
			<img class="wp-spaios-slider-image" src="<?php echo esc_url( $post_image ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
		</a>
	<?php } ?>

	<?php if( $show_title || $show_content || $show_category ) { ?>
		<div class="wp-spaios-content-wrp">
			<?php if( $show_category ) { ?>
				<div class="wp-spaios-cat"><?php echo $cat_name; ?></div>
			<?php } ?>

			<?php if( $show_title ) { ?>
				<div class="wp-spaios-title">
					<a href="<?php echo esc_url( $post_link ); ?>" target="<?php echo wp_spaios_esc_attr( $link_target ); ?>"><?php echo $post_title; ?></a>
				</div>
			<?php } ?>

			<?php if( $show_content ) { ?>
				<div class="wp-spaios-content"><?php echo $post_content; ?></div>
			<?php } ?>

			<?php if( $show_readmore ) { ?>
				<a class="wp-spaios-readmore-btn" href="<?php echo esc_url( $post_link ); ?>" target="<?php echo wp_spaios_esc_attr( $link_target ); ?>"><?php echo $readmore_text; ?></a>
			<?php } ?>
		</div>
	<?php } ?>
</div><!-- end .bx-slide -->