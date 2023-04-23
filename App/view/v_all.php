<section class="user-choices">
    <form action="" class="choices">
        <div>
            <div class="colors">
                Couleurs
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
                        <input type="checkbox" name="<?= $color['name_color'] ?>" id="<?= $color['name_color'] ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
        <div>
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
                        <input type="checkbox" name="<?= $category['name_category'] ?>" id="<?= $category['name_category'] ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    </form>
</section>
<main class="products">

    <div class="card">
        <a href="#" class="card-link">
            <img src="../../public/assets/erol-ahmed-IHL-Jbawvvo-unsplash.jpg" alt="">
            <div class="product-specs">
                <div class="product-name">
                    <h5>Rose de Damas</h5>
                    <p>Fleur française</p>
                </div>
                <div class="product-price">
                    <p><span>dès</span> 9,99€</p>
                </div>
            </div>
            <input type="submit" value="Ajouter au panier">
        </a>
    </div>

    <div class="card">
        <a href="#" class="card-link">
            <div class="product-image"></div>
            <img src="../../public/assets/pink-roses.jpg" alt="">
            <div class="product-specs">
                <div class="product-name">
                    <h5>Rose de Damas</h5>
                    <p>Fleur française</p>
                </div>
                <div class="product-price">
                    <p><span>dès</span> 9,99€</p>
                </div>

            </div>
            <input type="submit" value="Ajouter au panier">
        </a>
    </div>

    <div class="card">
        <a href="#" class="card-link">
            <img src="../../public/assets/pink-roses.jpg" alt="">
            <div class="product-specs">
                <div class="product-name">
                    <h5>Rose de Damas</h5>
                    <p>Fleur française</p>
                </div>
                <div class="product-price">
                    <p><span>dès</span> 9,99€</p>
                </div>

            </div>
            <input type="submit" value="Ajouter au panier">
        </a>
    </div>

    <div class="card">
        <a href="#" class="card-link">
            <img src="../../public/assets/pink-roses.jpg" alt="">
            <div class="product-specs">
                <div class="product-name">
                    <h5>Rose de Damas</h5>
                    <p>Fleur française</p>
                </div>
                <div class="product-price">
                    <p><span>dès</span> 9,99€</p>
                </div>

            </div>
            <input type="submit" value="Ajouter au panier">
        </a>
    </div>

    <div class="card">
        <a href="#" class="card-link">
            <img src="../../public/assets/pink-roses.jpg" alt="">
            <div class="product-specs">
                <div class="product-name">
                    <h5>Rose de Damas</h5>
                    <p>Fleur française</p>
                </div>
                <div class="product-price">
                    <p><span>dès</span> 9,99€</p>
                </div>

            </div>
            <input type="submit" value="Ajouter au panier">
        </a>
    </div>

    <div class="card">
        <a href="#" class="card-link">
            <img src="../../public/assets/pink-roses.jpg" alt="">
            <div class="product-specs">
                <div class="product-name">
                    <h5>Rose de Damas</h5>
                    <p>Fleur française</p>
                </div>
                <div class="product-price">
                    <p><span>dès</span> 9,99€</p>
                </div>

            </div>
            <input type="submit" value="Ajouter au panier">
        </a>
    </div>

</main>