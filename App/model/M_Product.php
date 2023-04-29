<?php

class M_Product
{
    /**
     * Find all color names and codes
     *
     * @return associative array
     */
    public static function findColors(): array
    {
        $req = "SELECT color.name_color, color.code_color, color.id FROM color";
        $res = DataAccess::query($req);
        $colors = $res->fetchAll();

        return $colors;
    }

    /**
     * Find all category names
     *
     * @return array
     */
    public static function findCategories(): array
    {
        $req = "SELECT category.name_category, category.id FROM category";
        $res = DataAccess::query($req);
        $categories = $res->fetchAll();

        return $categories;
    }

    /**
     * Return products (id + name + price + image) depending on user input
     *
     * @return array
     */
    public static function indexSelected($colors, $categories): array
    {
        //base request
        $req = "SELECT DISTINCT product.name_product, product.id, product.price_product, product.description_product, product.image_product, product.quantity_product
                FROM product
                LEFT JOIN product_composition ON product.id = product_composition.product_id
                LEFT JOIN supplied_item ON product_composition.supplied_item_id = supplied_item.id
                LEFT JOIN color ON supplied_item.color_id = color.id
                LEFT JOIN product_category ON product.id = product_category.product_id
                LEFT JOIN category ON product_category.category_id = category.id";


        if (!empty($categories) && !empty($colors)) {
            //add something to request if variables exists
            $inClauseCat = "'" . implode("','", $categories) . "'";
            $req .= " WHERE category.id IN ($inClauseCat)";

            $inClauseCol = "'" . implode("','", $colors) . "'";
            $req .= " OR color.id IN ($inClauseCol)";
        }

        if (!empty($categories) && empty($colors)) {
            $inClauseCat = "'" . implode("','", $categories) . "'";
            $req .= " WHERE category.id IN ($inClauseCat)";
        }

        if (empty($categories) && !empty($colors)) {
            $inClauseCol = "'" . implode("','", $colors) . "'";
            $req .= " WHERE color.id IN ($inClauseCol)";
        }

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    public static function showOne($id): array
    {
        $req = "SELECT product.name_product, product.id, product.quantity_product, product.price_product, product.image_product, product.description_product
                FROM product
                WHERE product.id = :id";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /////////////////////////////////////////////// LOG 
    /**
     * Retourne les jeux concernés par le tableau des idProduits passé en argument
     *
     * @param $someProducts tableau d'idProduits
     * @return un tableau associatif
     */
    public static function trouveLesJeuxDuTableau(array $someProducts)
    {
        $nbProduits = count($someProducts);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($someProducts as $unIdProduit) {
                $req = "SELECT exemplaires.*, references_jeux.titre, etats.nom_etat FROM exemplaires 
                        WHERE exemplaires.id = :id";
                $pdo = DataAccess::getPdo();
                $stmt = $pdo->prepare($req);
                $stmt->bindParam(':id', $unIdProduit, PDO::PARAM_INT);
                $stmt->execute();

                $unProduit = $stmt->fetch();
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }

    /**
     * returns 4 products among one category
     *
     * @param [type] $allProducts
     * @return [type] 4 products
     */
    public static function randomProducts(int $allProducts)
    {
    }
}
