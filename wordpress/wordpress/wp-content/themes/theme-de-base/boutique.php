<?php 
/**
 * 	Template Name: Boutique
 */
get_header();

$products = array('post_type' => array('jouet', 'bijoux', 'accessoir', 'comestible'));
$jouets = array('post_type' => array('jouet'));
$bijoux = array('post_type' => array('bijoux'));
$accessoires = array('post_type' => array('accessoir'));
$comestibles = array('post_type' => array('comestible'));

?>

<main>
  <div class='searchingBoutique'>
    <label>
      Catégories:
      <select name='category' id='boutiqueCategory'>
        <option value="default">Par défault</option>
        <option value="toy">Jouets</option>
        <option value="jewlery">Bijoux</option>
        <option value="other">Accessoires</option>
        <option value="food">Comestible</option>
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
