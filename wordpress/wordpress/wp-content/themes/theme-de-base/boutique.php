<?php 
/**
 * 	Template Name: Boutique
 */

get_header();

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

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
          <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
            <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

      <div class='produit'>
        <img class='imgProduit'
          src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
          <div class='nomProduit produitGeneralInfo'>Item numero 1</div>
          <div class='prixProduit produitGeneralInfo'>Prix</div>
      </div>

    </div>
</main>

<?php 
endwhile; wp_reset_postdata(); 
else : get_template_part( 'partials/404' ); 
endif;
get_footer();

?>
