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
        $nbr_element_page = 9;

        $debut = ($page - 1) * $nbr_element_page;

        $requete = 'SELECT * FROM commentaire ORDER BY id_commentaire DESC LIMIT :debut, :nbr_element_page';
        $requete = $this->bddPDO->prepare($requete);

        $requete->bindParam(':debut', $debut, PDO::PARAM_INT);
        $requete->bindParam(':nbr_element_page', $nbr_element_page, PDO::PARAM_INT);

        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

public function getCommentaireUtilisateur() {
    //$utilisateur_id = $_SESSION['id_utilisateur'];
    $utilisateur_id = 10;
    
    $requete = $this->bddPDO->prepare('SELECT * FROM commentaire WHERE utilisateur_id = :utilisateur_id ORDER BY id_commentaire DESC');
    $requete->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
    $requete->execute();

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


    public function requeteModifierCommentaire($commentaire, $commentaire_id){

        $requete = $this->bddPDO->prepare("UPDATE `commentaire` SET `commentaire` = :commentaire WHERE `id_commentaire` = :commentaire_id");
        $requete->bindParam(":commentaire", $commentaire );
        $requete->bindParam(":commentaire_id", $commentaire_id ,PDO::PARAM_INT);
        $requete->execute();

        return $requete;

    }



    public function requeteAjouterCommentaire($commentaire) {
        $date = date('Y-m-d H:i:s'); // Ajout de la date dans la BDD
        //$utilisateur_id = $_SESSION['utilisateur_id'];
        //$auteur = $_SESSION['prenom'];
    
        $requete = $this->bddPDO->prepare('INSERT INTO commentaire (commentaire, utilisateur_id, date, auteur) VALUES (:commentaire, :utilisateur_id, :date, :auteur)');
        
        $requete->bindValue(':commentaire', $commentaire);
        $requete->bindValue(':utilisateur_id', 10);
        $requete->bindValue(':date', $date);
        $requete->bindValue(':auteur', "Estéban");
    
        return $requete->execute();
    }

    public function requeteSupprimerCommentaire($commentaire_id){

        $requete = $this->bddPDO->prepare("DELETE FROM commentaire WHERE `commentaire`.`id_commentaire` = :id_commentaire");
        $requete->bindParam(':id_commentaire', $commentaire_id , PDO::PARAM_INT);
        $requete->execute();

        return $requete;

    }

}    
?>
