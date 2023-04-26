<?php

class M_Order
{
    /**
     * get quantity of product then sets it to quantity - $qty
     *
     * @return bool
     */
    public static function decrementQty($id, $qty)
    {
        //get product quantity
        $req = "SELECT product.quantity_product FROM product WHERE product.id = :id";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $dbQty = $stmt->fetch(PDO::FETCH_ASSOC);

        $newQty = $dbQty['quantity_product'] - $qty;

        $req2 = "UPDATE product SET product.quantity = :newQty WHERE product.id = :id";
        $pdo = DataAccess::getPdo();
        $stmt2 = $pdo->prepare($req2);
        $stmt2->bindParam(':newQty', $newQty, PDO::PARAM_INT);
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();

        $dbQty = $stmt2->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * get ids of products in cart and 
     */
    public static function findProduct($id)
    {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $qty) {
                $req = "SELECT product.name_product, product.price_product, product.image_product, product.id, product.quantity_product 
                FROM product
                WHERE product.id = :id";
                $pdo = DataAccess::getPdo();
                $stmt = $pdo->prepare($req);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }

    /**
     * create order ref (id)
     *
     * @return order id
     */
    public static function addOrder($customerId, $deliveryDate, $statusId, $shippingCost)
    {
        $req = "INSERT INTO customer_order (customer_id, delivery_date_customer_order, order_status_id, shipping_cost)
                VALUES (:customerId, ':deliveryDate', :statusId, :shippingCost)";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
        $stmt->bindParam(':deliveryDate', $deliveryDate, PDO::PARAM_STR);
        $stmt->bindParam(':statusId', $statusId, PDO::PARAM_INT);
        $stmt->bindParam(':shippingCost', $shippingCost, PDO::PARAM_INT);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

    /**
     * create order ref (id)
     *
     * @return order id
     */
    public static function addLineOrder($orderId, $productId, $prizeId, $qty)
    {
        $req = "INSERT INTO line_customer (customer_order_id, product_id, prize_id, quantity_line_customer)
        VALUES (:orderId, :productId, :prizeId, :qty)";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':prizeId', $prizeId, PDO::PARAM_INT);
        $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
