<?php 
/**
 * 	Template Name: Boutique
 *  Template Post Type: comestible, jouet, bijoux, accessoir
 */

$jouet = new WP_Query('post_type=jouet');

get_header();
?>

<main>
    <article class='lesProduits'>
        <?php if ($jouet->have_posts()) : while($jouet->have_posts()) : $jouet->the_post(); ?>
      <div class='produit'>
        <img class='imgProduit'
          src='<?php the_field('image_produit') ; ?>'>
          <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
       </div>
         endwhile; wp_reset_postdata(); 
     </article>
</main>

<?php 
else : get_template_part( 'partials/404' ); 
endif;
get_footer();
?>
