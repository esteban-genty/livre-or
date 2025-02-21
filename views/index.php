<?php 
    require_once(__DIR__ . '/../configuration/config.php');

    session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/livre-or/public/css/root.css">
    <link rel="stylesheet" href="/livre-or/public/css/header.css">
    <link rel="stylesheet" href="/livre-or/public/css/style.css">
    <link rel="stylesheet" href="/livre-or/public/css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <title>EchoBook - Accueil</title>
</head>
<body>
    <?php require_once(__DIR__ . '/header.php'); ?>
    <main>
        <section class="sectionCTA">
           <?php if (isset($_SESSION['utilisateur']) == 0) {
                echo "<label for=''>Rédigez, publiez, lisez</label>";
                echo "<a id='aIns' href='inscription.php'>Inscrivez-vous</a>";
                echo "<p>ou <a id='aCo' href='connexion.php'>connectez-vous</a></p>";
            }
            else {
                echo "<a id='aIns' href='dashboard.php'>Tableau de bord</a>";
            }
            ?>
        </section>
        <section class="sectionMsg">
            <div>
                <h2>Aperçu de messages</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th id="premiereCol">Date</th>
                        <th>Auteur</th>
                        <th id="derniereCol">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>18/02/2025</td>
                        <td>Estéban</td>
                        <td>Meilleur livre d'or en ligne</td>
                    </tr>
                    <tr>
                        <td>18/02/2025</td>
                        <td>Antoine</td>
                        <td>Meilleur livre d'or en ligne</td>
                    </tr>
                    <tr id="derniereLigne">
                        <td>18/02/2025</td>
                        <td>Sébastien</td>
                        <td>Meilleur livre d'or en ligne</td>
                    </tr>
                </tbody>
            </table>
            <!-- redirection vers la liste des messages -->
            <a href="commentaire.php">voir tout</a>
        </section>

    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>