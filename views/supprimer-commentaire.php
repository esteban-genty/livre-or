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
    <title>EchoBook - Supprimer Commentaire</title>

    <!-- Fichier styles -->
    <link rel="stylesheet" href="../public/css/root.css">
    <link rel="stylesheet" href="../public/css/modifier-commentaire.css">

    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>

<body>

<main>
    <section class="supprimer-commentaire">
        <h1>Selectionner le commentaire à supprimer :</h1>

    <?php

        $connexion = new Connexion('localhost', 'livre-or', 'root', '');
        $bddPDO = $connexion->connexionBDD(); 

        $commentaire = new Commentaire($bddPDO);
        echo $commentaire->afficherSupprimerCommentaire();

        if(isset($_POST['supprimer'])){

        $commentaire_id = $_POST['choisir-commentaire'];

        echo $commentaire->supprimerCommentaire( $commentaire_id);
        }

    ?>
    </section>
    
</main>

</body>
</html>
