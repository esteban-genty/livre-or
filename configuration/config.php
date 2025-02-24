    <?php

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

$connexion = new Connexion (host:'localhost:3306', dbname: 'antoine-leca_livre-or', username: 'livre-or', password: 'Gig193s*8');
$connexion->connexionBDD();


//var_dump($_SESSION);

?>