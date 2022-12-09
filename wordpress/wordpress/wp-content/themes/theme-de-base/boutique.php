<?php 
/**
 * 	Template Name: Boutique
    Template Post Type: comestibles, jouets, bijoux, accessoires
 */

$jouets = new WP_Query('post_type=jouets');

get_header();
?>

<main>
    <div class='searchingBoutique'>
    <label>
      Age:
      <select name='Age:'>
        <option value="4">0 à 4 ans</option>
        <option value="8">5 à 8 ans</option>
        <option value="9">9 à 18 ans</option>
        <option value="adulte">Adultes</option>
      </select>
    </label>
    
    <label>
      Tier par:
      <select name='Trier par:'>
        <option value="default">Par défault</option>
        <option value="nouveautes">Nouveautés</option>
        <option value="croissant">Prix croissant</option>
        <option value="decroissant">Prix décroissant</option>
      </select>
    </label>
  </div>
    
    <div class='lesProduits'>
        <?php if ($jouets->have_posts()) : while($jouets->have_posts()) : $jouets->the_post(); ?>
      <div class='produit'>
        <img class='imgProduit'
          src='<?php the_field('image_produit') ; ?>'>
          <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
       </div>
     </div>
    endwhile; wp_reset_postdata(); 
</main>

<?php 
else : get_template_part( 'partials/404' ); 
endif;
get_footer();
?>
