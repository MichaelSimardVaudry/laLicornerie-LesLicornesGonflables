<?php
	/*-----------------------------------------------------------------------------------*/
	/* Affiche le pied de page (Footer) sur toutes vos pages
	/*-----------------------------------------------------------------------------------*/

// Fermeture de la zone de contenu principale ?>
</main>

<footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-2">
            <img src="assets/logo.png" class="logo">
          </div>
          <div class="col-2">
            <ul>
              <li>
                <a href="#" class="btn ">Adresse</a>
              </li>
              <li>
                <a href="#" class="btn ">Courriel</a>
              </li>
              <li>
                <a href="#" class="btn">telephone</a>
              </li>
            </ul>
          </div>
          <div class="col-2">
            <ul>
              <li>
                <img class="reseau" src="assets/facebook.png">
              </li>
              <li>
                <img class="reseau" src="assets/instagram.png">
              </li>
              <li>
                <img class="reseau" src="assets/youtube.png">
              </li>
            </ul>
          </div>
        </div>
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
