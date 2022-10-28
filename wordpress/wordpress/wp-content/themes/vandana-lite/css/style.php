<?php
/**
 * Vandana Lite Dynamic Styles
 * 
 * @package Vandana_Lite
*/

function vandana_lite_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Nunito Sans' );
    $primary_fonts   = vandana_lite_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Halant' );
    $secondary_fonts = vandana_lite_get_fonts( $secondary_font, 'regular' );
    $font_size       = get_theme_mod( 'font_size', 18 );
    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Halant', 'variant'=>'700' ) );
    $site_title_fonts     = vandana_lite_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 30 );
    
    $site_title_color = get_theme_mod( 'site_title_color', '#111111' );
    $site_logo_size   = get_theme_mod( 'site_logo_size', 70 );

    $cta_bg = get_theme_mod( 'cta_bg', esc_url( get_template_directory_uri() . '/images/flower-bg.png' ) );
    $blog_bg = get_theme_mod( 'blog_bg', esc_url( get_template_directory_uri() . '/images/blog-section-flower-bg.png' ) );

    $wheeloflife_color = get_theme_mod( 'wheeloflife_color', '#fef3f2' );
     
    echo "<style type='text/css' media='all'>"; ?>
     
    section.cta-section.style-one .widget .blossomtheme-cta-container {
        background-image: url('<?php echo $cta_bg; ?>');
    }
    section.blog-section.style-two::after {
        background-image: url('<?php echo $blog_bg; ?>');
    }
    
    /*Typography*/

	:root {
		--primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>;
		--secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>;
	}

    body,
    button,
    input,
    select,
    optgroup,
    textarea{
        font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
        font-size   : <?php echo absint( $font_size ); ?>px;        
    }
    
    .site-branding .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }
    
    .site-branding .site-title a{
		color: <?php echo vandana_lite_sanitize_hex_color( $site_title_color ); ?>;
	}
    
    .custom-logo-link img{
	    width: <?php echo absint( $site_logo_size ); ?>px;
	    max-width: 100%;
	}

    section#wheeloflife_section {
        background-color: <?php echo vandana_lite_sanitize_hex_color( $wheeloflife_color ); ?>;
    }
           
    <?php echo "</style>";
}
add_action( 'wp_head', 'vandana_lite_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function vandana_lite_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function vandana_lite_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/**
 * Convert '#' to '%23'
*/
function vandana_lite_hash_to_percent23( $color_code ){
    $color_code = str_replace( "#", "%23", $color_code );
    return $color_code;
}