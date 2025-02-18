<?php



require_once __DIR__ . '/../configuration/config.php';

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

?>
