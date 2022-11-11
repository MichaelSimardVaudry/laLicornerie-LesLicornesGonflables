<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap_photography
 */
$layout = get_theme_mod( 'bootstrap_photography_footer_layouts', 'one' );
?>

<footer id="colophon" class="site-footer footer-<?php 
echo  $layout ;
?>">
	<div class="container">
		<div class="footer-section">
			<?php 
for ( $i = 1 ;  $i < 5 ;  $i++ ) {
    ?>
				<div class="f-block">
					<?php 
    dynamic_sidebar( 'footer-' . $i . '' );
    ?>
				</div>
			<?php 
}
?>	
		</div>
		<div class="site-info">
			<?php 
?>
		         <?php 
esc_html_e( "Powered by", 'bootstrap-photography' );
?> <a href="<?php 
echo  esc_url( 'https://wordpress.org/' ) ;
?>"><?php 
esc_html_e( "WordPress", 'bootstrap-photography' );
?></a> | <a href="<?php 
echo  esc_url( 'https://thebootstrapthemes.com/' ) ;
?>" target="_blank"  rel="nofollow"><?php 
esc_html_e( 'Bootstrap Photography by The Bootstrap Themes', 'bootstrap-photography' );
?></a>
		      <?php 
?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php 
wp_footer();
?>

</body>
</html>
