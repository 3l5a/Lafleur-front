<main class="cart">
    <?php if ($success) { ?>
        <h2> Bravo</div>
        <p>Votre commande est validée !</p>
        <p>Nous vous en remercions.</p>
        <p>Pour la fête des mères, Lafleur organise un tirage au sort. Et super nouvelle, chaque tirage est gagnant ! Qu’attendez-vous pour jouer ?</p>
        <a href="index.php?uc=lottery&action=play">Participer à la loterie</a>

    <?php } else {
        var_dump($success); ?>
        <div>Raté</div>
    <?php } ?>
</main>