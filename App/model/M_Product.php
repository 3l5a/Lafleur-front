<?php

class M_Product
{

    // index + show + sortBy

    /**
     * Retourne tous les jeux en vente, dans le stock
     *
     * @return tableau associatif
     */
    public static function index()
    {
        $req = "SELECT DISTINCT exemplaires.* , references_jeux.titre, etats.nom_etat, consoles.nom_console FROM exemplaires
                    JOIN etats ON exemplaires.etat_id = etats.id
                    JOIN consoles ON exemplaires.consoles_id=consoles.id";
        // requete pour obtenir tous les jeux avec leurs titre + état + prix de vente + image + console du jeu
        $res = DataAccess::query($req);
        $allProducts = $res->fetchAll();

        return $allProducts;
    }

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux de la
     * catégorie passée en argument
     *
     * @param $idCategorie
     * @return un tableau associatif
     */
    public static function findBy(int $idCategorie): array
    {
        // couleur, nom, photo, alt, composition
        $req = "SELECT exemplaires.*, etats.nom_etat FROM exemplaires
                WHERE categories.id = :idCat";

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':idCat', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();

        $lesLignes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }

    /**
     * Retourne les jeux concernés par le tableau des idProduits passé en argument
     *
     * @param $someProducts tableau d'idProduits
     * @return un tableau associatif
     */
    public static function trouveLesJeuxDuTableau(array $someProducts)
    {
        $nbProduits = count($someProducts);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($someProducts as $unIdProduit) {
                $req = "SELECT exemplaires.*, references_jeux.titre, etats.nom_etat FROM exemplaires 
                        WHERE exemplaires.id = :id";
                $pdo = DataAccess::getPdo();
                $stmt = $pdo->prepare($req);
                $stmt->bindParam(':id', $unIdProduit, PDO::PARAM_INT);
                $stmt->execute();

                $unProduit = $stmt->fetch();
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }

    /**
     * all info from one product
     *
     * @param [type] $idProduct
     * @return [type] tableau associatif
     */
    public static function show(int $idProduct)
    {
        $req = "SELECT exemplaires.*, references_jeux.titre, consoles.nom_console, etats.nom_etat, series.nom_serie FROM exemplaires
                JOIN references_jeux ON exemplaires.reference_jeu_id = references_jeux.id
                JOIN references_jeux_has_categories ON references_jeux.id = references_jeux_has_categories.reference_jeu_id
                JOIN categories ON references_jeux_has_categories.categorie_id = categories.id
                JOIN etats ON exemplaires.etat_id = etats.id
                JOIN consoles ON exemplaires.consoles_id = consoles.id
                LEFT JOIN series ON references_jeux.series_id = series.id
                WHERE exemplaires.id = :idProduct";

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
        $stmt->execute();

        $leProduct = $stmt->fetch(PDO::FETCH_ASSOC);
        return $leProduct;
    }

    /**
     * returns 4 products among one category
     *
     * @param [type] $allProducts
     * @return [type] 4 products
     */
    public static function randomProducts(int $allProducts)
    {
    }
}
