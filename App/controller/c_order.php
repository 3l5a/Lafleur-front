<?php

include_once 'App/model/M_Order.php';
include_once 'App/model/M_Product.php';

switch ($action) {
    case 'placeOrder':
        $customerId = $_SESSION['customer']['id'];
        $deliveryDate = filter_input(INPUT_POST, 'deliveryDate');
        $deliveryDate =  new DateTime();
        $deliveryDate =  $deliveryDate->format('Y-m-d H:i:s');


        $priceBeforeDelivery = 0;
        foreach ($_SESSION['cart'] as $productId => $qty) {
            $product = M_Product::showOne($productId);
            $price = $product['price_product'] * $qty;
            $priceBeforeDelivery += $price;
        }

        // shipping cost is a bool
        if ($priceBeforeDelivery > 50) {
            $shippingCost = 0;
        } else {
            $shippingCost = 1;
        }

        $orderId = M_Order::addOrder($customerId, $deliveryDate, 3 , $shippingCost);

        foreach ($_SESSION['cart'] as $productId => $qty) {
            $prizeId = 6;
            $success = M_Order::addLineOrder($orderId, $productId, $prizeId, $qty);
            var_dump($orderId);
            var_dump($productId);
            var_dump($prizeId);
            var_dump($qty);
        }

        break;
    default:
        break;
}
