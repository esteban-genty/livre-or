<footer>
    <div class="bigDiv">
        <img src="/livre-or/img/logo-echobook.png" alt="">
        <nav>
            <ul>
                <li><a href="/livre-or/views/index.php">Accueil</a></li>
                <?php 
                    if (isset($_SESSION['utilisateur']) == 0) {
                        echo "<li><a href='connexion.php'>Connexion</a></li>";
                        echo "<li><a href='inscription.php'>Inscription</a></li>";
                    }
                    else {
                        echo "<li><a href='/livre-or/views/commentaire.php'>Liste de messages</a></li>";
                        echo "<li><a href='/livre-or/views/form-commentaire.php'>Rédiger</a></li>";
                        echo "<li><a href='/livre-or/views/modifier-commentaire.php'>Modifier</a></li>";
                        echo "<li><a href='/livre-or/views/supprimer-commentaire.php'>Supprimer</a></li>";
                        echo "<li><a href='/livre-or/views/dashboard.php'>Profil</a></li>";
                    }
                ?>
            </ul>
        </nav>
        <div class="divVide">
    
        </div>
    </div>
    <label for="Créateurs">Crée par <a href="https://github.com/antoine-leca">Antoine</a>, <a href="https://github.com/esteban-genty">Estéban</a> et <a href="https://github.com/sebastien-liveyupeng">Sébastien</a></label>
</footer>