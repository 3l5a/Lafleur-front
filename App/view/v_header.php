<header>
    <div class="store-info">
        Livraison en 1 jour, gratuite à partir de 50€
    </div>
    <a href="index.php" class="logo-desktop">
        <img src="public/assets/logo-lafleur.svg" alt="" class="logo" />
        <p class="name-logo">LAFLEUR</p>
        <p class="city desktop">Lourmarin</p>
    </a>
    <nav>
        <div class="nav-container">
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">&times;</a>
                <ul class="nav-links">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?uc=all">Toutes nos fleurs</a></li>
                    <li><a href="index.php">Fleurs à l'unité</a></li>
                    <li><a href="index.php">Roses</a></li>
                    <li><a href="index.php?uc=us">Qui sommes-nous</a></li>
                </ul>
            </div>
            <a href="#" id="openBtn">
                <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <div class="logo-mobile">
                <p class="name-logo mobile">LAFLEUR</p>
                <p class="city mobile">Lourmarin</p>
            </div>
            <ul class="customer-links">
                <li>
                    <?php
                    if (!empty(($_SESSION['customer'])) && count($_SESSION['customer'])>1) {
                    ?><a href="index.php?uc=account"> <?php
                    } else { 
                    ?><a href="index.php?uc=isRegistered"><?php
                    }?>
                        <img src="public/assets/customer-icon.svg" alt="accès compte" title="Accès compte" /></a>
                </li>
                <li>
                    <img src="public/assets/basket-icon.svg" alt="accès compte" title="Accès panier" />
                </li>
            </ul>
        </div>
    </nav>
</header>