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

                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
    }

    /**
     * 
     *
     * @return array
     */
    public static function addOrder()
    {
        //1 create order 
        //2 add order lines
        //dont forget lottery prize
        $req = "";
    }
}
