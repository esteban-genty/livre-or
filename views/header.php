<header>
    <div class="divA"><a class="aTitre" href="index.php">Accueil</a></div>
    <a class="aImg" href="/livre-or/views/index.php"><img src="/livre-or\public\img\logo-echobook.png" alt="logo echobook"></a>
        <nav class="menuhd">
            <ul>
            <ul>
            <?php 
                if (isset($_SESSION['utilisateur']) == 0) {
                    echo "<li><a href='/livre-or/#'>Connexion</a></li>";
                    echo "<li><a href='/livre-or/#'>Inscription</a></li>";
                }
                else {
                    echo "<li><a href='/livre-or/connexion.php><i class='fa-solid fa-right-from-bracket'></i>Se déconnecter</a></li>";
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
                        echo "<li><a href='/livre-or/connexion.php'>Connexion</a></li>";
                        echo "<li><a href='/livre-or/#'>Inscription</a></li>";
                    }
                    else {
                        echo "<li><a href='/livre-or/#Rediger'>Rediger</a></li>";
                        echo "<li><a href='/livre-or/#Liste'>Liste</a></li>";
                        echo "<li><a href='/livre-or/#Modifier'>Modifier</a></li>";
                        echo "<li><a href='/livre-or/#Supprimer'>Supprimer</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>