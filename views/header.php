<header>
    <div class="divA"><a class="aTitre" href="index.php">Accueil</a></div>
    <a class="aImg" href="/livre-or/views/index.php"><img src="/livre-or\public\img\logo-echobook.png" alt="logo echobook"></a>
        <nav class="menuhd">
            <ul>
            <ul>
            <?php 
                if (isset($_SESSION['utilisateur']) == 0) {
                    echo "<li><a href='connexion.php'>Connexion</a></li>";
                    echo "<li><a href='inscription.php'>Inscription</a></li>";
                }
                else {
                    echo "<li><a href='../configuration/deconnexion.php'><i class='fa-solid fa-right-from-bracket'></i>Se déconnecter</a></li>";
                }
            ?>
        </ul>
            </ul>
        </nav>
        <button popovertarget="menu">
            <hr>
            <hr>
            <hr>
        </button>
        <nav class="menuMobile" popover role="menu" id="menu">
            <button popovertarget="menu" popovertargetaction="hide">
                <hr>
                <hr>
                <hr>
            </button>
            <a class="aImg" href="/livre-or/index.php"><img src="/livre-or\public\img\logo-echobook.png" alt="logo echobook"></a>
            <ul>
                <li><a href="index.php" id="aTitreM">Accueil</a></li>
                <?php 
                    if (isset($_SESSION['utilisateur']) == 0) {
                        echo "<li><a href='connexion.php'>Connexion</a></li>";
                        echo "<li><a href='inscription'>Inscription</a></li>";
                    }
                    else {
                        echo "<li><a href='/livre-or/views/dashboard.php'>Profil</a></li>";
                        echo "<li><a href='/livre-or/views/form-commentaire.php'>Rediger</a></li>";
                        echo "<li><a href='/livre-or/views/commentaire.php'>Liste</a></li>";
                        echo "<li><a href='/livre-or/views/modifier-commentaire.php'>Modifier</a></li>";
                        echo "<li><a href='/livre-or/views/supprimer-commentaire.php'>Supprimer</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>