<?php
	/*-----------------------------------------------------------------------------------*/
	/* Affiche le pied de page (Footer) sur toutes vos pages
	/*-----------------------------------------------------------------------------------*/

// Fermeture de la zone de contenu principale ?>
</main>

<footer class="footer page-footer">
    <div class="container">
        <div class="row">
            <div class="col-1">
                <a class="navbar-brand">
                    <img href="../wordpress/" src="../../medias/logo.png" class="logo">
                </a>
            </div>
            <div class="col-7" id="social">
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
           <div class="col-4" id="social2">
              
                    
                        <a class="reseau facebook" href="https://www.facebook.com/licornerie?_ga=2.106139328.256508163.1670591864-1990977497.1662142240"><svg xmlns="http://www.w3.org/2000/svg" width="2em"
                                height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20">
                                <path fill="white"
                                    d="M10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6s9.6-4.298 9.6-9.6S15.302.4 10 .4zm2.274 6.634h-1.443c-.171 0-.361.225-.361.524V8.6h1.805l-.273 1.486H10.47v4.461H8.767v-4.461H7.222V8.6h1.545v-.874c0-1.254.87-2.273 2.064-2.273h1.443v1.581z" />
                            </svg></a>
                    
                   
                        <a class="reseau instagram" href="https://www.instagram.com/lalicornerie/?hl=en&_ga=2.106139328.256508163.1670591864-1990977497.1662142240"><svg xmlns="http://www.w3.org/2000/svg" width="2em"
                                height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20">
                                <path fill="white"
                                    d="M13 10a3 3 0 1 1-6 0c0-.171.018-.338.049-.5H6v3.997c0 .278.225.503.503.503h6.995a.503.503 0 0 0 .502-.503V9.5h-1.049c.031.162.049.329.049.5zm-3 2a2 2 0 1 0-.001-4.001A2 2 0 0 0 10 12zm2.4-4.1h1.199a.301.301 0 0 0 .301-.3V6.401a.301.301 0 0 0-.301-.301H12.4a.301.301 0 0 0-.301.301V7.6c.001.165.136.3.301.3zM10 .4A9.6 9.6 0 0 0 .4 10a9.6 9.6 0 0 0 9.6 9.6a9.6 9.6 0 0 0 9.6-9.6A9.6 9.6 0 0 0 10 .4zm5 13.489C15 14.5 14.5 15 13.889 15H6.111C5.5 15 5 14.5 5 13.889V6.111C5 5.5 5.5 5 6.111 5h7.778C14.5 5 15 5.5 15 6.111v7.778z" />
                            </svg></a>
                    
                        <a class="reseau youtube" href="https://www.youtube.com/channel/UCo8U6DKfc63fUeNmyuNRZEQ"><svg xmlns="http://www.w3.org/2000/svg" width="2em"
                                height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20">
                                <path fill="white"
                                    d="M11.603 9.833L9.357 8.785C9.161 8.694 9 8.796 9 9.013v1.974c0 .217.161.319.357.228l2.245-1.048c.197-.092.197-.242.001-.334zM10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6s9.6-4.298 9.6-9.6S15.302.4 10 .4zm0 13.5c-4.914 0-5-.443-5-3.9s.086-3.9 5-3.9s5 .443 5 3.9s-.086 3.9-5 3.9z" />
                            </svg></a>
                   
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Copyright:
        <a class="text-dark" href="https://mdbootstrap.com/">Yas.org</a>
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