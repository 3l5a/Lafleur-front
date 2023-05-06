<?php 

include_once 'App/model/M_Lottery.php';

switch($action) {
    case 'play':
        $prizes = M_Lottery::getPrizes();

        foreach ($prizes as $prize) {
            if ($prize['name_prize'] == "Stylo Lafleur") {
                $styloId = $prize['id'];
                $stylo = $prize['name_prize'];
                $styloQty = $prize['quantity_prize'];
            }
            if ($prize['name_prize'] == "Sac Lafleur") {
                $sacId = $prize['id'];
                $sac = $prize['name_prize'];
                $sacQty = $prize['quantity_prize'];
            }
            if ($prize['name_prize'] == "Porte-clé Lafleur") {
                $cleId = $prize['id'];
                $cle = $prize['name_prize'];
                $cleQty = $prize['quantity_prize'];
            }
            if ($prize['name_prize'] == "Rose rouge") {
                $roseId = $prize['id'];
                $rose = $prize['name_prize'];
                $roseQty = $prize['quantity_prize'];
            }
            if ($prize['name_prize'] == "Bouquet de roses") {
                $bouquetId = $prize['id'];
                $bouquet = $prize['name_prize'];
                $bouquetQty = $prize['quantity_prize'];
            }
        }
        break;
    default:
        break;
}