<?php

require_once __DIR__ . "/../configuration/config.php";

class RequeteCommentaire extends Connexion {

    private $bddPDO;
    
    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $bddPDO;
    }

    public function getCommentaire() {
        $requete = 'SELECT * FROM commentaire';
        $requete = $this->bddPDO->prepare($requete);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }


    public function requeteAjouterCommentaire($commentaire, $auteur) {
        $date = date("Y-m-d"); // Ajout de la date dans la BDD
    
        $requete = $this->bddPDO->prepare('INSERT INTO commentaire (commentaire, utilisateur_id, date, auteur) VALUES (:commentaire, :utilisateur_id, :date, :auteur)');
        
        $requete->bindValue(':commentaire', $commentaire);
        $requete->bindValue(':utilisateur_id', 10);
        $requete->bindValue(':date', $date);
        $requete->bindValue(':auteur', $auteur);
    
        return $requete->execute();
    }
}    
?>
