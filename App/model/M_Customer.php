<?php
class M_Customer
{
    /**
     * if user is in database, return it's infos
     *
     * @param [type] $email
     * @return mixed
     */
    public static function isCustomer(string $email): mixed
    {
        $req = "SELECT customer.email_customer FROM customer WHERE email_customer = :email";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        return $customer;
    }

    /**
     * checks if city exists, adds it if not
     *
     * @param string $city
     * @param string $zip
     * @return int $cityId
     */
    public static function addCity(string $city, int $zip)
    {
        $searchCity = "SELECT city.id FROM city WHERE name_city = :city AND zip_code_city = :zip";
        $pdo = DataAccess::getPdo();
        $cityStmt = $pdo->prepare($searchCity);
        $cityStmt->bindParam(':city', $city, PDO::PARAM_STR);
        $cityStmt->bindParam(':zip', $zip, PDO::PARAM_INT);
        $cityStmt->execute(); //bool

        if ($cityStmt->rowCount() > 0) {
            $cityId = $cityStmt->fetchAll(PDO::FETCH_ASSOC);
            $cityId = $cityId[0]['id'];
        } else {
            $addCity = "INSERT INTO city (name_city, zip_code_city, deliverable) VALUES (:city, :zip, 0)";
            $pdo = DataAccess::getPdo();
            $stmt = $pdo->prepare($addCity);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':zip', $zip, PDO::PARAM_INT);
            $stmt->execute(); //bool

            $cityId = $pdo->lastInsertId();
        }
        return $cityId;
    }

    /**
     * add customer address
     *
     * @param string $address1
     * @param mixed $address2
     * @param string $cityId
     * @return bool
     */
    public static function addAddress(string $address1, mixed $address2, int $cityId)
    {
        $addAddress = "INSERT INTO address (line1_adress, line2_adress, city_id) VALUES (:address1, :address2, :cityId)";
        $pdo = DataAccess::getPdo();
        $addressStmt = $pdo->prepare($addAddress);
        $addressStmt->bindParam(":address1", $address1, PDO::PARAM_STR);
        $addressStmt->bindParam(":address2", $address2, PDO::PARAM_STR);
        $addressStmt->bindParam(":cityId", $cityId, PDO::PARAM_INT);
        $addressStmt->execute(); //bool
        
        return $addressId = $pdo->lastInsertId();
    }
   
    /**
     * find if customer city is deliverable
     *
     * @param int $customerId
     * @return bool
     */
    public static function isDeliverable(int $customerId): bool
    {
        $req = "SELECT city.deliverable FROM city
        JOIN address ON address.city_id = city.id
        JOIN customer ON customer.address_id = address.id
        WHERE customer.id = :id
        AND city.deliverable = 1";
        $pdo = DataAccess::getPdo();
        $stmt =$pdo->prepare($req);
        $stmt->bindParam(':id', $customerId, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res ? true : false;
    }


    /**
     * add a customer's informations to the DB
     *
     * @param string $lastName
     * @param string $firstName
     * @param int $address
     * @param string $email
     * @param string $password
     * @return bool
     */
    public static function logUp(string $lastName, string $firstName, int $addressId, string $email, string $password): bool
    {
        //add rest of customer info :
        $password = password_hash($password, PASSWORD_BCRYPT);
        $req = "INSERT INTO customer (last_name_customer, first_name_customer, address_id, email_customer, password_customer) 
                VALUES (:lastName, :firstName, :addressId, :email, :pwd)";

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':addressId', $addressId, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pwd', $password, PDO::PARAM_STR);
        $res = $stmt->execute();

        return $res;
    }

    /**
     * allow customer to connect to their account
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public static function logIn(string $email, string $password)
    {
        $req = "SELECT customer.id, 
                    customer.password_customer, 
                    last_name_customer, 
                    first_name_customer, 
                    address_id, 
                    address.line1_adress, 
                    address.line2_adress, 
                    email_customer, 
                    city.name_city,
                    city.zip_code_city 
                FROM customer 
                JOIN address ON customer.address_id = address.id
                JOIN city ON address.city_id = city.id
                WHERE email_customer = :email";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer) {
            $hashedPassword = $customer['password_customer'];
            if (password_verify($password, $hashedPassword)) {
                return $customer;
            };
        }
        return $customer = "";
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
        $req = "UPDATE customer 
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
     * show info of customer
     *
     * @param integer $id
     * @return bool
     */
    public static function show($id): bool
    {
        $req = "SELECT customer.* FROM customer WHERE customer.id = :id"; // manque adresse
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * retrieves all orders from one user
     *
     * @param integer $id
     * @return array
     */
    public static function customerOrderHistory($id): array
    {
        $req = "SELECT customer_order.id,
                        customer_order.date_customer_order,
                        customer_order.delivery_date_customer_order,
                        customer_order.shipping_cost,
                        prize.name_prize,
                        product.name_product, 
                        product.price_product,
                        order_status.name_order_status 
                FROM customer_order
                JOIN line_customer ON line_customer.customer_order_id = customer_order.id
                JOIN product ON line_customer.product_id = product.id
                JOIN order_status ON order_status.id = customer_order.order_status_id
                JOIN prize ON prize.id = line_customer.prize_id
                JOIN customer ON customer.id = customer_order.customer_id
                JOIN address ON customer.address_id = address.id
                JOIN city ON address.city_id = city.id
                WHERE customer.id = :id
                ORDER BY customer_order.date_customer_order DESC";

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
        $req = "DELETE FROM customer WHERE id = :id";

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

    /**
     * unset session to log out of user's account
     *
     * @return void
     */
    public static function logOut(): void
    {
        unset($_SESSION['customer']);
        header('Location: index.php');
        die();
    }
}
