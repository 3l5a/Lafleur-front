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
        $req = "";

        //check if variables exists, if so, add something to request
        if (!empty($categories)) {
            $inClause = "'" . implode("','", $categories) . "'";
            $req .= " AND category.name_category IN ($inClause)";
        }

        if (!empty($colors)) {
            $inClause = "'" . implode("','", $colors) . "'";
            $req .= " AND color.name_color IN ($inClause)";
        }







        return $products;
    }
}
