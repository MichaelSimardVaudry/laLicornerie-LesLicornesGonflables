<?php 
/**
 * 	Template Name: Boutique
    Template Post Type: comestibles, jouets, bijoux, accessoires
 */

get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
 $produits = get_field('info_produit');
 $url = $produits['image_produit'];
 $prix = $produits['prix'];
 $nom = $produits['titre'];
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
      <div class='produit'>
        <img class='imgProduit'
          src='<?php echo $image_produit ; ?>'>
          <div class='nomProduit produitGeneralInfo'><?php echo $titre ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php echo $prix ; ?></div>
       </div>
     </div>
</main>

<?php 
endwhile; wp_reset_postdata(); 
else : get_template_part( 'partials/404' ); 
endif;
get_footer();

?>
