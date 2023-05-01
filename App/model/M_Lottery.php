<?php
if (isset(($_GET['play']))) {
        $req = "SELECT prize.name_prize, prize.quantity_prize FROM prize
                WHERE prize.quantity_prize > 0";
        $pdo = DataAccess::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $prizes = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $data = [];
        foreach ($prizes as $prize) {
            if ($prize['name_prize'] == 'Stylo Lafleur') {
                $emoji = "🖊️";
            }
            if ($prize['name_prize'] == 'Sac Lafleur') {
                $emoji = "👜";
            }
            if ($prize['name_prize'] == 'Porte-clé Lafleur') {
                $emoji = "🔑";
            }
            if ($prize['name_prize'] == 'Rose rouge') {
                $emoji = "🌹";
            }
            if ($prize['name_prize'] == 'Bouquet de roses') {
                $emoji = "💐";
            }

            $data[] = [
                "emoji" => $emoji,
                "qty" => $prize["quantity_prize"]
            ];

        //     $data[] = [$emoji, $prize['quantity_prize']];
        }
        return json_encode($data);
}

