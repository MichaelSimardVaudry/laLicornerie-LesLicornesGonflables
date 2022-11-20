<?php
/**
 * Handles WP Post Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variable
$slide_ptype_limit			= get_post_meta( $post->ID, $prefix.'slide_ptype_limit', true );
$slide_ptype_title			= get_post_meta( $post->ID, $prefix.'slide_ptype_title', true );
$slide_ptype_content		= get_post_meta( $post->ID, $prefix.'slide_ptype_content', true );
$slide_ptype_readmorebtn	= get_post_meta( $post->ID, $prefix.'slide_ptype_readmorebtn', true );
$content_readmore_text		= get_post_meta( $post->ID, $prefix.'content_readmore_text', true );
$slide_ptype_cat_name		= get_post_meta( $post->ID, $prefix.'slide_ptype_cat_name', true );
$content_word_limit			= get_post_meta( $post->ID, $prefix.'content_word_limit', true );
$slide_ptype_limit			= ! empty( $slide_ptype_limit )				? $slide_ptype_limit	: 20;
$content_word_limit			= ! empty( $content_word_limit )			? $content_word_limit	: 20;
$content_readmore_text		= ! empty( $content_readmore_text )			? $content_readmore_text	: __('Read More', 'sliderspack-all-in-one-image-sliders');
$slide_ptype_title			= ( $slide_ptype_title == 'false' )			? 'false' : 'true';
$slide_ptype_content		= ( $slide_ptype_content == 'false' )		? 'false' : 'true';
$slide_ptype_readmorebtn	= ( $slide_ptype_readmorebtn == 'false' )	? 'false' : 'true';
$slide_ptype_cat_name		= ( $slide_ptype_cat_name == 'false' )		? 'false' : 'true';
?>

<table class="form-table wp-spaios-tbl wp-spaios-wp-post-metabox">
	<tbody>
		<tr>
			<th colspan="2">
				<div class="wp-spaios-title-sett"><?php _e('WordPress Post Parameters', 'sliderspack-all-in-one-image-sliders') ?></div>
			</th>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-limit"><?php _e('Limit', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_limit" value="<?php echo wp_spaios_esc_attr( $slide_ptype_limit ); ?>" class="wp-spaios-limit" id="wp-spaios-limit" /><br/>
				<span class="description"><?php _e('Enter slider post limit.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-cat-name"><?php _e('Show Category Name', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-cat-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_cat_name" value="true" <?php checked('true', $slide_ptype_cat_name); ?> class="wp-spaios-cat-true" id="wp-spaios-cat-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-cat-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_cat_name" value="false" <?php checked('false', $slide_ptype_cat_name); ?> class="wp-spaios-cat-false" id="wp-spaios-cat-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Display slider category name.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-post-title"><?php _e('Show Post Title', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-title-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_title" value="true" <?php checked('true', $slide_ptype_title); ?> class="wp-spaios-title-true" id="wp-spaios-title-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-title-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_title" value="false" <?php checked('false', $slide_ptype_title); ?> class="wp-spaios-title-false" id="wp-spaios-title-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Display slider post title.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-post-content"><?php _e('Show Post Content', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-cont-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_content" value="true" <?php checked('true', $slide_ptype_content); ?> class="wp-spaios-cont-true" id="wp-spaios-cont-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-cont-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_content" value="false" <?php checked('false', $slide_ptype_content); ?> class="wp-spaios-cont-false" id="wp-spaios-cont-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Display slider post content.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-readmore"><?php _e('Read More', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<label for="wp-spaios-rm-true">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_readmorebtn" value="true" <?php checked('true', $slide_ptype_readmorebtn); ?> class="wp-spaios-rm-true" id="wp-spaios-rm-true" /><?php esc_html_e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				</label>
				<label for="wp-spaios-rm-false">
					<input type="radio" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>slide_ptype_readmorebtn" value="false" <?php checked('false', $slide_ptype_readmorebtn); ?> class="wp-spaios-rm-false" id="wp-spaios-rm-false" /><?php esc_html_e('False', 'sliderspack-all-in-one-image-sliders'); ?>
				</label><br/>
				<span class="description"><?php _e('Display read more button.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-rm-text"><?php _e('Display Read More Text', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>content_readmore_text" value="<?php echo wp_spaios_esc_attr( $content_readmore_text ); ?>" class="wp-spaios-rm-text" id="wp-spaios-rm-text" /><br/>
				<span class="description"><?php _e('Enter read more button text.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature">
			<th>
				<label for="wp-spaios-author"><?php _e('Show Author', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" checked disabled><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" disabled><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Display slider author name.','sliderspack-all-in-one-image-sliders'); ?></span>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
		<tr class="wp-spaios-pro-feature">
			<th>
				<label for="wp-spaios-date"><?php _e('Show Date', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="radio" checked disabled><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" disabled><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Display slider date.','sliderspack-all-in-one-image-sliders'); ?></span>
				<?php echo sprintf( __( 'Upgrade to <a href="%s" target="_blank">Premium Version</a> to get this option.', 'sliderspack-all-in-one-image-sliders'), WP_APAIOIS_PLUGIN_LINK); ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp-spaios-word-limit"><?php _e('Post Content Word Limit', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo wp_spaios_esc_attr( $prefix ); ?>content_word_limit" value="<?php echo wp_spaios_esc_attr( $content_word_limit ); ?>" class="wp-spaios-word-limit" id="wp-spaios-word-limit" /><br/>
				<span class="description"><?php _e('Display post content word limit.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .wp-spaios-wp-post-metabox -->