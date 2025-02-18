<?php require_once __DIR__ . "/../controllers/commentaire.php"; ?>

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
            <h1>Veuillez entrer votre commentaire :</h1>
            <form action="" method="POST">

                <!-- Adding the auteur field -->
                <input type="text" name="auteur" id="auteur" required placeholder="Votre Prénom"/>

                <!-- Comment text area -->
                <textarea id="commentaire" name="commentaire" required></textarea>

                <!-- Submit button -->
                <button type="submit" name="poster">Poster</button>
            </form>

            <!-- Displaying result messages -->
            <?php 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $commentaireObj = new Commentaire($bddPDO);
                $message = $commentaireObj->ajouterCommentaire();
                echo $message; // Displaying success or error message
            }
            ?>
        </section>
    </main>

</body>
</html>
