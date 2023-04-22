<main class="home">
    <?php if (isset($_SESSION['customer']) && gettype($_SESSION['customer']) != 'boolean') {
        echo "Bonjour" . " " . $_SESSION['customer']['first_name_customer'] . " " . $_SESSION['customer']['last_name_customer'];
    }

    ?>
    <div class="slider">
        <div class="slide" class="active">
            <img src="public/assets/slider1.png" alt="">
            <div class="event-info">
                <h4>SPÉCIAL LOTERIE FÊTE DES M&#200;RES</h4>
                <p>Du 22 mai au 4 juin, Lafleur vous offre <br> une chance de gagner une surprise !</p>
                <input type="submit" value=" VOIR LES BOUQUETS">
            </div>
        </div>
        <div class="slide">
            <img src="public/assets/store-front.jpg" alt="">
            <div class="event-info">
                <h4>Lafleur ouvre ses portes en ligne </h4>
                <p>Vos fleuristes préférés se développent <br> et ouvrent leur boutique sur internet !</p>
                <input type="submit" value=" VOIR NOS FLEURS">
            </div>
        </div>

        <div class="round">
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
    </div>
    <h2>Des fleurs pour chaque occasion</h2>
    <div class="events">
        <a href="">
            <div class="category thanks">
                <div class="background"></div>
                <p>Remerciements</p>
            </div>
        </a>
        <a href="">
            <div class="category birth">
                <div class="background"></div>
                <p>Naissance</p>
            </div>
        </a>
        <a href="">
            <div class="category grief">
                <div class="background"></div>
                <p>Deuil</p>
            </div>
        </a>
        <a href="">
            <div class="category birthday">
                <div class="background"></div>
                <p>Anniversaire</p>
            </div>
        </a>
        <a href="">
            <div class="category feels">
                <div class="background"></div>
                <p>Sentiments</p>
            </div>
        </a>
    </div>
    <div class="category">
        <h2>Les roses</h2>
        <div class="card-product">
            <img src="" alt="">
            <div></div>
            <button>Ajouter au panier</button>
        </div>
        <a href="">
            <p>Voir la suite</p>
        </a>
    </div>
    <div class="category">
        <h2>Nos fleurs à l'unité</h2>
        <div class="card-product">
            <img src="" alt="">
            <div></div>
            <button>Ajouter au panier</button>
        </div>
        <a href="">
            <p>Voir la suite</p>
        </a>
    </div>
    <div class="category">
        <h2>Sélection fête des mères</h2>
        <div class="card-product">
            <img src="" alt="">
            <div></div>
            <button>Ajouter au panier</button>
        </div>
        <a href="">
            <p>Voir la suite</p>
        </a>
    </div>
</main>