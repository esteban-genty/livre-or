<?php

session_start(); 

class Connexion {
    private $host, $dbname, $username, $password;

    public function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function connexionBDD() {
        try {
            return new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion: " . $e->getMessage());
        }
    }

    public function sessionStart() {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }
}

$connexion = new Connexion('localhost', 'livre-or', 'root', '');
$connexion->connexionBDD();
$connexion->sessionStart();

class Utilisateur extends Connexion {
    private $pdo; 

    public function __construct($host = 'localhost', $dbname = 'livre-or', $username = 'root', $password = '') {
        parent::__construct($host, $dbname, $username, $password);
        $this->pdo = $this->connexionBDD(); 
    }

    public function getUserByMail($mail) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertUser($mail, $mdp) {
        $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (mail, mdp) VALUES (:mail, :mdp)");
        $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindParam(":mdp", $hashedPassword, PDO::PARAM_STR);
        return $stmt->execute();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["mail"]) && !empty($_POST["mdp"])) {
        $email = trim($_POST["mail"]);
        $motdepasse = trim($_POST["mdp"]);

       
        $utilisateur = new Utilisateur('localhost', 'livre-or', 'root', '');
        $userData = $utilisateur->getUserByMail($email);

        if ($userData && password_verify($motdepasse, $userData["mdp"])) {
            
            $_SESSION["utilisateur"] = [
                "id_utilisateur" => $userData["id_utilisateur"],
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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>
<body>

    <main>
        <h1>Connexion</h1>
        <section class="formsection">
            <form method="POST" action="connexion.php">
                <label for="mail">Email :</label>
                <input type="email" name="mail" required>

                <label for="mdp">Mot de passe :</label>
                <input type="password" name="mdp" required>

                <div id="buttonbox">
                    <button type="submit">Se connecter</button>
                </div>

                <?php if (!empty($error)) : ?>
                    <p style="color: red; text-align: center;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
            </form>
        </section>
    </main>
   
</body>
</html>
