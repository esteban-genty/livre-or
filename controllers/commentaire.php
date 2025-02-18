<?php
require_once __DIR__ . "/../models/requete_commentaire.php";
// require_once __DIR__ ."/../views/form-commentaire.php";

class Commentaire extends RequeteCommentaire {

    public function afficherCommentaire(){
        $result = $this->getCommentaire();
        $html = '';
    
        foreach ($result as $afficher_commentaire) {
            $html .= "<h2>" . htmlspecialchars($afficher_commentaire['auteur']) . "</h2>";
            $html .= "<p>" . htmlspecialchars($afficher_commentaire['commentaire']) . "</p>";
            $html .= "<span>" . htmlspecialchars($afficher_commentaire['date']) . "</span><br>";
        }
    
        return $html;
    }
    

    public function ajouterCommentaire() {
        if (isset($_POST['poster']) && !empty($_POST['commentaire']) && !empty($_POST['auteur'])) {
            $commentaire = htmlspecialchars($_POST['commentaire']);
            $auteur = htmlspecialchars($_POST['auteur']);

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
