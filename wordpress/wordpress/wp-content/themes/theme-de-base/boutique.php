<?php 
/**
 * 	Template Name: Boutique
 */
get_header();

$products = array('post_type' => array('jouet', 'bijoux', 'accessoir', 'comestible');

$query = new WP_Query($products);
while($query->have_posts()) : $query->the_post();
?>

<main>
    <article class='lesProduits'>
      <div class='produit'>
        <img class='imgProduit'
          src='<?php the_field('image_produit') ; ?>'>
          <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
       </div>
        <?php  endwhile; wp_reset_postdata(); ?>
     </article>
</main>

<div>
<?php get_footer();?></div>
