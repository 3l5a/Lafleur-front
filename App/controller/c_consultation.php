<?php

include 'App/model/M_Product.php';

switch ($action) {
    case 'catalogue':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        if (isset($_POST['color'])) {
            $colorSelected = $_POST['color'];
        } else {
            $colorSelected = null;
        }
        if (isset($_POST['category'])) {
            $categorySelected = $_POST['category'];
        } else {
            $categorySelected = null;
        }

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'roses':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["7"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
    case 'unit':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();
        
        $colorSelected = null;
        $categorySelected = ["6"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'show':
        $productId = filter_input(INPUT_GET, 'id');
        $product = M_Product::showOne($productId);
        break;
    default:
        break;
}
