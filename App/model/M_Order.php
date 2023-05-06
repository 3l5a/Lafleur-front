<?php

class M_Order
{

    /**
     * retrive id of last order by customer
     *
     * @param [type] $customer Id
     * @return int
     */
    public static function getLastOrder($customerId)
    {
        $req = "SELECT line_customer.customer_order_id FROM line_customer
                JOIN customer_order ON customer_order.id = line_customer.customer_order_id
                WHERE customer_order.customer_id = :customerId
                ORDER BY customer_order.date_customer_order DESC 
                LIMIT 1";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * retrive id of won prize and adds it to customer's last order
     *
     * @param [type] $prizeId
     * @return bool
     */
    public static function addPrize($prizeId, $orderId)
    {
        $req = "INSERT INTO line_customer (customer_order_id, product_id, prize_id, quantity_line_customer)
                VALUES (:orderId, 12, :prizeId, 1)"; //12 = placeholder for product id, 1 = qty of prize won
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':prizeId', $prizeId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * retrive id of won prize and adds it to customer's last order
     *
     * @param [type] $prizeId
     * @return bool
     */
    public static function decrementPrize($prizeId)
    {
        $req = "UPDATE prize 
                SET quantity_prize = quantity_prize - 1
                WHERE prize.id = :prizeId";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':prizeId', $prizeId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * get quantity of product then sets it to quantity - $qty
     *
     * @return bool
     */
    public static function decrementProduct($id, $qty)
    {
        $req = "UPDATE product 
                SET product.quantity_product = quantity_product - :qty 
                WHERE product.id = :id";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * create new order
     *
     * @return int id of an order
     */
    public static function addOrder($customerId, $deliveryDate, $statusId, $shippingCost): int
    {
        $req = "INSERT INTO customer_order (customer_id, delivery_date_customer_order, order_status_id, shipping_cost)
                VALUES (:customerId, :deliveryDate, :statusId, :shippingCost)";
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
     * create one line of order
     *
     * @return bool if product was correctly inserted in DB
     */
    public static function addLineOrder($orderId, $productId, $prizeId, $qty): bool
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
