<?php

session_start();
// unset($_SESSION); //debug

// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Attention : A supprimer en production !!!

// require("./util/fonctions.inc.php");
// require('./util/validateurs.inc.php');
// require("./App/modele/AccesDonnees.php");

$customerSession = [];

if (!empty($_SESSION['customer'])) {
    $customerSession = $_SESSION['customer'];
} // si $_SESSION existe, alors il définit $customerSession 
// $_SESSION['customer'] est défini dans le controleur du compte customer


$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
$id = filter_input(INPUT_GET, 'id'); // id of a product
// initPanier();

if (!$uc) {
    $uc = 'home';
}

// main controller
switch ($uc) {
    // case 'account':
    //     include 'App/controleur/c_consultation.php';
    //     break;
    // case 'visite':
    //     include 'App/controleur/c_consultation.php';
    //     break;
    default:
        break;
}


include("App/view/template.php");
