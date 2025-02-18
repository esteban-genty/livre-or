<?php require_once __DIR__ . "/../controllers/commentaire.php"; ?>
<?php require_once __DIR__ . "/../models/requete_commentaire.php"; ?>
<?php require_once __DIR__ . "/../configuration/config.php"; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Site Livre d'or">
    <meta name="keywords" content="Livre d'or, Echo Book">
    <meta name="author" content="Estéban, Antoine, Sébastien">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoBook - Ajouter Commentaire</title>

    <!-- Fichier styles -->
    <link rel="stylesheet" href="../styles/styles.css">

    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>

<main>
    <section class="ajout-commentaire">
        <h1>Veuillez entrez votre commentaire :</h1>
        <form action="" method="POST">

            <input type="text" name="auteur" id="auteur" required placeholder="Votre Prenom"/>

            <textarea id="commentaire" name="commentaire"></textarea>

            <button type="submit" name="poster">Poster</button>
        </form>
    </section>

    <?php

    if (isset($_POST['poster'])) {
        $connexion = new Connexion('localhost', 'livre-or', 'root', '');
        $bddPDO = $connexion->connexionBDD();

        $commentaire = new Commentaire($bddPDO);
        $result = $commentaire->ajouterCommentaire();

        if ($result) {
            echo "<p>$result</p>";
        }
    }
    ?>
    
</main>

</body>
</html>
