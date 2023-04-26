<?php

session_start();
// unset($_SESSION);
var_dump($_SESSION['cart']);

// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Attention : A supprimer en production !!!

require('./util/functions.inc.php');
require('./util/validators.inc.php');
require('./App/model/DbAccess.php');

$customerSession = [];

if (!empty($_SESSION['customer'])) {
    $customerSession = $_SESSION['customer'];
}

$uc = filter_input(INPUT_GET, 'uc');
$action = filter_input(INPUT_GET, 'action');
$id = filter_input(INPUT_GET, 'id'); // id of a product
initCart();

if (!$uc) {
    $uc = 'home';
}

switch ($uc) {
        //products
    case 'home':
        include 'App/controller/c_consultation.php';
        break;
    case 'all':
        include 'App/controller/c_consultation.php';
        include 'App/controller/c_manageCart.php';
        break;
    case 'product':
        include 'App/controller/c_consultation.php';
        include 'App/controller/c_manageCart.php';
        break;

        //customer account management
    case 'isRegistered':
        include 'App/controller/c_account.php';
        break;
    case 'log':
        include 'App/controller/c_account.php';
        break;
    case 'account':
        include 'App/controller/c_account.php';
        break;
    case 'cart':
        include '';
        break;

        //misc
    case 'us':
        break;
    case 'terms':
        break;
    case 'lottery':
        include 'App/controller/c_lottery.php';
        break;

    default:
        break;
}



include('App/view/template.php');
