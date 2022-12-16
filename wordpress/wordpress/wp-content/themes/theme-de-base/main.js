let category = document.querySelector("#boutiqueCategory");
let sort = document.querySelector("#boutiqueSort");
let produitsContainer = document.querySelector(".lesProduits");

if (category.value === "toy"){
    produitsContainers = `
    <?php $query = new WP_Query($jouets);
        while($query->have_posts()) : $query->the_post(); ?>
        <div class='produit'>
            <img class='imgProduit' src='<?php the_field('image_produit') ; ?>'>
            <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
            <button type="button" class='boutiqueBouton'>Ajouter au Panier</button>
        </div>
        <?php  endwhile; wp_reset_postdata(); ?>`;
} else if (category.value === "jewlery") {
    produitsContainers = `
    <?php $query = new WP_Query($bijoux);
        while($query->have_posts()) : $query->the_post(); ?>
        <div class='produit'>
            <img class='imgProduit' src='<?php the_field('image_produit') ; ?>'>
            <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
            <button type="button" class='boutiqueBouton'>Ajouter au Panier</button>
        </div>
        <?php  endwhile; wp_reset_postdata(); ?>`
  } else if (category.value === "other") {
    produitsContainers = `
    <?php $query = new WP_Query($accessoires);
        while($query->have_posts()) : $query->the_post(); ?>
        <div class='produit'>
            <img class='imgProduit' src='<?php the_field('image_produit') ; ?>'>
            <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
            <button type="button" class='boutiqueBouton'>Ajouter au Panier</button>
        </div>
        <?php  endwhile; wp_reset_postdata(); ?>`
  } else if (category.value === "food") {
    produitsContainers = `
    <?php $query = new WP_Query($comestibles);
        while($query->have_posts()) : $query->the_post(); ?>
        <div class='produit'>
            <img class='imgProduit' src='<?php the_field('image_produit') ; ?>'>
            <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
            <button type="button" class='boutiqueBouton'>Ajouter au Panier</button>
        </div>
        <?php  endwhile; wp_reset_postdata(); ?>`
  } else {
    produitsContainers = `
    <?php $query = new WP_Query($products);
        while($query->have_posts()) : $query->the_post(); ?>
        <div class='produit'>
            <img class='imgProduit' src='<?php the_field('image_produit') ; ?>'>
            <div class='nomProduit produitGeneralInfo'><?php the_field('titre') ; ?></div>
            <div class='prixProduit produitGeneralInfo'><?php the_field('prix') ; ?></div>
            <button type="button" class='boutiqueBouton'>Ajouter au Panier</button>
        </div>
        <?php  endwhile; wp_reset_postdata(); ?>`
  }