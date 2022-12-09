<?php 
/**
 * 	Template Name: Boutique
 *  Template Post Type: comestible, jouet, bijoux, accessoir
 */
get_header();

$arguments = array('post_type' => 'comestible','jouet','bijoux','accessoir');
$comestible = new WP_Query($arguments);
while($comestible->have_posts()) : $comestible->the_post();
?>

<main>
    <article class='lesProduits'>
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
