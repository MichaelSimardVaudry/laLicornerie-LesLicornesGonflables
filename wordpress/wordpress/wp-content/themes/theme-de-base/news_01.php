<?php 
/**
 * 	Template Name: News
 */

get_header();
$news = array('post_type' => array('Nouvelle'));

?>
<div>
    <?php $query = new WP_Query($news);
        while($query->have_posts()) : $query->the_post(); ?>
    <h1><?php the_field('nom') ; ?></h1>
    <div><?php the_field('description') ; ?></div>

</div>
<?php
                    endwhile; 
                    wp_reset_postdata(); 
                ?>
<?php 


get_footer();

?>