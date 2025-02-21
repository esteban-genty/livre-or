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
    <link rel="stylesheet" href="../public/css/root.css">
    <link rel="stylesheet" href="../public/css/modifier-commentaire.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">

    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>

<body>

    <?php require_once(__DIR__ . '/header.php'); ?>
    <main>
        <section class="modifier-commentaire">
            <h1>Selectionner le commentaire à modifier :</h1>

        <?php

            $connexion = new Connexion(host:'localhost:3306', dbname: 'antoine-leca_livre-or', username: 'livre-or', password: 'Gig193s*8');
            $bddPDO = $connexion->connexionBDD(); 

            $commentaire = new Commentaire($bddPDO);
            echo $commentaire->afficherModifierCommentaire();

            if(isset($_POST['modifier'])){
            
            $nv_commentaire = $_POST['nv_commentaire'];
            $commentaire_id = $_POST['choisir-commentaire'];

            echo $commentaire->modifierCommentaire($nv_commentaire, $commentaire_id);
            header("Location: dashboard.php");
            }

        ?>
        </section>
        
    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>

</body>
</html>
