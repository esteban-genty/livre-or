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
    <title>EchoBook - Affichage Commentaire</title>

    <!-- Fichier styles -->
    <link rel="stylesheet" href="../public/css/root.css">
    <link rel="stylesheet" href="../public/css/commentaire.css">
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
        <h1>Commentaire :</h1>
        <section class="afficher-commentaire">
    <?php
        $mots = isset($_GET['mots']) ? htmlspecialchars($_GET['mots']) : '';

        $connexion = new Connexion('localhost', 'livre-or', 'root', '');
        $bddPDO = $connexion->connexionBDD(); 

        $commentaire = new Commentaire($bddPDO);
        
        echo '<section class="recherche">';
        echo $commentaire->afficherRecherche();
        echo'</section>';

        if (isset($_GET['rechercher']) && !empty($mots)) {
            $resultatsRecherche = $commentaire->rechercheCommentaire($mots);
            echo $resultatsRecherche;
        } else {
            $afficher = $commentaire->afficherCommentaire();
            if ($afficher) {
                echo '<section class="commentaire">';
                echo $afficher;
                echo '</section>';
            }
        }

        echo '</section>';
        $commentaire->AfficherPaginationCommentaire();
    ?>
    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>

</body>
</html>
