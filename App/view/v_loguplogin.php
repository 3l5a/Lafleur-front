<main>
    <div class="log">
        <?php if (!empty($customerSession)) { ?>
            <div class="login">
                <h3>Se connecter</h3>
                <form action="index.php?uc=log&action=logIn" method="POST">
                    <label for="password">Mot de passe :</label>
                    <input type="text" name="password" id="" placeholder="Mot de passe"> <br>
                    <input type="submit" value="Valider" name="check-password">
                </form>
            </div>
        <?php } else { ?>
            <div class="logup">
                <h3>S'inscrire</h3>
                <form action="index.php?uc=log&action=logUp" method="POST">
                    <label for="email">E-mail :</label>
                    <input type="text" name="email" id="" value="<?= $_SESSION['customerEmail'] ?>"> <br>

                    <label for="password">Mot de passe :</label>
                    <input type="text" name="password" id=""> <br>

                    <label for="confirmPwd">Confirmer le mot de passe :</label>
                    <input type="text" name="confirmPwd" id=""> <br>

                    <label for="lastName">Nom :</label>
                    <input type="text" name="lastName" id=""><br>

                    <label for="firstName">Prénom :</label>
                    <input type="text" name="firstName" id=""><br>

                    <label for="address1">Adresse :</label>
                    <input type="text" name="address1" id=""><br>

                    <label for="address2">Complément d'adresse :</label>
                    <input type="text" name="address2" id=""><br>

                    <label for="zip">Code postal :</label>
                    <input type="text" name="zip" id=""><br>

                    <label for="city">Ville :</label>
                    <input type="text" name="city" id=""><br><br>

                    <input type="submit" value="S'inscrire" name="logup">
                </form>
            </div>

        <?php } ?>
    </div>
</main>