<main class="product">
    <img src="../../public/assets/<?= $product['image_product'] ?>" alt="">
    <h3><?= $product['name_product'] ?></h3>
    <p><?= $product['description_product'] ?></p>
    <a href="index.php?uc=product&action=add&id=<?= $product['id'] ?>">AJOUTER AU PANIER</a>

</main>