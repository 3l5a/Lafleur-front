<?php
class M_Customer
{
    /**
     * if user is in database, session = client's informations
     *
     * @param [type] $email
     * @return void
     */
    public static function isCustomer(string $email)
    {
        $req = "SELECT customers.email FROM customers WHERE email = :email";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer) {
            return $customer;
        } else {
            return false;
        }
    }

    /**
     * unset session to log out of user's account
     *
     * @return void
     */
    public static function logOut()
    {
        unset($_SESSION['customer']);
        header('Location: index.php');
        die();
    }

    /**
     * add an user's informations to the database
     *
     * @param [type] $lastName
     * @param [type] $firstName
     * @param [type] $address
     * @param [type] $zip
     * @param [type] $city
     * @param [type] $email
     * @param [type] $password
     * @return bool
     */
    public static function logUp(string $lastName, string $firstName, $address, int $zip, string $city, string $email, string $password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $req = "INSERT INTO clients (lastName, firstName, address, zip, city, email, mot_de_passe) 
                VALUES (:lastName, :firstName, :address, :zip, :city, :email, :password)";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':zip', $zip, PDO::PARAM_INT);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $res = $stmt->execute();

        return $stmt;
    }


    /**
     * checck if user exists before logging in or logging up
     *
     * @param [type] $email
     * @param [type] $pwd
     * @return false if not found, array if found
     */
    public static function findUserWithPwd(string $email, string $pwd): mixed
    {
        $req = "SELECT customers.* FROM customers WHERE email = :email";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer) {
            $pwdcustomer = $customer['password'];
            $pwd = password_verify($pwd, $pwdcustomer);
        }

        return $customer;
    }

    /**
     * checks if user is in database
     *
     * @param string $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        $req = "SELECT customers.* FROM customers WHERE email = :email";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * update a client's personnal informations
     *
     * @param [type] $idUser
     * @param [type] $lastName
     * @param [type] $firstName
     * @param [type] $address
     * @param [type] $zip
     * @param [type] $city
     * @return bool
     */
    public static function update(int $idUser, string $lastName, string $firstName, string $address, int $zip, string $city): bool
    {
        $req = "UPDATE customers 
                SET lastName= :lastName, firstName = :firstName, address = :address, zip = :zip, city = :city 
                WHERE id = :idUser";

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':zip', $zip, PDO::PARAM_INT);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        return $stmt->execute();
    }


    /**
     * Retrieve all orders from one user
     *
     * @param integer $id
     * @return array
     */
    public static function userOrders($id): array
    {
        $req = "SELECT DISTINCT orders.*, references_jeux.titre, consoles.nom_console FROM orders
                JOIN exemplaires ON exemplaires.reference_jeu_id = reference_jeu_id
                JOIN lignes_commande ON orders.id = lignes_commande.commande_id AND exemplaires.id = lignes_commande.exemplaire_id
                JOIN references_jeux ON exemplaires.reference_jeu_id = references_jeux.id
                JOIN consoles ON consoles.id = exemplaires.consoles_id
                WHERE client_id = :id 
                GROUP BY created_at, references_jeux.titre
                ORDER BY created_at desc";

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }

    /**
     * Delete a customer account
     *
     * @param integer $id
     * @return bool
     */
    public static function delete($id): bool
    {
        $req = "DELETE FROM WHERE id = :id";

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        return true;
    }

    /**
     * returns empty array if no errors, else returns array of errors
     *
     * @param $lastName : string
     * @param $address : string
     * @param $city : string
     * @param $zip : string
     * @param $email : string
     * @return : array
     */
    public static function isValid($lastName, $firstName, $address, $city, $zip, $email): array 
    {
        $errors = [];
        if ($lastName == "") {
            $errors[] = "Il faut saisir le champ nom";
        }
        if ($firstName == "") {
            $errors[] = "Il faut saisir le champ prénom";
        }
        if ($address == "") {
            $errors[] = "Il faut saisir le champ adresse";
        }
        if ($city == "") {
            $errors[] = "Il faut saisir le champ ville";
        }
        if ($zip == "") {
            $errors[] = "Il faut saisir le champ code postal";
        } else if (!iszip($zip)) {
            $errors[] = "Erreur de code postal";
        }
        if ($email == "") {
            $errors[] = "Il faut saisir le champ email";
        } else if (!isEmail($email)) {
            $errors[] = "Erreur de email";
        }
        return $errors;
    }

}
