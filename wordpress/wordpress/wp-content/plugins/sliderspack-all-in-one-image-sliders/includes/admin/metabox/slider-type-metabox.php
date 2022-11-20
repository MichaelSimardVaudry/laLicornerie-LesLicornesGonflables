<?php
/**
 * Handles Slider Type & Design Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

// Taking some variable
$prefix				= WP_APAIOIS_META_PREFIX;
$slider_type_arr	= wp_spaios_slider_type();
$slider_type		= get_post_meta( $post->ID, $prefix.'slider_type', true );
?>

<table class="form-table wp-spaios-tbl">
	<tbody>		
		<tr>
			<th>
				<label for="wp-spaios-slider-type"><?php _e('Select Slider', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slider_type" class="wp-spaios-show-hide wp-spaios-select" id="wp-spaios-slider-type" data-prefix="type">
					<?php if( ! empty( $slider_type_arr ) ) {
						foreach ($slider_type_arr as $slider_type_key => $slider_type_val) { ?>
							<option value="<?php echo wp_spaios_esc_attr( $slider_type_key ); ?>" <?php selected($slider_type, $slider_type_key); ?>><?php echo $slider_type_val; ?></option>
						<?php }
					} ?>
				</select><br/>
				<span class="description"><?php _e('SlidersPack - 10 type of sliders. Select any one out of 10 that you like and want to use on your WordPress website :)', 'sliderspack-all-in-one-image-sliders'); ?></span>
			</td>			
		</tr>
		<tr class="wp-spaios-design-select wp-spaios-pro-feature" style="<?php if($slider_type == 'nivo-slider' || $slider_type == 'polaroids-gallery') { echo 'display: none;'; } ?>">
			<th>
				<label for="design-type"><?php _e('Select Design', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="" class="wp-spaios-select" disabled></select><br/>
				<span class="description"><?php _e('Select design - 20 type of designs. Select any one out of 20 that you like and want to use on your WordPress website :)', 'sliderspack-all-in-one-image-sliders'); ?></span> <br />
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>			
		</tr>
	</tbody>
</table><!-- end .wp-spaios-tbl -->