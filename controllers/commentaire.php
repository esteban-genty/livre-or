<?php
require_once __DIR__ . "/../models/requete_commentaire.php";

class Commentaire extends RequeteCommentaire {

    public function afficherCommentaire(){
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
        
        // Récupérer les commentaires de la page actuelle
        $result = $this->getCommentaire($page);
        $html = '';
    
        // Afficher les commentaires
        foreach ($result as $afficher_commentaire) {
            $html .= '<article>';
            $html .= "<h2>" . htmlspecialchars($afficher_commentaire['auteur']) . "</h2>";
            $html .= "<p>" . htmlspecialchars($afficher_commentaire['commentaire']) . "</p>";
            $html .= "<span>" . htmlspecialchars($afficher_commentaire['date']) . "</span>";
            $html .= '</article>';
        }
    
        return $html;
    }


    public function ajouterCommentaire() {
        if (isset($_POST['poster']) && !empty($_POST['commentaire'])) {
            $commentaire = htmlspecialchars($_POST['commentaire']);

            $result = $this->requeteAjouterCommentaire($commentaire);
            
            if ($result) {
                return "Commentaire ajouté avec succès.";
            } else {
                return "Erreur lors de l'ajout du commentaire.";
            }
        } else {
            return "Tous les champs doivent être remplis.";
        }
    }

    public function AfficherPaginationCommentaire() {
        $nbr_commentaire = $this->nombreCommentaire();
        $nbr_element_page = 5;
        $nbr_page = ceil($nbr_commentaire / $nbr_element_page);
    
        for ($i = 1; $i <= $nbr_page; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
    }

}
?>
