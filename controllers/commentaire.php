<?php

require_once __DIR__ . "/../models/requete_commentaire.php";
require_once __DIR__ ."/../views/form-commentaire.php";

class Commentaire extends RequeteCommentaire {

    public function ajouterCommentaire() {
        if (isset($_POST['poster']) && !empty($_POST['commentaire']) && !empty($_POST['auteur'])) {
            $commentaire = $_POST['commentaire'];
            $auteur = $_POST['auteur'];

            $result = $this->requeteAjouterCommentaire($commentaire, $auteur);
            
            if ($result) {
                return "Commentaire ajouté avec succès.";
            } else {
                return "Erreur lors de l'ajout du commentaire.";
            }
        } else {
            return "Tous les champs doivent être remplis.";
        }
    }
}
?>
