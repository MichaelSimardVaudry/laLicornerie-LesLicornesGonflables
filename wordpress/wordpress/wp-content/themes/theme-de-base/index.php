<?php
/**
 * Modèle générique au cas où Wordpress ne trouve pas un modèle
 * À utiliser comme fallback seulement.
 */

get_header(); // Affiche header.php

// Est-ce que nous avons des posts qui correspondent à notre requête ?
// Dans le cas de la page d'accueil, les billets les plus récents serons affichés
?>
<main>
    <section class="main-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h1>La Licornerie</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="hero-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img class="header-img" src="../medias/boutique/13-kevin_2.jpg" alt="logo" />
                            </div>
                            <div class="swiper-slide">
                                <img class="header-img" src="../medias/boutique/13-kevin.jpg" alt="logo" />
                            </div>
                            <div class="swiper-slide">
                                <img class="header-img" src="../medias/boutique/13-kevin_3.jpg" alt="logo" />
                            </div>
                        </div>
                        <div class="hero-swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-categorie">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <H2>Magasinez Par Catégories</H2>
                </div>
                <div class="row justify-content-center">
                    <div class="categorie-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img class="cercle" src="../medias/boutique/1-sirop_emeraude.png" alt="logo" />
                            </div>
                            <div class="swiper-slide">
                                <img class="cercle" src="../medias/boutique/11-mirroir.jpg" alt="logo" />
                            </div>
                            <div class="swiper-slide">
                                <img class="cercle" src="../medias/boutique/4-collier_licorne.jpg" alt="logo" />
                            </div>
                        </div>
                        <div class="categorie-swiper-pagination"></div>
                        <div class="categorie-swiper-button-prev"></div>
                        <div class="categorie-swiper-button-next"></div>
                    </div>
                </div>
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
                        <img src="../medias/boutique/7-unicorn_poop.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="#" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../medias/boutique/9-Emma_licorne_sorbet.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="pages/page_produit/produit.html" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../medias/boutique/2-laurie_licorne.jpg" class="card-img-top" alt="poop">
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
                        <img src="../medias/boutique/12-thermos.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="#" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../medias/boutique/1-sirop_licorne.jpg" class="card-img-top" alt="poop">
                        <div class="card-body">
                            <h5 class="card-title">item-licorne</h5>
                            <p class="card-text">mini description</p>
                            <a href="page_produit/produit.html" class="btn btn-primary">Voir</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 vedette">
                    <div class="card" style="width: 18rem;">
                        <img src="../medias/boutique/15-meowchi.jpg" class="card-img-top" alt="poop">
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
                            <img src="assets/image_fake_humain.png" class="img-fluid">
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
                            <img src="assets/image_fake_humain.png" class="img-fluid">
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
                            <img src="assets/image_fake_humain.png" class="img-fluid">
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