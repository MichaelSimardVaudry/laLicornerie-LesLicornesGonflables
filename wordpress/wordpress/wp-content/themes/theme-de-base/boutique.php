<?php 
/**
 * 	Template Name: Boutique
 */
get_header();

$products = array('post_type' => array('jouet', 'bijoux', 'accessoir', 'comestible'));

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
    
    <article class='lesProduits'>
        <?php $query = new WP_Query($products);
        while($query->have_posts()) : $query->the_post(); ?>
        <div class='produit'>
            <img class='imgProduit' src='<?php the_field('image_produit') ; ?>'>
            <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
            <button type="button" class='boutiqueBouton'>Ajouter au Panier</button>
        </div>
        <?php  endwhile; wp_reset_postdata(); ?>
    </article>
</main>

<?php get_footer(); ?>
