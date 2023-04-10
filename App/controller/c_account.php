<?php
include 'App/modele/M_Session.php';
include 'App/modele/M_Customer.php';

/**
 * Customer account managing
 */
switch ($action) {
    case 'checkIn': // if customer found : redirect to logIn, else redirect to logUp
        $email = filter_input(INPUT_POST, 'email');
        $customer = M_Customer::isCustomer($email);

        if ($customer) {
            $_SESSION['customer'] = $customer;
            header('Location: index.php?uc=accueil');
        } else {
            errorMessage("Identifiant et/ou mot de passe incorrects");
        }
        break;
    case 'logUp':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $address = filter_input(INPUT_POST, 'address');
        $zipCode = filter_input(INPUT_POST, 'zipCode');
        $city = filter_input(INPUT_POST, 'city');
        $sameMdp = filter_input(INPUT_POST, 'confirmMdp');

        $errors = M_Customer::isValid($lastName, $firstName, $address, $city, $zip, $email);

        if (!$errors) {
                if ($mdpInscr === $compareMdp){
                    $user = M_Customer::checkEmail($email);
                    if ($user == true) {
                        displayError("Vous avez déjà un compte sur Lord of Geek, veuillez vous connecter");
                    } else {
                        $registered = M_Customer::logUp($lastName, $firstName, $address, $zip, $city, $email, $mdpInscr);
                        displayMessage("Vous avez bien créé un compte, vous pouvez vous identifier désormais");
                    }
            } else {
                displayError("Le mot de passe n'est pas identique");
            }
        } else {
            displayErrors($errors);
        }
        break;
    case 'LogIn':
        break;
    case 'logOut':
        break;
    case 'manage':
        break;
    case 'delete':
        break;
}
