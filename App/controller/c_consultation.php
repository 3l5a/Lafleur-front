<?php

include_once 'App/model/M_Product.php';

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
    case '':
        //allow to display 4 items of each category in homepage
        $colorSelected = null;
        $roses = array_slice(M_Product::indexSelected($colorSelected, ["7"]), 0, 4);
        $unitFlowers = array_slice(M_Product::indexSelected($colorSelected, ["6"]), 0,  4);
        $mothersDays = array_slice(M_Product::indexSelected($colorSelected, ["9"]), 0,  4);
    case 'mothersday':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["9"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'roses':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["7"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'unit':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["6"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'wedding':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["10"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'birth':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["1"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'birthday':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["5"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'feels':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["3"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'thanks':
        $colors = M_Product::findColors();
        $categories = M_Product::findCategories();

        $colorSelected = null;
        $categorySelected = ["4"];

        $products = M_Product::indexSelected($colorSelected, $categorySelected);
        break;
    case 'show':
        $productId = filter_input(INPUT_GET, 'id');
        $product = M_Product::showOne($productId);
        break;
    default:
        break;
}
