<header>
    <a class="aTitre" href="/livre-or/index.php"><h1>Accueil</h1></a>
    <a class="aImg" href="/livre-or/index.php"><img src="../logo-echobook.png" alt="logo echobook"></a>
    <nav>
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
    </nav>
</header>