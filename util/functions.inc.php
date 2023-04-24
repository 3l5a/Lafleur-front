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
 * @param $idProduct : identifiant de Product
 * @return bool 
 */
function addToCart($idProduct)
{
    $_SESSION['cart'][] = $idProduct;
}

/**
 * product IDs included in cart session
 *
 * @return : array of product IDs
 */
function getCartId()
{
    return $_SESSION['cart'];
}

/**
 * number of products in cart
 *
 * if cart session exists, returns its length
 * @return : length/count
 */
function cartCount()
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
