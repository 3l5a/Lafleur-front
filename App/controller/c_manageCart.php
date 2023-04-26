<?php


switch ($action) {
    case 'add':
        $productId = filter_input(INPUT_GET, 'id');
        addToCart($productId, $uc);
        break;
    case 'delete':
        unset($_SESSION['cart']);
        break;
}
