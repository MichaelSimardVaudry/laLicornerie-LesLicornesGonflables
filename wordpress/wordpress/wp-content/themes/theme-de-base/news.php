<?php 
/**
 * 	Template Name: News
 */

get_header();
$news = array('post_type' => array('Nouvelle'));

?>

<h1 class="nouvelles_titre">Nouvelles</h1>
<div class="container">
    <?php $query = new WP_Query($news);
        while($query->have_posts()) : $query->the_post(); ?>

    <img src="<?php the_field('image') ; ?>">
    <div class=''><?php the_field('titre')?></div>
    <div class=''><?php the_field('description')?></div>
    <?php
                    endwhile; 
                    wp_reset_postdata(); 
                ?>
</div>
</div>


<?php 


get_footer();

?>