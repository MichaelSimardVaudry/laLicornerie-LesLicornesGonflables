<?php 
/**
 * 	Template Name: Boutique
 */
get_header();

$arguments = array('post_type' => 'comestible','jouet','bijoux','accessoir');
$products = new WP_Query($arguments);
while($products->have_posts()) : $products->the_post();
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
get_footer();
?>
