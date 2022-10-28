<?php
/**
 * CTA Section
 * 
 * @package Vandana_Lite
 */

if( is_active_sidebar( 'cta' ) ){ ?>
<section id="cta_section" class="cta-section style-one">
    <?php dynamic_sidebar( 'cta' ); ?>
</section> <!-- .bg-cta-section -->
<?php
}