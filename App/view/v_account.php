<main class="account">

    <!-- cart content -->
    <container class="cart">
        <h4>Votre panier</h4>
        <a href="index.php?uc=account&action=emptyBasket" class="unset">Vider le panier</a><br>
        <?php 
        if(isset($cartContent)) {
        foreach($cartContent as $product) { ?>
            <div class="product-recap">
                    <a href="index.php?uc=product&action=show&id=<?= $product['id'] ?>" alt="Voir <?= $product['name_product'] ?>">
                        <img src="public/assets/<?= $product['image_product'] ?>" alt="<?= $product['name_product'] ?>" class="image-cart">
                    </a>
                    <div class="qty-price-delete bold">
                        <div class="qty-price">
                            <p><?= $product['quantity_order_product'] ?> x <?= $product['name_product'] ?></p>
                            <p><?= number_format($product['price_product'], 2, ',', '') ?>€ l'unité</p>
                        </div>
                        <div class="delete"><a href="index.php?account&action=remove&id=<?= $product['id'] ?>" class="delete"><img src="public/assets/bin.svg" alt="Supprimer le produit"></a></div>
                    </div>
            </div>
            <?php } ?>
            <?php if($deliverable) { ?>
            <p class="bold big recap-title">Récapitulatif</p>
            <div class="recap bold">
                <p>Sous-total</p>
                <p><?= number_format($totalPrice, 2, ',', '') ?>€</p>
            </div>
            <div class="recap bold">
                <p>Livraison</p>
                <p>
                    <?= $shippingCost ? "2,99€" : "Offert"; ?>
                </p>
            </div>
            <div class="big recap bold total">
                <p>Total</p>
                <p>
                    <?php $shippingCost ? $totalPrice += 2.99 : $totalPrice;
                    echo number_format($totalPrice, 2, ',', '').'€'; ?>
                </p>
            </div>
            <p class="bold free-delivery">La livraison est offerte au dessus de 50€ d'achat</p>
            <form action="index.php?uc=order&action=placeOrder" method="POST">
            <div>
                <label for="deliveryDdate"  class="bold"> Date de livraison :</label>
                <input type="date" name="deliveryDate" id="" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
            </div>

            <button type="submit" alt="Commander" class="order">Passer commande</button>
            </form>
            <?php 
            } else { ?>
                <p>Malheureusement nous ne livrons pas chez vous...</p>
            <?php }
        } else { ?>
        <p class="bold emtpy">Votre panier est vide</p>
        <?php } ?>
    </container>

    <!-- customer details -->
    <container class="customer-details">
        <h4>Vos informations</h4>
        <div>
            <h5>Nom :</h5>
            <p><?= $_SESSION['customer']['last_name_customer'] ?></p>
            <h5> Prénom :</h5>
            <p><?= $_SESSION['customer']['first_name_customer'] ?></p>
            <h5>Email :</h5>
            <p><?= $_SESSION['customer']['email_customer'] ?></p>
            <h5>Adresse :</h5>
            <p><?= $_SESSION['customer']['line1_adress'] ?> <br>
                <?php if (isset($_SESSION['customer']['line2_adress'])) {
                    echo $_SESSION['customer']['line2_adress'] . "<br>";
                } ?>
                <?= $_SESSION['customer']['zip_code_city'] ?>
                <?= $_SESSION['customer']['name_city'] ?>
            </p>

        </div>
        <h5><a href="index.php?uc=account&action=logOut">Se déconnecter</a></h5>
    </container>

    <!-- past orders -->
    <container class="past-orders">
        <h4>Vos commandes</h4>
        <?php
        if (count($formerOrders) > 0) {
            $date = new DateTime($formerOrders[0]['date_customer_order']); ?>
            <div class="order-info">
                <h5>Commande n°<?= $formerOrders[0]['id'] ?> du <?= $date->format('d/m/Y') ?></h5>
                <h5>Contenu :</h5>
                <ul><?php
                    if ($formerOrders[0]['price_product'] < 0) { ?>
                        <li><?= $formerOrders[0]['name_prize'] ?> (offert) <?php
                    } else { ?>
                        <li><?= $formerOrders[0]['name_product'] ?> (<?= number_format($formerOrders[0]['price_product'], 2, ',', '') ?> €) <?php
                    }
                    for ($i = 1; $i < count($formerOrders); $i++) {
                        if ($formerOrders[$i]['date_customer_order'] === $formerOrders[$i - 1]['date_customer_order']) {
                            if ($formerOrders[$i]['price_product'] < 0) { ?>
                                <li><?= $formerOrders[$i]['name_prize'] ?> (offert) <?php
                            } else { ?>
                                <li><?= $formerOrders[$i]['name_product'] ?> (<?= number_format($formerOrders[$i]['price_product'], 2, ',', '') ?>€) <?php
                            }
                        } else { ?>
                            </ul>
                            <?php $date = new DateTime($formerOrders[$i-1]['delivery_date_customer_order']); ?>
                            <h5>Livraison prévue le :</h5>
                            <ul>
                                <li><?= $date->format('d/m/Y') ?></li>
                            </ul>
                            <h5>Statut :</h5>
                            <ul>
                                <li><?= $formerOrders[$i]['name_order_status'] ?></li>
                            </ul>
                            </div>
                            <?php $date = new DateTime($formerOrders[$i]['date_customer_order']); ?>
                            <div class="order-info">
                            <h5>Commande n°<?= $formerOrders[$i]['id'] ?> du <?= $date->format('d/m/Y') ?></h5>
                            <h5>Contenu :</h5>
                            <ul><?php
                            if ($formerOrders[$i]['price_product'] < 0) { ?>
                                <li><?= $formerOrders[$i]['name_prize'] ?> (offert) <?php
                            } else { ?>
                                <li><?= $formerOrders[$i]['name_product'] ?> (<?= number_format($formerOrders[$i]['price_product'], 2, ',', '') ?>€) <?php
                            }
                        }
                    } ?>
                </ul>
                <?php $date = new DateTime(end($formerOrders)['delivery_date_customer_order']); ?>
                <h5>Livraison prévue le :</h5>
                <ul>
                    <li><?= $date->format('d/m/Y') ?></li>
                </ul>
                <h5>Statut : </h5>
                <ul>
                    <li><?= end($formerOrders)['name_order_status'] ?></li>
                </ul>
            </div>
        <?php
        } else {
            echo "Vous n'avez pas de commandes à afficher";
        }
        ?>
    </container>
</main>