<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../configuration/config.php";
require_once __DIR__ . "/../controllers/utilisateur.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["mail"]) && !empty($_POST["mdp"])) {
        $mail = trim($_POST["mail"]);
        $motdepasse = trim($_POST["mdp"]);

        $utilisateur = new Utilisateur(host:'localhost:3306', dbname: 'antoine-leca_livre-or', username: 'livre-or', password: 'Gig193s*8');
        $userData = $utilisateur->getUserByMail($mail);

        if ($userData && password_verify($motdepasse, $userData["mdp"])) {
            session_regenerate_id(true);

            $_SESSION["utilisateur"] = [
                "id_utilisateur" => $userData["id_utilisateur"],
                "prenom" => $userData["prenom"],
                "mail" => $userData["mail"]
            ];

            header("Location: dashboard.php");
            exit;
            
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../public/css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../public/css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../public/css/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../public/css/connexion.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>
<body>
<?php require_once(__DIR__ . '/header.php'); ?>
    <main>
        <section class="Bigsection">
            <h1>Connexion</h1>
            <section class="formsection">
                <form method="POST" action="connexion.php">
                    <label for="mail">Email</label>
                    <input type="email" name="mail" required placeholder="echo@book.fr">

                    <label for="mdp">Mot de passe :</label>
                    <input type="password" name="mdp" required>

                    <div id="buttonbox">
                        <button type="submit">Se connecter</button>
                    </div>

                    <?php if (!empty($error)) : ?>
                        <p style="color: red; text-align: center;"> <?= htmlspecialchars($error) ?> </p>
                    <?php endif; ?>
                </form>
            </section>
        </section>
    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>
