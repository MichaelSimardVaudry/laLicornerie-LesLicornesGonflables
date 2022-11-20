<?php
/**
 * Handles Un Slider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$mode_un		= get_post_meta( $post->ID, $prefix.'mode_un', true );
$height_auto_un	= get_post_meta( $post->ID, $prefix.'height_auto_un', true );
$height_auto_un	= ( $height_auto_un == 'true' )	? 'true' : 'false';
?>

<table class="form-table wp-spaios-tbl">
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('Un Slider Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-effect"><?php _e('Effect', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<select name="<?php echo wp_spaios_esc_attr( $prefix ); ?>mode_un" class="wp-spaios-select wp-spaios-slide-effect" id="wp-spaios-slide-effect">
					<?php if( ! empty( $un_effect_data ) ) {
						foreach ($un_effect_data as $un_effect_key => $un_effect_val) {
							echo '<option value="'.$un_effect_key.'" '.selected( $mode_un, $un_effect_key ).'>'.$un_effect_val.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select Effect for UnSlider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-autoheight"><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-ah-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_auto_un" value="true" <?php checked('true', $height_auto_un); ?> class="wp-spaios-ah-true" id="wp-spaios-ah-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-ah-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_auto_un" value="false" <?php checked('false', $height_auto_un); ?> class="wp-spaios-ah-false" id="wp-spaios-ah-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Set auto height true or false.','sliderspack-all-in-one-image-sliders'); ?></span><br/>
				<span class="description"><?php _e('<strong>Note:</strong> It will not work with fade effect.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>