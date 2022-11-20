<?php
/**
 * Handles Wallop Slider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$mode_wallop = get_post_meta( $post->ID, $prefix.'mode_wallop', true );
?>

<table class="form-table wp-spaios-tbl">
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('Wallop Slider Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-effect"><?php _e('Effect', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="<?php echo wp_spaios_esc_attr( $prefix ); ?>mode_wallop" class="wp-spaios-select wp-spaios-slide-effect" id="wp-spaios-slide-effect">
					<?php if( ! empty( $wallop_mode_data ) ) {
						foreach ($wallop_mode_data as $wallop_mode_key => $wallop_mode_val) { ?>
							<option value="<?php echo wp_spaios_esc_attr( $wallop_mode_key ); ?>" <?php selected($mode_wallop, $wallop_mode_key); ?>><?php echo $wallop_mode_val; ?></option>
						<?php }
					} ?>
				</select><br/>
				<span class="description"><?php _e('Select Effect','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>			
		</tr>
	</tbody>
</table>