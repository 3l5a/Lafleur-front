<?php

class M_Product
{

    // index + show + sortBy

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux de la
     * catégorie passée en argument
     *
     * @param $idCategorie
     * @return un tableau associatif
     */
    public static function index(int $idCategorie): array
    {
        // couleur, nom, photo, alt, composition
        $req = "SELECT exemplaires.*, references_jeux.titre, consoles.nom_console, etats.nom_etat FROM exemplaires
                JOIN references_jeux ON exemplaires.reference_jeu_id = references_jeux.id
                JOIN references_jeux_has_categories ON references_jeux.id = references_jeux_has_categories.reference_jeu_id
                JOIN categories ON references_jeux_has_categories.categorie_id = categories.id
                JOIN etats ON exemplaires.etat_id = etats.id
                JOIN consoles ON exemplaires.consoles_id = consoles.id
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
     * @param $desIdJeux tableau d'idProduits
     * @return un tableau associatif
     */
    public static function trouveLesJeuxDuTableau(array $desIdJeux)
    {
        $nbProduits = count($desIdJeux);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($desIdJeux as $unIdProduit) {
                $req = "SELECT exemplaires.*, references_jeux.titre, etats.nom_etat FROM exemplaires 
                        JOIN references_jeux ON exemplaires.reference_jeu_id = references_jeux.id
                        JOIN etats ON exemplaires.etat_id = etats.id
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
     * Retourne tous les jeux en vente, dans le stock
     *
     * @return tableau associatif
     */
    public static function trouveTousLesJeux()
    {
        $reqJeux = "SELECT DISTINCT exemplaires.* , references_jeux.titre, etats.nom_etat, consoles.nom_console FROM exemplaires
                    JOIN references_jeux ON exemplaires.reference_jeu_id = references_jeux.id
                    JOIN references_jeux_has_categories ON references_jeux.id = references_jeux_has_categories.reference_jeu_id
                    JOIN categories ON references_jeux_has_categories.categorie_id = categories.id
                    JOIN etats ON exemplaires.etat_id = etats.id
                    JOIN consoles ON exemplaires.consoles_id=consoles.id";
        // requete pour obtenir tous les jeux avec leurs titre + état + prix de vente + image + console du jeu
        $res2 = DataAccess::query($reqJeux);
        $tousLesJeux = $res2->fetchAll();

        return $tousLesJeux;
    }

    /**
     * retourne un tableau assoc des infos d'un jeu dont l'id est l'argument
     *
     * @param [type] $idJeu
     * @return [type] tableau associatif
     */
    public static function trouveUnJeu(int $idJeu)
    {
        $req = "SELECT exemplaires.*, references_jeux.titre, consoles.nom_console, etats.nom_etat, series.nom_serie FROM exemplaires
                JOIN references_jeux ON exemplaires.reference_jeu_id = references_jeux.id
                JOIN references_jeux_has_categories ON references_jeux.id = references_jeux_has_categories.reference_jeu_id
                JOIN categories ON references_jeux_has_categories.categorie_id = categories.id
                JOIN etats ON exemplaires.etat_id = etats.id
                JOIN consoles ON exemplaires.consoles_id = consoles.id
                LEFT JOIN series ON references_jeux.series_id = series.id
                WHERE exemplaires.id = :idJeu";

        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':idJeu', $idJeu, PDO::PARAM_INT);
        $stmt->execute();

        $leJeu = $stmt->fetch(PDO::FETCH_ASSOC);
        return $leJeu;
    }
}
