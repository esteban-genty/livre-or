<?php

require_once __DIR__ . "/../configuration/config.php";

class RequeteCommentaire extends Connexion {

    private $bddPDO;
    
    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $bddPDO;
    }

    public function getCommentaire() {
        $requete = 'SELECT * FROM commentaire ORDER BY id_commentaire DESC';
        $requete = $this->bddPDO->prepare($requete);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function nombreCommentaire() {
        $nombre = $this->bddPDO->prepare('SELECT count(id_commentraire) FROM commentaire');
        $nombre->execute();
        return (int) $nombre->fetchColumn();
    }


    public function requeteAjouterCommentaire($commentaire) {
        $date = date('Y-m-d H:i:s'); // Ajout de la date dans la BDD
    
        $requete = $this->bddPDO->prepare('INSERT INTO commentaire (commentaire, utilisateur_id, date, auteur) VALUES (:commentaire, :utilisateur_id, :date, :auteur)');
        
        $requete->bindValue(':commentaire', $commentaire);
        $requete->bindValue(':utilisateur_id', 10);
        $requete->bindValue(':date', $date);
        $requete->bindValue(':auteur', "Estéban");
    
        return $requete->execute();
    }
}    
?>
