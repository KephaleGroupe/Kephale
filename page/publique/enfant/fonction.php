
<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";

    $articleId = $_GET['articleId'];
    $_SESSION["id"];
    $Id_article_id_user = $_SESSION["id"].$articleId;

    $req_id_produit = $db->prepare("SELECT * FROM les_articles WHERE id = ? " );
    $req_id_produit-> execute(array($articleId));  
    $result_req_id_produit = $req_id_produit->fetch(PDO::FETCH_ASSOC);
    $id_produit = $result_req_id_produit["id_produit"];
    $nom_articles = $result_req_id_produit["nom_articles"];
    $prix_articles = $result_req_id_produit["prix_articles"];
    $descriptions_articles = $result_req_id_produit["descriptions_articles"];
    $img_articles = $result_req_id_produit["img_articles"];

    $req_id_boutique = $db->prepare("SELECT * FROM produits WHERE id = ? " );
    $req_id_boutique-> execute(array($id_produit));  
    $result_req_id_boutique = $req_id_boutique->fetch(PDO::FETCH_ASSOC);
    $id_boutique = $result_req_id_boutique["id_boutique"];

    $req_article_commande = $db->prepare("SELECT * FROM article_commande WHERE Id_article_id_user = ? " );
    $req_article_commande-> execute(array($Id_article_id_user));  

    if($req_article_commande->rowCount() > 0 ){
        $surprime_commande = $db->prepare("DELETE FROM article_commande WHERE id_article = ?" );
        $surprime_commande-> execute(array($articleId));
        $resultat = array(
            "backgroundColor" => "#95C11F", // Couleur de fond
            "nouveauTexte" => "Passe la commande" // Nouveau texte pour le lien
        );
        echo json_encode($resultat);

    }else{
        $eta_commande = 'nulle';
        $passe_comande = $db->prepare("INSERT INTO article_commande ( id_article, id_boutique, id_user, Id_article_id_user, nom_aricle, prix_article, descrip_article, img_article, eta_commande ) VALUES (?,?,?,?,?,?,?,?,?)");
        $passe_comande -> execute(array($articleId, $id_boutique, $_SESSION["id"], $Id_article_id_user, $nom_articles, $prix_articles, $descriptions_articles,$img_articles,$eta_commande  ));
        $resultat = array(
            "backgroundColor" => "#E94E1B", // Couleur de fond
            "nouveauTexte" => "Annule la commande" // Nouveau texte pour le lien
        );
        echo json_encode($resultat);
        
    }
   


