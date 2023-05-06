<?php
include_once 'App/model/M_Order.php';
include_once 'App/model/M_Product.php';
include_once 'App/model/M_Customer.php';

/**
 * Customer account managing
 */
switch ($action) {
    case 'emptyBasket':
        unset($_SESSION['cart']);
        header('Location: index.php?uc=account&action=visit');
        break;
    case 'remove':
        $idProduct = filter_input(INPUT_POST, 'id');
        removeFromCart($idProduct);
        header('Location: index.php?uc=account&action=visit');
        break;
    case 'visit':
        var_dump(date('Y-m-d H:i:s',time()));
        $idCustomer = $_SESSION['customer']['id'];
        $cartIds = $_SESSION['cart']; // associative array [$idProduct => qty in cart]

        $formerOrders = M_Customer::customerOrderHistory($idCustomer);

        $client = M_Customer::show($idCustomer);

        foreach ($cartIds as $id => $qty) {
            $product = M_Product::showOne($id);
            $product['quantity_order_product'] = $qty;

            $cartContent[$id] = $product;
        }

        $totalPrice = M_Product::totalPrice();

        // shipping cost is a bool
        if ($totalPrice > 50) {
            $shippingCost = 0;
        } else {
            $shippingCost = 1;
        }

        $deliverable = M_Customer::isDeliverable($_SESSION['customer']['id']);
        break;
    case 'checkUp': // customer found ? logIn : logUp
        $email = filter_input(INPUT_POST, 'email');
        $customer = M_Customer::isCustomer($email);

        $_SESSION['customer'] = $customer; //only puts email in session
        $_SESSION['customerEmail'] = $email;
        header('Location: index.php?uc=log');
        break;
    case 'logUp':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $address1 = filter_input(INPUT_POST, 'address1');
        $address2 = filter_input(INPUT_POST, 'address2');
        $zip = filter_input(INPUT_POST, 'zip');
        $city = filter_input(INPUT_POST, 'city');
        $samePassword = filter_input(INPUT_POST, 'confirmPwd');

        $address2 = empty($address2) ? NULL : $address2; //if input empty, data = NULL

        $errors = M_Customer::isValid($lastName, $firstName, $address1, $city, $zip, $email);

        //checks if customer hasn't changed their email to put one that is already in DB
        if (M_Customer::isCustomer($email)) {
            displayError("Vous avez déjà un compte, veuillez vous connecter");
        }

        if (!$errors) {
            if ($password === $samePassword) {
                $cityId = M_Customer::addCity($city, $zip);
                $addressId = M_Customer::addAddress($address1, $address2, $cityId);
                $registered = M_Customer::logUp($lastName, $firstName, $addressId, $email, $password);
                displayMessage("Vous avez bien créé un compte, vous pouvez vous identifier désormais");
            } else {
                displayError("Le mot de passe n'est pas identique");
            }
        } else {
            displayErrors($errors);
        }
        break;
    case 'logIn':
        $password = filter_input(INPUT_POST, 'password');
        $email = $_SESSION['customerEmail'];
        $customer = M_Customer::logIn($email, $password);

        if (!empty($customer)) {
            displayMessage("Bienvenue '.$customer.' !");
            $_SESSION['customer'] = $customer;
            header('Location: index.php');
        } else {
            displayError("Mauvais mot de passe");
        }
        break;
    case 'logOut':
        M_Customer::logOut();
        break;
    case 'manage':
        break;
    case 'delete':
        break;
}
