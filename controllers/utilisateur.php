
<?php



require_once __DIR__ . '/../configuration/config.php';

class Utilisateur extends Connexion {
    private $pdo;
    private $table_name = "utilisateur"; 

    public $prenom;
    public $mail;
    public $mdp;
    public $mdp_confirmation;

    public function __construct($host = 'localhost', $dbname = 'livre-or', $username = 'root', $password = '') {
        parent::__construct($host, $dbname, $username, $password);
        $this->pdo = $this->connexionBDD(); 
    }

    public function getUserByMail($mail)
     {
        $sql = "SELECT id_utilisateur, prenom, mail, mdp FROM utilisateur WHERE mail = :mail";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["mail" => $mail]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function registerUser() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE mail = :mail");
        $stmt->execute(["mail" => $this->mail]);
        if ($stmt->fetchColumn() > 0) {
            return "Cette adresse e-mail est déjà utilisée";
        }
        if ($this->mdp !== $this->mdp_confirmation) {
            return "Les mots de passe ne correspondent pas";
        }

        if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
            return "Adresse e-mail invalide";
        }

        $this->mdp = password_hash($this->mdp, PASSWORD_BCRYPT);

        $query = "INSERT INTO " . $this->table_name . " (prenom, mail, mdp) VALUES (:prenom, :mail, :mdp)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':mdp', $this->mdp);

        if ($stmt->execute()) {
            $_SESSION['utilisateur'] = ['mail' => $this->mail];
            header('Location: connexion.php');
            exit();
        } else {
            return "Erreur lors de l'inscription";
        }
    }
    public function updateUser($id, $nom = null, $email = null, $mdp = null) {
        if ($nom) {
            $stmt = $this->pdo->prepare("UPDATE utilisateur SET prenom = :prenom WHERE id_utilisateur = :id");
            $stmt->execute(["prenom" => $nom, "id" => $id]);
        }
        if ($email) {
            $stmt = $this->pdo->prepare("UPDATE utilisateur SET mail = :mail WHERE id_utilisateur = :id");
            $stmt->execute(["mail" => $email, "id" => $id]);
        }
        if ($mdp) {
            $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE utilisateur SET mdp = :mdp WHERE id_utilisateur = :id");
            $stmt->execute(["mdp" => $hashedPassword, "id" => $id]);
        }
        return true;
    }
    
}

?>
