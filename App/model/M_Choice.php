<?php

class M_Choice
{
    /**
     * Find all color names and codes
     *
     * @return associative array
     */
    public static function findColors(): array
    {
        $req = "SELECT color.name_color, color.code_color FROM color";
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
        $req = "SELECT category.name_category FROM category";
        $res = DataAccess::query($req);
        $categories = $res->fetchAll();

        return $categories;
    }

    /**
     * Return products (id + name + price + image) depending on user input
     *
     * @return array
     */
    public static function showSelected($colors, $categories): array
    {
        //base request
        $req = "SELECT p.*, GROUP_CONCAT(DISTINCT c.name_category SEPARATOR ', ') AS categories, GROUP_CONCAT(DISTINCT co.name_color SEPARATOR ', ') AS colors
                FROM product p
                INNER JOIN product_category pc ON p.id = pc.product_id
                INNER JOIN category c ON pc.category_id = c.id
                INNER JOIN product_composition pc2 ON p.id = pc2.product_id
                INNER JOIN supplied_item si ON pc2.supplied_item_id = si.id
                INNER JOIN color co ON si.color_id = co.id
                GROUP BY p.id;";

        //add something to request if variables exists
        if (!empty($categories)) {
            $inClause = "'" . implode("','", $categories) . "'";
            $req .= " AND category.name_category IN ($inClause)";
        }

        if (!empty($colors)) {
            $inClause = "'" . implode("','", $colors) . "'";
            $req .= " AND color.name_color IN ($inClause)";
        }

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
}
