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

            <img src="<?php the_field(''); ?>">
            <div class=''><?php the_field('titre') ; ?></div>
            <div class=''><?php the_field('description') ; ?></div>
</div>
</div>


<?php 


get_footer();

?>