<?php 
/**
 * 	Template Name: Boutique
 */
get_header();

$arguments = array('post_type' => 'comestible');
$arguments2 = array('post_type' => 'jouet');
$arguments3 = array('post_type' => 'bijoux');
$arguments4 = array('post_type' => 'accessoir');

$products = new WP_Query($arguments);
while($products->have_posts()) : $products->the_post();
$products2 = new WP_Query($arguments2);
while($products2->have_posts()) : $products2->the_post();
$products3 = new WP_Query($arguments3);
while($products3->have_posts()) : $products3->the_post();
$products4 = new WP_Query($arguments4);
while($products4->have_posts()) : $products4->the_post();
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
