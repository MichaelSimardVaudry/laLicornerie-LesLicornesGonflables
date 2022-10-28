<?php
/**
 * Promotional Section
 * 
 * @package Vandana_Lite
 */
if( is_active_sidebar( 'promotional' ) ){ ?>
<section id="promotional_section" class="promo-section">
	<div class="container">
    	<?php dynamic_sidebar( 'promotional' ); ?>
    </div>
</section> <!-- .promo-section -->
<?php
}