<main class="product">
    <img src="  public/assets/<?= $product['image_product'] ?>" alt="<?= $product['image_product'] ?>">
    <div class="specs">
        <div>
            <div class="title">
                <h3><?= strtoupper($product['name_product']) ?></h3>
                <p><?= number_format($product['price_product'], 2, ',', '') ?>€</p>
            </div>
            <p><?= $product['description_product'] ?></p>
        </div>
        <?php if ($product['quantity_product'] > 1) { ?>
            <a href="index.php?uc=all&action=add&id=<?= $product['id'] ?>" class="addToCart">AJOUTER AU PANIER</a>
        <?php } else { ?>
            <a class="addToCart inactive">PRODUIT ÉPUISÉ</a>
        <?php } ?>
    </div>

</main>