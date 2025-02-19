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
        $nbr_element_page = 9;
        $nbr_page = ceil($nbr_commentaire / $nbr_element_page);
    
        echo "<section class='pagination'>";

        for ($i = 1; $i <= $nbr_page; $i++) {
            echo "<a href='?page=$i'>$i</a>";
        }
        echo "</section>";
    }

    public function afficherModifierCommentaire() {
        $results = $this->getCommentaireUtilisateur();
        $html = '';
        
        if ($results) {
            $html .= '<form action="" method="post">';
            $html .= '<select name="choisir-commentaire">';
            $html .= '<option value="choisir">Choisir un commentaire</option>'; // Modifié pour laisser vide l'option par défaut
            foreach ($results as $result) {
                $html .= '<option value="' . $result['id_commentaire'] . '">' . $result['commentaire'] . '</option>';
            }
            $html .= '</select>';
            $html .= '<input type="text" name="nv_commentaire" placeholder="Nouveau Commentaire" required />';
            $html .= '<button type="submit" name="modifier">Modifier</button>';
            $html .= '</form>';
            
            return $html;
        } else {
            return "Aucun commentaire trouvé.";
        }
    }
    

    public function modifierCommentaire($commentaire, $commentaire_id){

        if(isset($_POST['modifier']) && !empty($_POST['nv_commentaire']) && $_POST['choisir-commentaire'] != "choisir" ){

        $modifier = $this->requeteModifierCommentaire($commentaire, $commentaire_id);

        if ($modifier) {
            return "Commentaire modifié avec succès";
        }else{
            return "Erreur lors de la modification du commentaire";
        }

        }else{
            return "Veuillez remplir tous les champs et selctionner un commentaire";
        }
    }

}    
    
?>
