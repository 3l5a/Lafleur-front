<?php

/**
 * initialize ccart session if it doesn't exist
 */
function initCart()
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
}

/**
 * delete all products
 */
function emptyCart()
{
    unset($_SESSION['cart']);
}

/**
 * add product to cart
 *
 * if product is not in cart, add to cart, else return false 
 * @param $idProduct : identifiant de Product
 * @return bool 
 */
function addToCart($idProduct): bool
{
    $ok = false;
    if (!in_array($idProduct, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $idProduct;
        $ok = true;
    }
    return $ok;
}

/**
 * product IDs included in cart session
 *
 * @return : array of product IDs
 */
function getIdsInCart()
{
    return $_SESSION['cart'];
}

/**
 * number of products in cart
 *
 * if cart session exists, returns its length
 * @return : length/count
 */
function cartNumberProducts()
{
    $n = 0;
    if (isset($_SESSION['cart'])) {
        $n = count($_SESSION['cart']);
    }
    return $n;
}

/**
 * removes ONE(?) product from cart
 *
 * searches for index of idProduct in cart session and unsets it
 * @param $idProduct
 */
function removeFromCart($idProduct)
{
    $index = array_search($idProduct, $_SESSION['cart']);
    unset($_SESSION['cart'][$index]);
}

/**
 * list of errors
 * @param array $msgErrors
 */
function displayErrors(array $msgErrors)
{
    echo '﻿<div class="error"><ul>';
    foreach ($msgErrors as $error) {
        ?>
            <li><?php echo $error ?></li>
        <?php
    }
    echo '</ul></div>';
}

function displayError(string $msg)
{
    echo "<div class=\"error\">" . $msg . "</div>";
}

/**
 * message in blue
 * @param string $msg
 */
function displayMessage(string $msg)
{
    echo '﻿<div class="message">' . $msg . '</div>';
}
