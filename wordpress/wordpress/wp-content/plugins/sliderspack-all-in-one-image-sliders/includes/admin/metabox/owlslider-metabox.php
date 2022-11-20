<?php
/**
 * Handles Owl Carousel Slider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$slide_to_show_owl		= get_post_meta( $post->ID, $prefix.'slide_to_show_owl', true );
$slide_show_ipad_owl	= get_post_meta( $post->ID, $prefix.'slide_show_ipad_owl', true );
$slide_show_tablet_owl	= get_post_meta( $post->ID, $prefix.'slide_show_tablet_owl', true );
$slide_show_mobile_owl	= get_post_meta( $post->ID, $prefix.'slide_show_mobile_owl', true );
$slide_to_scroll_owl	= get_post_meta( $post->ID, $prefix.'slide_to_scroll_owl', true );
$slide_margin_owl		= get_post_meta( $post->ID, $prefix.'slide_margin_owl', true );
$slide_padding_owl		= get_post_meta( $post->ID, $prefix.'slide_padding_owl', true );
$start_slide_owl		= get_post_meta( $post->ID, $prefix.'start_slide_owl', true );
$slide_center_owl		= get_post_meta( $post->ID, $prefix.'slide_center_owl', true );
$slide_autowidth_owl	= get_post_meta( $post->ID, $prefix.'slide_autowidth_owl', true );
$height_auto_owl		= get_post_meta( $post->ID, $prefix.'height_auto_owl', true );
$slide_freeDrag_owl		= get_post_meta( $post->ID, $prefix.'slide_freeDrag_owl', true );
$slide_rtl_owl			= get_post_meta( $post->ID, $prefix.'slide_rtl_owl', true );
$slide_center_owl		= ( $slide_center_owl == 'true' )		? 'true' : 'false';
$slide_autowidth_owl	= ( $slide_autowidth_owl == 'true' )	? 'true' : 'false';
$height_auto_owl		= ( $height_auto_owl == 'true' )		? 'true' : 'false';
$slide_freeDrag_owl		= ( $slide_freeDrag_owl == 'true' )		? 'true' : 'false';
$slide_rtl_owl			= ( $slide_rtl_owl == 'true' )			? 'true' : 'false';
?>

<table class="form-table wp-spaios-tbl">			
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('OWL Carousel Slider Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-slide-shown"><?php _e('Slide To Show', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_show_owl" value="<?php echo wp_spaios_esc_attr( $slide_to_show_owl ); ?>" class="wp-spaios-slide-shown" id="wp-spaios-slide-shown" /><br/>
				<span class="description"><?php _e('The number of slides to be shown.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-ipad-slide"><?php _e('Slide To Show in iPad', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_show_ipad_owl" value="<?php echo wp_spaios_esc_attr( $slide_show_ipad_owl ); ?>" class="wp-spaios-ipad-slide" id="wp-spaios-ipad-slide" /><br/>
				<span class="description"><?php _e('Number of slides per view in iPad.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-tablet-slide"><?php _e('Slide To Show in Tablet', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_show_tablet_owl" value="<?php echo wp_spaios_esc_attr( $slide_show_tablet_owl ); ?>" class="wp-spaios-tablet-slide" id="wp-spaios-tablet-slide" /><br/>
				<span class="description"><?php _e('Number of slides per view in Tablet.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>					
			<th>
				<label for="wp-spaios-mobile-slide"><?php _e('Slide To Show in Mobile', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_show_mobile_owl" value="<?php echo wp_spaios_esc_attr( $slide_show_mobile_owl ); ?>" class="wp-spaios-mobile-slide" id="wp-spaios-mobile-slide" /><br/>
				<span class="description"><?php _e('Number of slides per view in Mobile.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-scroll"><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_to_scroll_owl" value="<?php echo wp_spaios_esc_attr( $slide_to_scroll_owl ); ?>" class="wp-spaios-slide-scroll" id="wp-spaios-slide-scroll" /><br/>
				<span class="description"><?php _e('Set slide to scroll at a time. Useful to use with "Number of Slides to be Shown" > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-margin"><?php _e('Slide margin', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_margin_owl" value="<?php echo wp_spaios_esc_attr( $slide_margin_owl ); ?>" class="wp-spaios-slide-margin" id="wp-spaios-slide-margin" /><br/>
				<span class="description"><?php _e('Margin between each slide. eg. 5','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-padding"><?php _e('Left - Right Padding', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_padding_owl" value="<?php echo wp_spaios_esc_attr( $slide_padding_owl ); ?>" class="wp-spaios-slide-padding" id="wp-spaios-slide-padding" /><br/>
				<span class="description"><?php _e('padding from left and right for slider. eg. 30','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-slide-start"><?php _e('Start Slide', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>start_slide_owl" value="<?php echo wp_spaios_esc_attr( $start_slide_owl ); ?>" class="wp-spaios-slide-start" id="wp-spaios-slide-start" /><br/>
				<span class="description"><?php _e('Starting slide index. eg. 3','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-center-mode"><?php _e('Center Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-center-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_center_owl" value="true" <?php checked('true', $slide_center_owl); ?> class="wp-spaios-center-true" id="wp-spaios-center-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-center-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_center_owl" value="false" <?php checked('false', $slide_center_owl); ?> class="wp-spaios-center-false" id="wp-spaios-center-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Enable center mode for slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-width"><?php _e('Auto Width Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-width-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_autowidth_owl" value="true" <?php checked('true', $slide_autowidth_owl); ?> class="wp-spaios-width-true" id="wp-spaios-width-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-width-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_autowidth_owl" value="false" <?php checked('false', $slide_autowidth_owl); ?> class="wp-spaios-width-false" id="wp-spaios-width-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Enable autowidth mode for slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>				
		<tr>
			<th>
				<label for="wp-spaios-height"><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-height-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_auto_owl" value="true" <?php checked('true', $height_auto_owl); ?> class="wp-spaios-height-true" id="wp-spaios-height-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-height-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>height_auto_owl" value="false" <?php checked('false', $height_auto_owl); ?> class="wp-spaios-height-false" id="wp-spaios-height-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Allow height of the slider to animate smoothly.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-drag"><?php _e('Enable Free Drag Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-drag-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_freeDrag_owl" value="true" <?php checked('true', $slide_freeDrag_owl); ?> class="wp-spaios-drag-true" id="wp-spaios-drag-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-drag-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_freeDrag_owl" value="false" <?php checked('false', $slide_freeDrag_owl); ?> class="wp-spaios-drag-false" id="wp-spaios-drag-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Enable free drag mode for slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-rtl"><?php _e('RTL', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-rtl-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_rtl_owl" value="true" <?php checked('true', $slide_rtl_owl); ?> class="wp-spaios-rtl-true" id="wp-spaios-rtl-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-rtl-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_rtl_owl" value="false" <?php checked('false', $slide_rtl_owl); ?> class="wp-spaios-rtl-false" id="wp-spaios-rtl-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Include RTL for RTL website','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>