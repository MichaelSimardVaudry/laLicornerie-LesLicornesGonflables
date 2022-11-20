<?php
/**
 * Handles Fancybox Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<table class="form-table wp-spaios-tbl">
	<tbody>
		<tr>
			<th>
				<label for="wp-spaios-animation"><?php _e('Show Image Title', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" name="" value="" data-prefix="" checked="checked"> <?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="" value="" data-prefix=""> <?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Enable Image Title on Fancy Box.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>		
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-animation"><?php _e('Open/close Animation Effects', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="" class="wp-spaios-select wp-spaios-animation" disabled>
					<option selected="selected"><?php esc_html_e('Zoom','sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php esc_html_e('Fade','sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php esc_html_e('Zoom-in-Out','sliderspack-all-in-one-image-sliders'); ?></option>
				</select><br/>
				<span class="description"><?php _e('Select animation for fancybox.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>		
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-effect"><?php _e('Slide Transition Effects', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="" class="wp-spaios-select wp-spaios-slide-effect" disabled>
					<option selected="selected"><?php _e('Fade','sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php esc_html_e('Slide','sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php esc_html_e('Circular','sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php esc_html_e('Tube','sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php esc_html_e('Zoom-In-Out','sliderspack-all-in-one-image-sliders'); ?></option>
					<option><?php esc_html_e('Rotate','sliderspack-all-in-one-image-sliders'); ?></option>
				</select> <br/>
				<span class="description"><?php _e('Select Slide Transition Effects.','sliderspack-all-in-one-image-sliders'); ?></span><br /><br />
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
	</tbody>
</table>