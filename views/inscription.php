<?php
    require_once(__DIR__ . '/../configuration/config.php');
    require_once(__DIR__ . '/../controllers/utilisateur.php');

    $connexion = new Connexion(host:'localhost:3306', dbname: 'antoine-leca_livre-or', username: 'livre-or', password: 'Gig193s*8');
    $bddPDO = $connexion->connexionBDD();

    $user = new Utilisateur(host:'localhost:3306', dbname: 'antoine-leca_livre-or', username: 'livre-or', password: 'Gig193s*8');

    if (isset($_POST['submitbutton'])) {
        $user->prenom = $_POST['prenom'];
        $user->mail = $_POST['mail'];
        $user->mdp = $_POST['mdp'];
        $user->mdp_confirmation = $_POST['mdp_confirmation'];

        $erreur_msg = $user->registerUser();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/livre-or/public/css/root.css">
    <link rel="stylesheet" href="/livre-or/public/css/header.css">
    <link rel="stylesheet" href="/livre-or/public/css/inscription.css">
    <link rel="stylesheet" href="/livre-or/public/css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <title>EchoBook - Inscription</title>
</head>
<body>
    <?php require_once(__DIR__ . '/header.php'); ?>
    <main>
        <div class="Bigsection">
            <h1>Inscription</h1>
            <section class="formsection">
                <form action="" method="post">
                    <label for="">Prénom</label>
                    <input type="text" name="prenom" id="prenom" required>
                    <label for="">Email</label>
                    <input placeholder="echo@book.fr" type="email" name="mail" id="mail" required>
                    <label for="">Mot de passe</label>
                    <input type="password" name="mdp" id="mdp" required>
                    <label for="">Confirmation du mot de passe</label>
                    <input type="password" name="mdp_confirmation" id="mdp_confirmation" required>
                    <?php if (!empty($erreur_msg)) : ?>
                        <p class="erMsg"> <?= htmlspecialchars($erreur_msg) ?> </p>
                    <?php endif; ?>
                    <div id = "buttonbox">
                        <button type="submit" name="submitbutton">S'inscrire</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>