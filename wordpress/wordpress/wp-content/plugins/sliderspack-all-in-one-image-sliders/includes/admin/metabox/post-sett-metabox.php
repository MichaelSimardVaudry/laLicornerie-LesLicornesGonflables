<?php
/**
 * Handles Post Setting metabox HTML
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
$check_post_gallery	= get_post_meta( $post->ID, $prefix.'check_post_gallery', true );
$check_post_gallery	= ! empty( $check_post_gallery ) ? $check_post_gallery : 'gallery';
$acf_field_name		= get_post_meta( $post->ID, $prefix.'acf_field_name', true );
$acf_field_name		= ! empty( $acf_field_name ) ? $acf_field_name : '';
$gallery_imgs		= get_post_meta( $post->ID, $prefix.'gallery_id', true );
$gallery_imgs		= ! empty( $gallery_imgs ) ? $gallery_imgs : '';
$include_category	= get_post_meta( $post->ID, $prefix.'include_category', true );
?>

<table class="form-table wp-spaios-tbl">
	<tbody>
		<tr>
			<th>
				<label><?php _e('Slider Type', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<?php if( class_exists('ACF') ) { ?>
					<label for="wp-spaios-type-acf">
						<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>check_post_gallery" value="acf-gallery" <?php checked('acf-gallery', $check_post_gallery); ?> class="wp-spaios-show-hide wp-spaios-type-acf" id="wp-spaios-type-acf" /><?php esc_html_e('ACF Gallery', 'sliderspack-all-in-one-image-sliders'); ?>
					</label>
				<?php } ?>
				<label for="wp-spaios-type-gallery">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>check_post_gallery" value="gallery" <?php checked('gallery', $check_post_gallery); ?> class="wp-spaios-show-hide wp-spaios-type-gallery" id="wp-spaios-type-gallery" /><?php esc_html_e('Gallery Image', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-type-post">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>check_post_gallery" value="post" <?php checked('post', $check_post_gallery); ?> class="wp-spaios-show-hide wp-spaios-type-post" id="wp-spaios-type-post" /><?php esc_html_e('WordPress Post', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Enable Gallery images, WordPress default posts.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		
		<!--Add Gallery Image-->
		<tr class="spaios-show-hide-row spaios-show-if-gallery" style="<?php if( $check_post_gallery != 'gallery' ) { echo 'display: none;'; } ?>">
			<th>
				<label for="wp-spaios-gallery-imgs"><?php _e('Choose Gallery Images', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<button type="button" class="button button-secondary wp-spaios-img-uploader" id="wp-spaios-gallery-imgs" data-multiple="true" data-button-text="<?php _e('Add to Gallery', 'sliderspack-all-in-one-image-sliders'); ?>" data-title="<?php _e('Add Images to Gallery', 'sliderspack-all-in-one-image-sliders'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php _e('Gallery Images', 'sliderspack-all-in-one-image-sliders'); ?></button>
				<button type="button" class="button button-secondary wp-spaios-del-gallery-imgs"><i class="dashicons dashicons-trash"></i> <?php _e('Remove Gallery Images', 'sliderspack-all-in-one-image-sliders'); ?></button><br/>
				
				<div class="wp-spaios-gallery-imgs-prev wp-spaios-imgs-preview wp-spaios-gallery-imgs-wrp">
					<?php if( ! empty( $gallery_imgs ) ) {
						foreach ($gallery_imgs as $img_key => $img_data) {

							$attachment_url 		= wp_get_attachment_thumb_url( $img_data );
							$attachment_edit_link	= get_edit_post_link( $img_data );
					?>
							<div class="wp-spaios-img-wrp">
								<div class="wp-spaios-hide wp-spaios-img-tools">
									<span class="wp-spaios-tool-icon wp-spaios-edit-img dashicons dashicons-edit" title="<?php esc_html_e('Edit Image in Popup', 'sliderspack-all-in-one-image-sliders'); ?>"></span>
									<a href="<?php echo $attachment_edit_link; ?>" target="_blank" title="<?php esc_html_e('Edit Image', 'sliderspack-all-in-one-image-sliders'); ?>"><span class="wp-spaios-tool-icon wp-spaios-edit-attachment dashicons dashicons-visibility"></span></a>
									<span class="wp-spaios-tool-icon wp-spaios-del-tool wp-spaios-del-img dashicons dashicons-no" title="<?php esc_html_e('Remove Image', 'sliderspack-all-in-one-image-sliders'); ?>"></span>
								</div>
								<img class="wp-spaios-img" src="<?php echo $attachment_url; ?>" alt="" />
								<input type="hidden" class="wp-spaios-attachment-no" name="wp_spaios_img[]" value="<?php echo $img_data; ?>" />
							</div><!-- end .wp-spaios-img-wrp -->
					<?php }
					} else { ?>
						<p class="wp-spaios-img-placeholder"><?php _e('No Gallery Images', 'sliderspack-all-in-one-image-sliders'); ?></p>
					<?php } ?>

				</div><!-- end .wp-spaios-imgs-preview -->
				<span class="description"><?php _e('Choose your desired images for gallery. Hold Ctrl key to select multiple images at a time.', 'sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>

		<!-- WordPress Post Sett - Start -->
		<tr class="spaios-show-hide-row spaios-show-if-post" style="<?php if( $check_post_gallery != 'post' ) { echo 'display: none;'; } ?>">
			<td colspan="2" class="wp-spaios-no-padding">
				<table class="form-table">
					<tbody>
						<tr>
							<th>
								<label for="select-post-type"><?php _e('Post Type', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<?php _e('WordPress Posts', 'sliderspack-all-in-one-image-sliders'); ?>
							</td>
						</tr>
						<tr>
							<th>
								<label for="wp-spaios-include-cat"><?php _e('Include Category', 'sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>include_category" value="<?php echo wp_spaios_esc_attr( $include_category ); ?>" class="wp-spaios-include-cat" id="wp-spaios-include-cat" /><br/>
								<span class="description"><?php _e( 'Enter category id to display categories wise.You can pass multiple ids with comma seperated.', 'sliderspack-all-in-one-image-sliders' ) ?></span>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<!-- WordPress Post Sett - End -->

		<!-- ACF Gallery Support - Start -->
		<tr class="spaios-show-hide-row spaios-show-if-acf-gallery" style="<?php if( $check_post_gallery != 'acf-gallery' ) { echo 'display: none;'; } ?>">
			<td colspan="2" class="wp-spaios-no-padding">
				<table class="form-table">
					<tbody>
						<tr>
							<th>
								<label for="wp-spaios-gallery-field"><?php _e('Gallery Type','sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<?php _e('ACF Gallery', 'sliderspack-all-in-one-image-sliders'); ?>				
							</td>
						</tr>
						<tr>
							<th>
								<label for="wp-spaios-gallery-field"><?php _e('ACF Field','sliderspack-all-in-one-image-sliders'); ?></label>
							</th>
							<td>
								<input type="text" name="<?php echo $prefix; ?>acf_field_name" value="<?php echo wp_spaios_esc_attr($acf_field_name); ?>"><br/>
								<span class="description"> <?php _e( 'Enter ACF Field to disply acf slider from the ACF. Ex: acf_images', 'sliderspack-all-in-one-image-sliders' ) ?></span>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<!-- ACF Gallery Support - End -->
	</tbody>
</table><!-- end .wp-spaios-tbl -->