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
    <script src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
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
                $arguments = array(
                    'post_type' => 'head_et_foot',
                    'posts_per_page' => 1
                );
         $logo = new WP_Query($arguments);
                while ($logo->have_posts()) : $logo->the_post(); 
	?>>

    <header>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="http://localhost/laLicornerie-LesLicornesGonflables/wordpress/wordpress/"><img class="header__logo__img"
                    src="<?php the_field('logo'); ?>" alt="image licorne rainbow" />
            </a>

            <button class="navbar-toggler navbar-light" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Affichage/masquage de la navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="boutique" class="nav-link">Boutique</a>
                    </li>
                    <li class="nav-item">
                        <a href="evenement" class="nav-link">Évènements</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="nouvelle" class="nav-link">Nouvelles</a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>
    <?php
                    endwhile; 
                    wp_reset_postdata(); 
                ?>
    <main>

        <!-- Débute le contenu principal de notre site -->