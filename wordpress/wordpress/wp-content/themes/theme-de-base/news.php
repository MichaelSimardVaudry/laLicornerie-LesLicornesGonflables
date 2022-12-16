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

<div class="card">
  <div class="row">
    <div class="col-5">
    <a href="<?php the_field('link'); ?>"><img src="<?php the_field('image'); ?>" class="img-fluid"></a>
    </div>
    <div class="col-7">
    <h3 class="card-title"><?php the_field('nom') ; ?></h3>
      <div class="card-body"><?php the_field('description') ; ?></div>
    </div>
  </div>
</div>
            

<?php  endwhile; wp_reset_postdata(); ?>

<?php 


get_footer();

?>