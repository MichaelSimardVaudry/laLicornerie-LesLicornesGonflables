<?php 
/**
 * 	Template Name: Boutique
 */
get_header();

$food = array('post_type' => 'comestible');
$toy = array('post_type' => 'jouet');
$jewlery = array('post_type' => 'bijoux');
$other = array('post_type' => 'accessoir');

$products = new WP_Query($food, $toy, $jewlery, $other);
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
        <?php  endwhile; wp_reset_postdata(); ?>
     </article>
</main>

<div>
<?php get_footer();?></div>
