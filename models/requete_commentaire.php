<?php

require_once __DIR__ . "/../configuration/config.php";
require_once __DIR__ . "/../controllers/commentaire.php";

class RequeteCommentaire extends Connexion {

    private $bddPDO;
    
    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $bddPDO;
    }

    public function nombreCommentaire() {
        $nombre = $this->bddPDO->prepare('SELECT count(id_commentaire) FROM commentaire');
        $nombre->execute();
        return (int) $nombre->fetchColumn();
    }

    public function getCommentaire($page = 1) {
        $nbr_element_page = 5;

        $debut = ($page - 1) * $nbr_element_page;

        $requete = 'SELECT * FROM commentaire ORDER BY id_commentaire DESC LIMIT :debut, :nbr_element_page';
        $stmt = $this->bddPDO->prepare($requete);

        $stmt->bindParam(':debut', $debut, PDO::PARAM_INT);
        $stmt->bindParam(':nbr_element_page', $nbr_element_page, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
