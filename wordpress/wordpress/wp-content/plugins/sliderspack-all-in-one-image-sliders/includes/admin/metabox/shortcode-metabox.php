<?php
/**
 * Handles shortcode preview metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
?>

<p><?php _e('To display shortcode, add the following shortcode to your page or post.', 'sliderspack-all-in-one-image-sliders'); ?></p>
<div class="wp-spaios-shortcode-preview">[sliders_pack id="<?php echo $post->ID; ?>"]</div>

<p><?php _e('If adding the shortcode to your theme files, add the following template code.', 'sliderspack-all-in-one-image-sliders'); ?></p>
<div class="wp-spaios-shortcode-preview">&lt;?php echo do_shortcode('[sliders_pack id="<?php echo $post->ID; ?>"]'); ?&gt;</div>