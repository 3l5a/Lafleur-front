<section class="user-choices">
    <form action="index.php?uc=all&action=catalogue" method="post" class="choices">
        <div class="position-rel">
            <div class="colors">
                <span>Couleurs</span>
                <svg viewBox="0 0 16 16">
                    <path d="M14 5.55L12.94 4.5 8 9.4 3.06 4.5 2 5.55l6 5.95z"></path>
                </svg>
            </div>
            <div class="color-choices">
                <?php foreach ($colors as $color) { ?>
                    <div class="eachColor">
                        <div>
                            <label for="<?= $color['name_color'] ?>">
                                <div class="color" style="background-color: <?= $color['code_color'] ?>;"></div>
                                <p><?= ucfirst($color['name_color']) ?></p>
                            </label>
                        </div>
                        <input type="checkbox" name="color[]" id="<?= $color['name_color'] ?>" value="<?= $color['id'] ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="position-rel">
            <div class="categories">
                Catégories
                <svg viewBox="0 0 16 16">
                    <path d="M14 5.55L12.94 4.5 8 9.4 3.06 4.5 2 5.55l6 5.95z"></path>
                </svg>
            </div>
            <div class="category-choices">
                <?php foreach ($categories as $category) { ?>
                    <div class="eachCategory">
                        <label for="<?= $category['name_category'] ?>"><?= ucfirst($category['name_category']) ?></label>
                        <input type="checkbox" name="category[]" id="<?= $category['name_category'] ?>" value="<?= $category['id'] ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
        <input type="submit" value="Valider la sélection">
    </form>
</section>




<main class="products">
    <?php foreach ($products as $product) {
        if ($product['id'] != 12) { //id 12 = placeholder for lotery item
    ?>
            <div class="card">
                <a href="index.php?uc=product&action=show&id=<?= $product['id'] ?>" class="card-link">
                    <img src="public/assets/<?= $product['image_product'] ?>" alt="" class="product-image">
                    <div class="bottom-card">
                        <div class="product-specs">
                            <div class="product-name">
                                <h5><?= $product['name_product'] ?></h5>
                                <p>Fleur française</p>
                            </div>
                            <div class="product-price">
                                <p><span>dès</span> <?= number_format($product['price_product'], 2, ',', '') ?>€</p>
                            </div>
                        </div>
                        <?php if ($product['quantity_product'] > 1) { ?>
                            <a href="index.php?uc=product&action=add&id=<?= $product['id'] ?>">AJOUTER AU PANIER</a>
                            <?php } else { ?>
                                <a class="inactive">PRODUIT ÉPUISÉ</a>
                        <?php } ?>
                    </div>
                </a>
            </div>
    <?php }
    } ?>
</main>