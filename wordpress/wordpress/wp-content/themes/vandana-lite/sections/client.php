<?php
/**
 * Clients Section
 * 
 * @package Vandana_Lite
 */
if( is_active_sidebar( 'client' ) ){ ?>
<section id="clients_section" class="client-section">
	<div class="container">
    	<?php dynamic_sidebar( 'client' ); ?>
    </div>
</section> <!-- .client-section -->
<?php
}