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
    $nouveau_nom = trim($_POST["nom"] ?? '');
    $nouvel_email = filter_var(trim($_POST["mail"] ?? ''), FILTER_VALIDATE_EMAIL);
    $nouveau_mdp = trim($_POST["mdp"] ?? '');
    $confirmer_mdp = trim($_POST["confirmer_mdp"] ?? '');

    if ($nouveau_nom || $nouvel_email || ($nouveau_mdp && $confirmer_mdp)) {
        if ($nouveau_mdp && $nouveau_mdp !== $confirmer_mdp) {
            $message = "Les mots de passe ne correspondent pas.";
        } else {
 

            $updateSuccess = $utilisateur->updateUser($id_utilisateur, $nouveau_nom, $nouvel_email, $nouveau_mdp);
            
            if ($updateSuccess) {
                if ($nouveau_nom) $_SESSION["utilisateur"]["nom"] = $nouveau_nom;
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
    <link rel="stylesheet" href="../public/modifier.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../public/header.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../public/root.css?v=<?= time(); ?>">
</head>
<body>
    <?php require_once(__DIR__ . '/header.php'); ?>
    <main>
    <div class="container">
        <h1>Modifier son profil</h1>
        <h2>Bienvenue, <?= htmlspecialchars($_SESSION['utilisateur']['nom'] ?? 'Utilisateur') ?> 👋</h2>

        <form method="POST" action="modifier_profil.php">
            <input type="text" name="nom" value="<?= htmlspecialchars($_SESSION['utilisateur']['nom'] ?? '') ?>" placeholder="Nouveau nom">
            <input type="email" name="mail" value="<?= htmlspecialchars($_SESSION['utilisateur']['mail'] ?? '') ?>" placeholder="Nouvel email">
            <input type="password" name="mdp" placeholder="Nouveau mot de passe">
            <input type="password" name="confirmer_mdp" placeholder="Confirmer mot de passe" required>
            <button type="submit">Mettre à jour</button>

            <?php if (!empty($message)) : ?>
                <p class="<?= strpos($message, 'réussie') !== false ? 'success' : 'error' ?>">
                    <?= htmlspecialchars($message) ?>
                </p>
            <?php endif; ?>
        </form>
    </div>
    </main>
</body>
</html>
