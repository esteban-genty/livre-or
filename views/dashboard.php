<?php
    require_once __DIR__ . "/../configuration/config.php";
    session_start();

    // Vérifier la session
    if (!isset($_SESSION["utilisateur"]["id_utilisateur"])) {
        die("Erreur : Aucun utilisateur connecté !");
    }

    //redirection si non connecté
    if (!isset($_SESSION["utilisateur"]["id_utilisateur"])) {
        header("Location: connexion.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/livre-or/public/css/root.css">
    <link rel="stylesheet" href="/livre-or/public/css/header.css">
    <link rel="stylesheet" href="/livre-or/public/css/dashboard.css">
    <link rel="stylesheet" href="/livre-or/public/css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <title>EchoBook - Dashboard</title>
</head>
<body>
    <?php require_once(__DIR__ . '/header.php'); ?> 
    <main>
        <section class="Bigsection">
            <h1>Dashboard</h1>
            <article action="">
                <h2><?= htmlspecialchars($_SESSION['utilisateur']['prenom'] ?? 'Utilisateur') ?></h2>
                <a href="/livre-or/views/modifier_profil.php">Modifier</a>
                <div class="divComs">
                    <div>
                        <a href="/livre-or/views/commentaire.php">Liste de vos commentaires</a>
                    </div>
                    <label for="">Gérez vos commentaires</label>
                    <ul>
                        <li><a href="/livre-or/views/form-commentaire.php">Ajouter</a></li>
                        <li><a href="/livre-or/views/modifier-commentaire.php">Modifier</a></li>
                        <li><a href="/livre-or/views/supprimer-commentaire.php">Supprimer</a></li>
                    </ul>
                </div>
            </article>
        </section>
    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>