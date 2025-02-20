<?php
session_start();
require_once __DIR__ . "/../configuration/config.php";
require_once __DIR__ . "/../controllers/utilisateur.php";


if (!isset($_SESSION["utilisateur"]["id_utilisateur"])) {
    header("Location: connexion.php");
    exit;
}

$utilisateur = new Utilisateur();
$id_utilisateur = $_SESSION["utilisateur"]["id_utilisateur"];
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nouveau_prenom = trim($_POST["prenom"] ?? '');
    $nouvel_email = filter_var(trim($_POST["mail"] ?? ''), FILTER_VALIDATE_EMAIL);
    $nouveau_mdp = trim($_POST["mdp"] ?? '');
    $confirmer_mdp = trim($_POST["confirmer_mdp"] ?? '');

    if ($nouveau_prenom|| $nouvel_email || ($nouveau_mdp && $confirmer_mdp)) {
        if ($nouveau_mdp && $nouveau_mdp !== $confirmer_mdp) {
            $message = "Les mots de passe ne correspondent pas.";
        } else {
 

            $updateSuccess = $utilisateur->updateUser($id_utilisateur, $nouveau_prenom, $nouvel_email, $nouveau_mdp);
            
            if ($updateSuccess) {
                if ($nouveau_prenom) $_SESSION["utilisateur"]["prenom"] = $nouveau_prenom;
                if ($nouvel_email) $_SESSION["utilisateur"]["mail"] = $nouvel_email;
                $message = "Mise à jour réussie !";
            } else {
                $message = "Erreur lors de la mise à jour.";
            }
        }
    } else {
        $message = "Veuillez remplir au moins un champ.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
    <link rel="stylesheet" href="../public/css/footer.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../public/css/modifier.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../public/css/header.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../public/css/root.css?v=<?= time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    
</head>
<body>
    <?php require_once(__DIR__ . '/header.php'); ?>


    
<main>
    <div class="container" >
        <h1>Modifier son profil</h1>
        <h1>Bienvenue, <?= htmlspecialchars($_SESSION['utilisateur']['prenom'] ?? 'Utilisateur') ?> 👋</h1>

        <form method="POST" action="modifier_profil.php">

            <input type="text" name="prenom" value="<?= htmlspecialchars($_SESSION['utilisateur']['prenom'] ?? '') ?>" placeholder="Nouveau prenom">
            <input type="email" name="mail" value="<?= htmlspecialchars($_SESSION['utilisateur']['mail'] ?? '') ?>" placeholder="Nouvel email">
            <input type="password" name="mdp" placeholder="Nouveau mot de passe">
            <input type="password" name="confirmer_mdp" placeholder="Confirmer mot de passe" >
            <button type="submit" class="btn-save">Mettre à jour</button>

            <?php if (!empty($message)) : ?>
                <p class="<?= strpos($message, 'réussie') !== false ? 'success' : 'error' ?>">
                    <?= htmlspecialchars($message) ?>
                </p>
            <?php endif; ?>
        </form>
    </div>
    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>
