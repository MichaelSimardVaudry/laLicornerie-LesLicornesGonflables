<?php
	/*-----------------------------------------------------------------------------------*/
	/* Affiche le pied de page (Footer) sur toutes vos pages
	/*-----------------------------------------------------------------------------------*/
    $arguments = array(
        'post_type' => 'head_et_foot',
        'posts_per_page' => 1
    );
$logo = new WP_Query($arguments);
    while ($logo->have_posts()) : $logo->the_post(); 
// Fermeture de la zone de contenu principale ?>
</main>

<footer class="footer page-footer">
    <div class="container">
        <div class="row">
            <div class="col-1">
                <a class="navbar-brand" href="http://localhost/laLicornerie-LesLicornesGonflables/wordpress/wordpress/">
                    <img src="<?php the_field('logo'); ?>" class="logo">
                    <img src="../../medias/tide.png" class="partenaires">
                    <img src="../../medias/hyundai.png" class="partenaires">
                    <img src="../../medias/paramount.png" class="partenaires">
                </a>
                <?php
                    endwhile; 
                    wp_reset_postdata(); 
                ?>
            </div>
            <div class="col-10" id="social">
                <ul>
                    <li>
                        <a href="mailto: info@lalicornerie.ca" class=""> info@lalicornerie.ca</a>
                    </li>
                    </br>
                    <li>
                        <a href="#" class=""> (514) 543-7311
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-1" id="social2">


                <a class="reseau facebook"
                    href="https://www.facebook.com/licornerie?_ga=2.106139328.256508163.1670591864-1990977497.1662142240"><svg
                        xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 20 20">
                        <path fill="black"
                            d="M10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6s9.6-4.298 9.6-9.6S15.302.4 10 .4zm2.274 6.634h-1.443c-.171 0-.361.225-.361.524V8.6h1.805l-.273 1.486H10.47v4.461H8.767v-4.461H7.222V8.6h1.545v-.874c0-1.254.87-2.273 2.064-2.273h1.443v1.581z" />
                    </svg></a>


                <a class="reseau instagram"
                    href="https://www.instagram.com/lalicornerie/?hl=en&_ga=2.106139328.256508163.1670591864-1990977497.1662142240"><svg
                        xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 20 20">
                        <path fill="black"
                            d="M13 10a3 3 0 1 1-6 0c0-.171.018-.338.049-.5H6v3.997c0 .278.225.503.503.503h6.995a.503.503 0 0 0 .502-.503V9.5h-1.049c.031.162.049.329.049.5zm-3 2a2 2 0 1 0-.001-4.001A2 2 0 0 0 10 12zm2.4-4.1h1.199a.301.301 0 0 0 .301-.3V6.401a.301.301 0 0 0-.301-.301H12.4a.301.301 0 0 0-.301.301V7.6c.001.165.136.3.301.3zM10 .4A9.6 9.6 0 0 0 .4 10a9.6 9.6 0 0 0 9.6 9.6a9.6 9.6 0 0 0 9.6-9.6A9.6 9.6 0 0 0 10 .4zm5 13.489C15 14.5 14.5 15 13.889 15H6.111C5.5 15 5 14.5 5 13.889V6.111C5 5.5 5.5 5 6.111 5h7.778C14.5 5 15 5.5 15 6.111v7.778z" />
                    </svg></a>

                <a class="reseau youtube" href="https://www.youtube.com/channel/UCo8U6DKfc63fUeNmyuNRZEQ"><svg
                        xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 20 20">
                        <path fill="black"
                            d="M11.603 9.833L9.357 8.785C9.161 8.694 9 8.796 9 9.013v1.974c0 .217.161.319.357.228l2.245-1.048c.197-.092.197-.242.001-.334zM10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6s9.6-4.298 9.6-9.6S15.302.4 10 .4zm0 13.5c-4.914 0-5-.443-5-3.9s.086-3.9 5-3.9s5 .443 5 3.9s-.086 3.9-5 3.9z" />
                    </svg></a>

            </div>
            <div class="col-1" id="social3">
                <svg id="walmartblue_Layer_1" data-name="Layer 1" viewBox="0 0 384 80" class="reseau instagram">
                    <path class="cls-1"
                        d="M292.76 56a11.07 11.07 0 0 1-.37 3 10.4 10.4 0 0 1-10 7c-4.1 0-7.36-2.32-7.36-7.25 0-7.53 8.29-9.62 17.74-9.56zm14.8-13.13c0-12.43-5.31-23.36-23.24-23.36a42.52 42.52 0 0 0-20.51 4.9l2.92 10a30.06 30.06 0 0 1 14.95-4.21c9.1 0 10.6 5.16 10.6 8.47v.79c-19.84 0-32.38 6.84-32.38 20.82 0 8.55 6.39 16.56 17.49 16.56 6.83 0 12.53-2.73 15.95-7.09h.34s2.26 9.48 14.75 5.84a79.48 79.48 0 0 1-.87-13.21zM4 2.61s13 53.1 15 61.73c2.41 10.06 6.76 13.76 19.3 11.25l8.09-32.91c2.06-8.19 3.43-14 4.75-22.33h.23A221.13 221.13 0 0 0 55.3 42.7s3.3 14.95 5 22.8S66.68 78.3 79 75.59l19.28-73h-15.6l-6.59 31.58c-1.77 9.18-3.37 16.36-4.61 24.76h-.22c-1.12-8.32-2.55-15.21-4.36-24.16L60.05 2.61H43.84L36.5 34c-2.07 9.53-4 17.22-5.26 25.33H31c-1.24-7.68-2.92-17.33-4.75-26.56 0 0-4.36-22.43-5.88-30.16zM126.78 56a10.32 10.32 0 0 1-.37 3 10.39 10.39 0 0 1-10 7c-4.1 0-7.37-2.32-7.37-7.25 0-7.53 8.3-9.62 17.74-9.56zm14.81-13.13c0-12.43-5.31-23.36-23.25-23.36a42.48 42.48 0 0 0-20.5 4.9l2.92 10a30 30 0 0 1 14.95-4.21c9.1 0 10.59 5.16 10.59 8.47v.79c-19.84 0-32.37 6.84-32.37 20.82 0 8.55 6.38 16.56 17.48 16.56 6.83 0 12.53-2.73 16-7.09h.34s2.27 9.48 14.76 5.84a79.48 79.48 0 0 1-.87-13.21zM164.49 60.1V2.61h-14.82v72.98h14.82V60.1zM353 2.61v53.85c0 7.42 1.4 12.62 4.39 15.8 2.61 2.78 6.91 4.58 12.06 4.58a35.23 35.23 0 0 0 10.74-1.6L380 63.67a23.22 23.22 0 0 1-5.63.67c-5.05 0-6.75-3.24-6.75-9.9v-20.6h12.91v-14h-12.92V2.61zM314.74 20.77v54.82H330V47.53a20.81 20.81 0 0 1 .33-4.05c1.13-5.88 5.63-9.64 12.09-9.64a27.68 27.68 0 0 1 4.41.39V19.87a14.79 14.79 0 0 0-3.36-.34c-5.71 0-12.2 3.69-14.93 11.58h-.42V20.77zM173.08 20.77v54.82H188V43.45a12.85 12.85 0 0 1 .7-4.5c1.24-3.23 4.24-7 9.05-7 6 0 8.82 5.09 8.82 12.42v31.22h14.89V43.05a15.32 15.32 0 0 1 .62-4.44 9.41 9.41 0 0 1 8.92-6.68c6.1 0 9 5 9 13.63v30h14.9V43.31c0-17-8.64-23.78-18.4-23.78a19.85 19.85 0 0 0-10.82 3 23 23 0 0 0-7 6.83h-.22c-2.35-5.91-7.89-9.81-15.11-9.81-9.27 0-13.44 4.7-16 8.7h-.22v-7.48z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
    <div class="text-center text-light p-3" style="background-color: rgba(0, 0, 0, 0.8);">
        © 2022 Copyright:
        <a class="text-light" href="https://www.walmart.ca/fr">ASD.org</a>
    </div>

</footer>


<?php wp_footer(); 
/* Espace où WordPress peut insérer des fichiers .js et autres. Par exemple pour des extensions (plugins). 
	 Si vous enlevez cette fonction, vous désactiverez du même coup toutes vos extensions (plugins) 🤷. 
	 Vous pouvez la déplacer si désiré, mais garder là. */
?>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="script.js"></script>

</body>

</html>