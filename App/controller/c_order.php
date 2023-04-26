<?php

include_once 'App/model/M_Order.php';
include_once 'App/model/M_Product.php';

switch ($action) {
    case 'placeOrder':
        $customerId = $_SESSION['customer']['id'];
        $deliveryDate =  new DateTime();
        $deliveryDate =  $deliveryDate->format('Y-m-d H:i:s');;

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

        echo "<br>";
        var_dump($customerId); 
        echo "<br>";
        var_dump($deliveryDate);
        echo "<br>";
        var_dump($shippingCost);
        echo "<br>";
        $orderId = M_Order::addOrder($customerId, $deliveryDate, 3, $shippingCost);

        foreach ($_SESSION['cart'] as $productId => $qty) {
            $prizeId = 12;
            return $success = M_Order::addLineOrder($orderId, $productId, $prizeId, $qty);
        }

        break;
    default:
        break;
}
