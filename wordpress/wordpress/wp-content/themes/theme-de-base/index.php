<?php
/**
 * Modèle générique au cas où Wordpress ne trouve pas un modèle
 * À utiliser comme fallback seulement.
 */

get_header(); // Affiche header.php
$comestible = new WP_Query('post_type=comestible');
$jouet = new WP_Query('post_type=jouet');
$bijoux = new WP_Query('post_type=bijoux');
$accessoir = new WP_Query('post_type=accessoir');
$Nouvelle = new WP_Query('post_type=Nouvelle');

// Est-ce que nous avons des posts qui correspondent à notre requête ?
// Dans le cas de la page d'accueil, les billets les plus récents serons affichés
?>
<main>
    <section class="main-hero">

        <h1>La Licornerie</h1>
        </div>
        </div>
        <?php xo_slider( 44 ); ?>
    </section>

    <section class="main-categorie">

        <H2>Magasinez Par Catégories</H2>
        </div>
        <a>
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <img class="catego-1"
                            src="http://localhost/laLicornerie-LesLicornesGonflables/medias/boutique/9-Emma_licorne_sorbet.jpg"
                            alt="">
                        <p>Jouets</p>
                    </div>
                    <div class="col-3">
                        <img class="catego-1"
                            src="http://localhost/laLicornerie-LesLicornesGonflables/medias/boutique/9-Emma_licorne_sorbet.jpg"
                            alt="">
                        <p>Bijoux</p>
                    </div>
                    <div class="col-3">
                        <img class="catego-1"
                            src="http://localhost/laLicornerie-LesLicornesGonflables/medias/boutique/9-Emma_licorne_sorbet.jpg"
                            alt="">
                        <p>Accessoires</p>
                    </div>
                    <div class="col-3">
                        <img class="catego-1"
                            src="http://localhost/laLicornerie-LesLicornesGonflables/medias/boutique/9-Emma_licorne_sorbet.jpg"
                            alt="">
                        <p>Comestibles</p>
                    </div>
                </div>
            </div>
        </a>

    </section>
    <section class="main-vedette">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <H2>Produits Vedettes</H2>
                </div>
            </div>
            <div class="row">
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php the_field('image_produit'); ?>" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title"><?php the_field('titre'); ?></h5>
                            <p class="card-text"><?php the_field('description'); ?></p>
                            <a href="#" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../../medias/boutique/9-Emma_licorne_sorbet.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="article" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../../medias/boutique/2-laurie_licorne.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="#" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../../medias/boutique/12-thermos.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="#" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../../medias/boutique/1-sirop_licorne.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="article" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../../medias/boutique/15-meowchi.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="#" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="main-temoignage">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="col-5">
                            <img src="../../medias/image_fake_humain.png" class="img-fluid">
                        </div>
                        <div class="col-7">
                            <h5 class="card-title">Brendon Chad</h5>
                            <div class="card-body">Wow vraiment magique!</div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="col-5">
                            <img src="../../medias/image_fake_humain.png" class="img-fluid">
                        </div>
                        <div class="col-7">
                            <h5 class="card-title">Brendon Chad</h5>
                            <div class="card-body">Wow vraiment magique!</div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="col-5">
                            <img src="../../medias/image_fake_humain.png" class="img-fluid">
                        </div>
                        <div class="col-7">
                            <h5 class="card-title">Brendon Chad</h5>
                            <div class="card-body">Wow vraiment magique!</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<?
get_footer(); // Affiche footer.php 
?>