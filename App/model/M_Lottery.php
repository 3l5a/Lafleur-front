<?php


class M_Lottery
{
    public static function getPrizes()
    {
            $req = "SELECT prize.name_prize, prize.quantity_prize, prize.id FROM prize
                    WHERE prize.quantity_prize > -1";
            $pdo = DataAccess::getPdo();
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
