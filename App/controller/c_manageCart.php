<?php

include 'App/model/M_Product.php';

switch ($action) {
    case 'add':
        $productId = filter_input(INPUT_GET, 'id');
        addToCart($productId);
        break;
    case 'show':
        $cartContent = $_SESSION['cart'];
        break;
    default:
        break;
}
