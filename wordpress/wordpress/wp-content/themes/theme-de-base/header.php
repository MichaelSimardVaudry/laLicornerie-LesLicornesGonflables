<?php
	/*-----------------------------------------------------------------------------------*/
	/* Affiche l'entête (Header) sur toutes vos pages
	/*-----------------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title>
        <?php bloginfo('name'); // Affiche le nom du blog ?> |
        <?php is_front_page() ? bloginfo('description') : wp_title(''); // si nous sommes sur la page d'accueil, affichez la description à partir des paramètres du site - sinon, affichez le titre du post ou de la page. ?>
    </title>
    <?php 
	// Tous les .css et .js sont chargés dans le fichier functions.php
?>

    <?php wp_head(); 
/* Cette fonction permet à WordPress et aux extensions d'instancier des fichier CSS et js dans le <head>
	 Supprimer cette fonction briserait vos extensions et diverses fonctionnalités WordPress. 
	 Vous pouvez la déplacer si désiré, mais garder là. */
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Salsa&display=swap');
</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
</head>

<body <?php body_class(); 
	/* Applique une classe contextuel sur le body
		 ex: sur la page d'accueil vous aurez la classe "home"
		 sur un article, "single postid-{ID}"
		 etc. */
	?>>

    <header>
        <nav class="navbar navbar-light navbar-expand-lg">
            <a class="navbar-brand" href="../wordpress/"><img class="header__logo__img" src="../../medias/logo.png"
                    alt="imgage licorne rainbow" />
            </a>
            <div class="container">
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Affichage/masquage de la navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="mainNav" class="collapse navbar-collapse">
                    <ul class="navbar-nav" >
                        <li class="nav-item">
                            <a href="boutique" class="nav-link" style="color:black; background-color:white; border-radius:35px; padding: 0 3vh; margin:5px">Boutique</a>
                        </li>
                        <li class="nav-item">
                            <a href="evenement" class="nav-link" style="color:black; background-color:white; border-radius:35px; padding: 0 3vh; margin:5px">Évènements</a>
                        </li>
                        <li class="nav-item">
                            <a href="contact" class="nav-link" style="color:black; background-color:white; border-radius:35px; padding: 0 3vh; margin:5px">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="nouvelle" class="nav-link" style="color:black; background-color:white; border-radius:35px; padding: 0 3vh; margin:5px">Nouvelles</a>
                        </li>
                        <li class="nav-item">
                            <form>
                                <input type="text" name="text" class="navbar__recherche" placeholder="Recherche" />
                                <button class="my-button" aria-label="Smile"></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- Débute le contenu principal de notre site -->