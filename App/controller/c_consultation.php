<?php

include 'App/model/M_Product.php';
include 'App/model/M_Choice.php';



switch ($action) {
    case 'catalogue':
        $colors = M_Choice::findColors();
        $categories = M_Choice::findCategories();

        if (isset($_POST['color'])) {
            $colorSelected[] = $_POST['color'];
        } else {
            $colorSelected = null;
        }
        if (isset($_POST['category'])) {
            $categorySelected[] = $_POST['category'];
        } else {
            $categorySelected = null;
        }

        $products = M_Choice::showSelected($colorSelected, $categorySelected);
        break;
    case 'roses':
        $colorSelected;
        $categorySelected = ["roses"];

        $products = M_Choice::showSelected($colorSelected, $categorySelected);
    case 'unit':
        $colorSelected;
        $categorySelected = ["fleurs à l'unité"];

        $products = M_Choice::showSelected($colorSelected, $categorySelected);
        break;
    case 'show':
        $productId;
        break;
    default:
        break;
}
