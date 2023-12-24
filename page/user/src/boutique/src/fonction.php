
<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";

    $articleId = $_GET['articleId'];
    $eta_commande = 'nulle';

    $req_article_commande = $db->prepare("SELECT * FROM article_commande WHERE id_article = ? " );
    $req_article_commande-> execute(array($articleId)); 
    $result_commande = $req_article_commande->fetch(PDO::FETCH_ASSOC);
    $result_commande['eta_commande'];
    if($result_commande['eta_commande'] == $eta_commande ){
        $commande_confirme = 'confirme';
        $inser_commande = $db->prepare("UPDATE article_commande SET eta_commande = ? WHERE id_article = ? ");
        $inser_commande -> execute(array( $commande_confirme, $articleId ));

    $resultat = array(
        "backgroundColor" => "#E94E1B", // Couleur de fond
        "nouveauTexte" => "Annule" // Nouveau texte pour le lien
    );
    echo json_encode($resultat);
    }else{
        $commande_confirme = 'confirme';
        if($result_commande['eta_commande'] == $commande_confirme ){
        $commande_annule = 'nulle';
        $inser_commande = $db->prepare("UPDATE article_commande SET eta_commande = ? WHERE id_article = ? ");
        $inser_commande -> execute(array( $commande_annule, $articleId ));
            $resultat = array(
                "backgroundColor" => "#95C11F", // Couleur de fond
                "nouveauTexte" => "Confirme" // Nouveau texte pour le lien
            );
            echo json_encode($resultat);
        }else{
        $commande_achete = 'achete';
        if($result_commande['eta_commande'] == $commande_achete ){
            $resultat = array(
                "backgroundColor" => "#E94E1B", // Couleur de fond
                "nouveauTexte" => "Article Achete" // Nouveau texte pour le lien
            );
            echo json_encode($resultat);
        }
        }
    }
   