<?php 
/**
 * 	Template Name: Article
 */

get_header();

?>

<main class="container">
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="../../../medias/boutique/1-sirop_classique.png" style="width:100%">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1>Sirops de Licorne avec paillettes comestibles</h1>
                    <p>Faits à base de fruits locaux et de paillettes comestibles, les sirops de licorne sont des sirops
                        simples
                        pour aromatiser et décorer vos mocktails, cocktails, eau pétillante, ou tout autre liquide qui
                        mérite
                        d'être pailletté!</p>
                    <div class="product-price">

                        <div class="quantity">
                            <input type="number" min="1" max="9" step="1" value="1">
                        </div>

                        <span>C$16.95</span>
                        <a href="#" class="cart-btn">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- Swiper -->
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">Slide 1</div>
        <div class="swiper-slide">Slide 2</div>
        <div class="swiper-slide">Slide 3</div>
        <div class="swiper-slide">Slide 4</div>
        <div class="swiper-slide">Slide 5</div>
        <div class="swiper-slide">Slide 6</div>
        <div class="swiper-slide">Slide 7</div>
        <div class="swiper-slide">Slide 8</div>
        <div class="swiper-slide">Slide 9</div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>

<div class="card text">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="#">Informations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Évaluations</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <p class="card-text"><strong>Disponibilité:</strong> En stock
            </br>
            Choisir votre saveur favorite dans la boite à droite de la photo.
            </br>
            Toutes ces licornes sont déjà près de vous!
            </br>
            Tous nos produits affichés en ligne sont stockés en boutique à Brossard, QC. C'est ici que votre commande
            sera
            préparée avec amour, parfumée et expédiée dans un joli emballage-cadeau prêt à offrir.
            </br>
            </br>
            <strong>Détails et délais de livraison:</strong>
            La livraison est gratuite au Canada pour les commandes de 100$ et plus.
            </br>
            </br>
            <strong>Région de Montréal :</strong> 2 jours ouvrables.
            </br>
            </br>
            <strong>Au Québec :</strong> 2 à 10 jours ouvrables.
            </br>
            </br>
            <strong>Au Canada ou États-Unis :</strong> 2 à 14 jours ouvrables.
            </br>
            </br>
            <strong>Partout ailleurs dans le monde :</strong> Sélectionner l'option de livraison internationale. Nous
            vous
            contacterons avec les options d'expédition pour ces produits.
            </br>
            La 'date requise' est un indicateur pour notre équipe, elle ne constitue pas une garantie. Nous vous
            contacterons rapidement (24-48h après avoir reçu votre commande) si quelque chose nous empêche de livrer le
            tout
            à temps.
            </br>
            </br>
            <strong>Ramassage en magasin:</strong>
            Nous demandons un certain délai pour s'assurer que votre commande soit disponible et mise de côté à la
            succursale de votre choix. Si votre commande entière n'est pas déjà sur place, les produits manquants seront
            inclus dans la prochaine livraison à cette succursale.
        </p>
    </div>
</div>

<?php 


get_footer();

?>