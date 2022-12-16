<?php 
/**
 * 	Template Name: News
 */

get_header();
$news = array('post_type' => 'Nouvelle');
$last = array(
    'post_type' => 'news',
    'posts_per_page' => 1
    );

?>

<h1 class="nouvelles_titre">Nouvelles</h1>
<div class="container">
    Derriere nouvelle:
    <?php $query = new WP_Query($last);
        while($query->have_posts()) : $query->the_post(); ?>
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="<?php the_field('link'); ?>"><img src="<?php the_field('image'); ?>" class="img-fluid"></a>
        </div>
        <div class="col-7">
            <h3 class="card-title"><?php the_field('nom') ; ?></h3>
            <div class="card-body"><?php the_field('description') ; ?>
                </br><?php the_field('date') ; ?>
            </div>
            <?php  endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php $query = new WP_Query($news);
        while($query->have_posts()) : $query->the_post(); ?>
    <div class="card">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-3">
                <a href="<?php the_field('link'); ?>"><img src="<?php the_field('image'); ?>" class="img-fluid"></a>
            </div>
            <div class="col-7">
                <h3 class="card-title"><?php the_field('nom') ; ?></h3>
                <div class="card-body"><?php the_field('description') ; ?>
                    </br><?php the_field('date') ; ?>
                </div>

            </div>
        </div>
    </div>
</div>


<?php  endwhile; wp_reset_postdata(); ?>

<?php 


get_footer();

?>