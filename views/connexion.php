<?php

 

require_once __DIR__ . "/../configuration/config.php";
require_once __DIR__ . "/../controllers/utilisateur.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["prenom"]) && !empty($_POST["mail"]) && !empty($_POST["mdp"])) {
        $nom = trim($_POST["prenom"]);
        $email = trim($_POST["mail"]);
        $motdepasse = trim($_POST["mdp"]);

        $utilisateur = new Utilisateur('localhost', 'livre-or', 'root', '');
        $userData = $utilisateur->getUserByMail($email);
        
        if ($userData && $userData["prenom"] === $nom && password_verify($motdepasse, $userData["mdp"])) {
            $_SESSION["utilisateur"] = [
                "id_utilisateur" => $userData["id_utilisateur"],
                "prenom" => $userData["nom"], 
                "mail" => $userData["mail"]
            ];
            
            header("Location: modifier_profil.php");
            exit;
        } else {
            $error = "Prenom, email ou mot de passe incorrect.";
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
    <link rel="stylesheet" href="../public/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../public/root.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../public/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php require_once(__DIR__ . '/header.php'); ?>
    <main>
        <h1>Connexion</h1>
        <section class="formsection">
            <form method="POST" action="connexion.php">
                <label for="prenom">prenom :</label>
                <input type="text" name="prenom" required>

                <label for="mail">Email :</label>
                <input type="email" name="mail" required>

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
    </main>
</body>
</html>
