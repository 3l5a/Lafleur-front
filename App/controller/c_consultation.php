<?php

include 'App/model/M_Product.php';
include 'App/model/M_Choice.php';



switch ($action) {
    case 'catalogue':
        $colors = M_Choice::findColors();
        $categories = M_Choice::findCategories();

        $colorSelected = $_GET['color'];
        $categorySelected = $_GET['category'];

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
    case 'show':
        $productId;
        break;
    default:
        break;
}
