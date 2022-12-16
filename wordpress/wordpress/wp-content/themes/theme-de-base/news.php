<?php 
/**
 * 	Template Name: News
 */

get_header();
$news = array('post_type' => 'Nouvelle');
$last = array(
    'post_type' => 'Nouvelle',
    'posts_per_page' => 1
    );

?>

<h1 class="nouvelles_titre">Nouvelles</h1>
<div class="container">
    <h5> Dernière nouvelle:</h5>
    <?php $query = new WP_Query($last);
        while($query->have_posts()) : $query->the_post(); ?>
    <div>
        <div class="row last_news">
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
    <?php  endwhile; wp_reset_postdata(); ?>
    <svg width="70vw" height="5" viewBox="0 0 1349 5" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 2.5H1346.5" stroke="#FD95E3" stroke-width="5" stroke-linecap="round" />
        <h5>Autres nouvelles:</h5>
        <?php $query = new WP_Query($news);
        while($query->have_posts()) : $query->the_post(); ?>
        <div class=" hover">
            <div class="row news">
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="<?php the_field('link'); ?>"><img src="<?php the_field('image'); ?>"
                            class="img-fluid news_img"></a>
                </div>
                <div class="col-7">
                    <h3 class="card-title"><?php the_field('nom') ; ?></h3>
                    <div class="card-body"><?php the_field('description') ; ?>
                        </br><?php the_field('date') ; ?>
                    </div>

                </div>
            </div>
        </div><?php  endwhile; wp_reset_postdata(); ?>
</div>




<?php 


get_footer();

?>