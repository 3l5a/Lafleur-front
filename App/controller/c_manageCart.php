<?php


switch ($action) {
    case 'add':
        $productId = filter_input(INPUT_GET, 'id');
        addToCart($productId, $uc, $action);
        break;
    case 'remove' :
        $productId = filter_input(INPUT_GET, 'id');
        removeFromCart(intval($productId));
        break;
    case 'delete':
        unset($_SESSION['cart']);
        break;
}
