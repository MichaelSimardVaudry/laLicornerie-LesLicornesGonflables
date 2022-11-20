<?php
/**
 * Handles Nivo Slider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$effect_nivo		= get_post_meta( $post->ID, $prefix.'effect_nivo', true );
$width_nivo			= get_post_meta( $post->ID, $prefix.'width_nivo', true );
$start_nivo			= get_post_meta( $post->ID, $prefix.'start_nivo', true );
$pauseon_over_nivo	= get_post_meta( $post->ID, $prefix.'pauseon_over_nivo', true );
$random_start_nivo	= get_post_meta( $post->ID, $prefix.'random_start_nivo', true );
$random_start_nivo	= ( $random_start_nivo == 'true' )	? 'true' 	: 'false';
$pauseon_over_nivo	= ( $pauseon_over_nivo == 'false' )	? 'false'	: 'true';
?>

<table class="form-table wp-spaios-tbl">
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('Nivo Slider Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-effect"><?php _e('Effect', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="<?php echo wp_spaios_esc_attr( $prefix ); ?>effect_nivo" class="wp-spaios-select wp-spaios-effect" id="wp-spaios-effect">
					<?php if( ! empty($nivo_effect_data) ) {
						foreach ($nivo_effect_data as $nivo_effect_key => $nivo_effect_val) { ?>
							<option value="<?php echo wp_spaios_esc_attr( $nivo_effect_key ); ?>" <?php selected($effect_nivo, $nivo_effect_key); ?>><?php echo $nivo_effect_val; ?></option>
						<?php }
					} ?>
				</select><br/>
				<span class="description"><?php _e('Select slider effect.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-width"><?php _e('Width', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>width_nivo" value="<?php echo wp_spaios_esc_attr( $width_nivo ); ?>" class="wp-spaios-width" id="wp-spaios-width" /> px<br/>
				<span class="description"><?php _e('Set slider width. Ex: 400.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-start"><?php _e('Start Slide', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>start_nivo" value="<?php echo wp_spaios_esc_attr( $start_nivo ); ?>" class="wp-spaios-slide-start" id="wp-spaios-slide-start" /><br/>
				<span class="description"><?php _e('Set Starting slide index (zero-based). Ex: 3.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-random"><?php _e('Random Start', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-random-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>random_start_nivo" value="true" <?php checked('true', $random_start_nivo); ?> class="wp-spaios-random-true" id="wp-spaios-random-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-random-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>random_start_nivo" value="false" <?php checked('false', $random_start_nivo); ?> class="wp-spaios-random-false" id="wp-spaios-random-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Start slider on a random slide.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-pause-hover"><?php _e('Pause on Hover', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-pause-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>pauseon_over_nivo" value="true" <?php checked('true', $pauseon_over_nivo); ?> class="wp-spaios-pause-true" id="wp-spaios-pause-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-pause-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>pauseon_over_nivo" value="false" <?php checked('false', $pauseon_over_nivo); ?> class="wp-spaios-pause-false" id="wp-spaios-pause-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Slider will pause when mouse hovers over slider.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>