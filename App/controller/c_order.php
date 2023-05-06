<?php

include_once 'App/model/M_Order.php';
include_once 'App/model/M_Product.php';

switch ($action) {
    case 'placeOrder':
        $customerId = $_SESSION['customer']['id'];

        $deliveryDate = filter_input(INPUT_POST, 'deliveryDate');

        if (strtotime($deliveryDate) == time()) {
            $deliveryDate = DateTime::createFromFormat('Y-m-d', $deliveryDate);
            $deliveryDate =  $deliveryDate->modify('+2 day');
            $deliveryDate = $deliveryDate->format('Y-m-d');
        }

        $totalPrice = M_Product::totalPrice();

        // shipping cost is a bool
        if ($totalPrice > 50) {
            $shippingCost = 0;
        } else {
            $shippingCost = 1;
        }

        $orderId = M_Order::addOrder($customerId, $deliveryDate, 3, $shippingCost);

        foreach ($_SESSION['cart'] as $productId => $qty) {
            $prizeId = 6;
            $success = M_Order::addLineOrder($orderId, $productId, $prizeId, $qty);
        }
        unset($_SESSION['cart']);
        break;
    default:
        break;
}
