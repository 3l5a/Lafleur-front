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
                <a href="index.php?uc=all&action=mothersday" alt="Catégorie fête des mères">VOIR LES BOUQUETS</a>
            </div>
        </div>
        <div class="slide">
            <img src="public/assets/store-front.jpg" alt="Notre devanture">
            <div class="event-info">
                <h4>Lafleur ouvre ses portes en ligne </h4>
                <p>Vos fleuristes préférés se développent <br> et ouvrent leur boutique sur internet !</p>
                <a href="index.php?uc=all&action=catalogue" alt="Toutes nos fleurs">VOIR NOS FLEURS</a>
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
        <div class="container-category">
            <?php foreach ($roses as $rose) { ?>
                <div class="card">
                    <a href="index.php?uc=product&action=show&id=<?= $rose['id'] ?>" class="card-link">
                        <img src="public/assets/<?= $rose['image_product'] ?>" alt="<?= $rose['name_product'] ?>" class="product-image">
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
        </div>
        <a href="index.php?uc=all&action=roses" alt="Catégories roses" class="see-more">
            <p>Voir la suite</p>
        </a>
    </div>
    <div class="category unit">
        <h2>Nos fleurs à l'unité</h2>
        <div class="container-category">
            <?php foreach ($unitFlowers as $unitFlower) { ?>
                <div class="card">
                    <a href="index.php?uc=product&action=show&id=<?= $unitFlower['id'] ?>" class="card-link">
                        <img src="public/assets/<?= $unitFlower['image_product'] ?>" alt="<?= $unitFlower['name_product'] ?>" class="product-image">
                        <div class="bottom-card">
                            <div class="product-specs">
                                <div class="product-name">
                                    <h5><?= $unitFlower['name_product'] ?></h5>
                                    <p>Fleur française</p>
                                </div>
                                <div class="product-price">
                                    <p><span>dès</span> <?= number_format($unitFlower['price_product'], 2, ',', '') ?>€</p>
                                </div>
                            </div>
                            <?php if ($unitFlower['quantity_product'] > 1) { ?>
                                <a href="index.php?uc=product&action=add&id=<?= $unitFlower['id'] ?>">AJOUTER AU PANIER</a>
                                <?php } else { ?>
                                    <a class="inactive">PRODUIT ÉPUISÉ</a>
                            <?php } ?>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <a href="index.php?uc=all&action=unit" alt="Catégorie fleurs à l'unité" class="see-more">
            <p>Voir la suite</p>
        </a>
    </div>
    <div class="category mothders-day">
        <h2>Sélection fête des mères</h2>
        <div class="container-category">
            <?php foreach ($mothersDays as $mothersDay) { ?>
                <div class="card">
                    <a href="index.php?uc=product&action=show&id=<?= $mothersDay['id'] ?>" class="card-link">
                        <img src="public/assets/<?= $mothersDay['image_product'] ?>" alt="<?= $mothersDay['name_product'] ?>" class="product-image">
                        <div class="bottom-card">
                            <div class="product-specs">
                                <div class="product-name">
                                    <h5><?= $mothersDay['name_product'] ?></h5>
                                    <p>Fleur française</p>
                                </div>
                                <div class="product-price">
                                    <p><span>dès</span> <?= number_format($mothersDay['price_product'], 2, ',', '') ?>€</p>
                                </div>
                            </div>
                            <?php if ($mothersDay['quantity_product'] > 1) { ?>
                                <a href="index.php?uc=product&action=add&id=<?= $mothersDay['id'] ?>">AJOUTER AU PANIER</a>
                            <?php } else { ?>
                                    <a class="inactive">PRODUIT ÉPUISÉ</a>
                            <?php } ?>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <a href="index.php?uc=all&action=mothersday" class="see-more">
            <p>Voir la suite</p>
        </a>
    </div>
</main>