<?php 
/**
 * 	Template Name: Event
 */

get_header();

?>

<main>
    <div class="container fond_rose">
        <div class="row">
            <div class="Col-12">
                <h1>Réserver nos service pour un évènement!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-7 overflow-hidden img_event">
                <img src="../../../medias\img_salle_1.jpg" alt="salle avec un theme de licorne">
            </div>
            <div class="col-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <p>Disponibilité</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <svg width="423" height="5" viewBox="0 0 423 5" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="423" height="5" rx="2.5" fill="#fd95e3" />
                            </svg>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12">
                            <form action="info">
                                <p>Information pour la réservation</p>
                                <label for="date">Date: </label>
                                <input type="date" id="date" name="date">
                                <br>
                                <label for="nom">Nom: </label>
                                <input type="text" id="name" name="name">
                                <br>
                                <p>Description de l’évènement</p>
                                <label for="description"></label>
                                <input type="text" id="name" name="name">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="Col-12">
                <h2>Info</h2>
            </div>
            <div class="Col-12 info_event">

                <p>
                    <b>Toutes ces licornes sont déjà près de vous!</b><br>
                    Tous nos produits affichés en ligne sont stockés en boutique à Brossard, QC. C'est ici que votre
                    commande sera préparée avec amour, parfumée et expédiée dans un joli emballage-cadeau prêt à offrir.
                    <br>
                    C'est ici que votre commande sera préparée avec amour, parfumée et expédiée dans un joli
                    emballage-cadeau prêt à offrir.
                    <br>
                    <b>Détails et délais de livraison:</b><br>
                    La livraison est gratuite au Canada pour les commandes de 100$ et plus.
                    Région de Montréal : 2 jours ouvrables.
                    Au Québec : 2 à 10 jours ouvrables.
                    Au Canada ou États-Unis : 2 à 14 jours ouvrables.
                    Partout ailleurs dans le monde : Sélectionner l'option de livraison internationale. Nous vous
                    contacterons avec les options d'expédition pour ces produits.
                    <br>
                    La 'date requise' est un indicateur pour notre équipe, elle ne constitue pas une garantie. Nous vous
                    contacterons rapidement (24-48h après avoir reçu votre commande) si quelque chose nous empêche de
                    livrer le tout à temps.
                    <br>
                    <b>Ramassage en magasin:</b><br>
                    Nous demandons un certain délai pour s'assurer que votre commande soit disponible et mise de côté à
                    la succursale de votre choix. Si votre commande entière n'est pas déjà sur place, les produits
                    manquants seront inclus dans la prochaine livraison à cette succursale.
                </p>
            </div>
        </div>
    </div>
</main>

<?php 


get_footer();

?>