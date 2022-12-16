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
        
    </article>
</main>

<?php get_footer(); ?>
