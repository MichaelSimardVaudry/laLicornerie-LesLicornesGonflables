<?php 
/**
 * 	Template Name: News
 */

get_header();

?>

    <h1 class="nouvelles_titre">Nouvelles</h1>
    <div class="big_slider">
<?php xo_slider( 104 ); ?>
</div>
<style>
    .big_slider {
        margin-bottom:50px
    }

    .slide-content-title, .slide-content-subtitle {
    color:black;
    }
    
    .nouvelles_titre {
        margin-top:30px;
    }
</style>
<?php xo_slider( 107 ); ?>
<?php 


get_footer();

?>