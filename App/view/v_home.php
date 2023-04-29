<main class="home">
    <div class="slider">
        <div class="round">
            <div class="circle active"></div>
            <div class="circle "></div>
        </div>

        <div class="slide active">
            <img src="public/assets/slider1.png" alt="Illustration Fête des mères">
            <div class="event-info">
                <h4>SPÉCIAL LOTERIE FÊTE DES M&#200;RES</h4>
                <p>Du 22 mai au 4 juin, Lafleur vous offre <br> une chance de gagner une surprise !</p>
                <a href="index.php?uc=all&action=mothersday">VOIR LES BOUQUETS</a>
            </div>
        </div>
        <div class="slide">
            <img src="public/assets/store-front.jpg" alt="Notre devanture">
            <div class="event-info">
                <h4>Lafleur ouvre ses portes en ligne </h4>
                <p>Vos fleuristes préférés se développent <br> et ouvrent leur boutique sur internet !</p>
                <a href="index.php?uc=all&action=catalogue">VOIR NOS FLEURS</a>
            </div>
        </div>
    </div>
    <h2>Des fleurs pour chaque occasion</h2>
    <div class="events">
        <a href="index.php?uc=all&action=thanks">
            <div class="category thanks">
                <div class="background"></div>
                <p>Remerciements</p>
            </div>
        </a>
        <a href="index.php?uc=all&action=birth">
            <div class="category birth">
                <div class="background"></div>
                <p>Naissance</p>
            </div>
        </a>
        <a href="index.php?uc=all&action=wedding">
            <div class="category wedding">
                <div class="background"></div>
                <p>Mariage</p>
            </div>
        </a>
        <a href="index.php?uc=all&action=birthday">
            <div class="category birthday">
                <div class="background"></div>
                <p>Anniversaire</p>
            </div>
        </a>
        <a href="index.php?uc=all&action=feels">
            <div class="category feels">
                <div class="background"></div>
                <p>Sentiments</p>
            </div>
        </a>
    </div>
    <div class="category roses">
        <h2>Les roses</h2>
        <?php foreach ($roses as $rose) { ?>
            <div class="card">
                <a href="index.php?uc=product&action=show&id=<?= $rose['id'] ?>" class="card-link">
                    <img src="public/assets/<?= $rose['image_product'] ?>" alt="" class="product-image">
                    <div class="bottom-card">
                        <div class="product-specs">
                            <div class="product-name">
                                <h5><?= $rose['name_product'] ?></h5>
                                <p>Fleur française</p>
                            </div>
                            <div class="product-price">
                                <p><span>dès</span> <?= number_format($rose['price_product'], 2, ',', '') ?>€</p>
                            </div>
                        </div>
                        <?php if ($rose['quantity_product'] > 1) { ?>
                            <a href="index.php?uc=product&action=add&id=<?= $rose['id'] ?>">AJOUTER AU PANIER</a>
                            <?php } else { ?>
                                <a class="inactive">PRODUIT ÉPUISÉ</a>
                        <?php } ?>
                    </div>
                </a>
            </div>
        <?php } ?>
        <a href="index.php?uc=all&action=roses" alt="Catégories roses">
            <p>Voir la suite</p>
        </a>
    </div>
    <div class="category unit">
        <h2>Nos fleurs à l'unité</h2>
        <div class="card-product">
            <img src="index.php?uc=all&action=unit" alt="Catégorie fleurs à l'unité">
            <div></div>
            <button>Ajouter au panier</button>
        </div>
        <a href="">
            <p>Voir la suite</p>
        </a>
    </div>
    <div class="category mothders-day">
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