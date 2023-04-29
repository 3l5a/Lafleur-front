<main class="account">

    <!-- cart content -->
    <container class="cart">
        <h4>Votre panier</h4>
        <a href="index.php?uc=account&action=emptyBasket">Vider le panier</a><br>
        <?php if(isset($cartContent)) {
        foreach($cartContent as $product) {
            echo $product[0]['name_product'];
        }} ?>
        <label for="deliveryDdate"> Date de livraison :</label>
        <input type="date" name="" id="deliveryDate" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
        <br><a href="index.php?uc=order&action=placeOrder">Passer commande</a>
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

    <!-- orders -->
    <container class="past-orders">
        <h4>Vos commandes</h4>
        <div class="order">
        </div>
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
                <?php $date = new DateTime($formerOrders[$i]['delivery_date_customer_order']); ?>
                <h5>Livraison prévue le :</h5>
                <ul>
                    <li><?= $date->format('d/m/Y') ?></li>
                </ul>
                <h5>Statut : </h5>
                <ul>
                    <li><?= $formerOrders[$i]['name_order_status'] ?></li>
                </ul>
            </div>
            <?php $date = new DateTime($formerOrders[$i]['date_customer_order']); ?>
            <div class="order-info">
                <h5>Commande n°<?= $formerOrders[$i]['id'] ?> du <?= $date->format('d/m/Y') ?></h5>
                <h5>Contenu :</h5>
                <ul><?php
                   if ($formerOrders[0]['price_product'] < 0) { ?>
                        <li><?= $formerOrders[0]['name_prize'] ?> (offert) <?php
                    } else { ?>
                        <li><?= $formerOrders[0]['name_product'] ?> (<?= number_format($formerOrders[$i]['price_product'], 2, ',', '') ?>€) <?php
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