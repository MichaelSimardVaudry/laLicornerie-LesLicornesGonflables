<?php 
/**
 * 	Template Name: Boutique
 */

get_header();

?>

<main>
    <div class="infoBar">
        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
        <iconify-icon icon="ci:line-xl"></iconify-icon>

        <label>
            Age:
            <select name='Age:'>
                <option value="4">0 à 4 ans</option>
                <option value="8">5 à 8 ans</option>
                <option value="9">9 à 18 ans</option>
                <option value="adulte">Adultes</option>
            </select>
        </label>

        <label>
            Tier par:
            <select name='Trier par:'>
                <option value="default">Par défault</option>
                <option value="nouveautes">Nouveautés</option>
                <option value="croissant">Prix croissant</option>
                <option value="decroissant">Prix décroissant</option>
            </select>
        </label>
        <p>Value: <span id="demo"></span></p>
    </div>

    <div class='lesProduits'>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

        <div class='produit'>
            <img class='imgProduit'
                src='https://th.bing.com/th/id/R.9fe1988f83eeae24d16db131475d31b2?rik=Eq0UEK5i3b%2bfgg&riu=http%3a%2f%2fcohenwoodworking.com%2fwp-content%2fuploads%2f2016%2f09%2fimage-placeholder-500x500.jpg&ehk=6xxwN2hsF1pbhTTWWflHnkIka8Rxe3PZahhFfRQJIrY%3d&risl=&pid=ImgRaw&r=0&sres=1&sresct=1'>
            <p>Item numero 1</p>
            <p>Prix</p>
        </div>

    </div>
</main>

<?php 


get_footer();

?>