<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
$temp_article = $_GET['id_article'];

$liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE temp_livraison = ?");
$liste_achat -> execute(array($temp_article)); 
$result_liste_achat = $liste_achat->fetch();

$etat_livraison = $result_liste_achat['livre'];
$id_user = $result_liste_achat['id_user'];
$id_article = $result_liste_achat['id_article'];
$id_boutique = $result_liste_achat['id_boutique'];

if($etat_livraison === 'non'){
    $articl_livre = 'oui';
    $etat = 'a';
    $article_livre = $db->prepare("UPDATE liste_achat SET livre = ? WHERE temp_livraison = ? ");
    $article_livre -> execute(array( $articl_livre, $temp_article ));

    $livree = 'oui';
    $livre = $db->prepare("UPDATE livraisons SET livre = ? WHERE temp_achat = ? ");
    $livre -> execute(array( $livree, $temp_article ));

    $heure_actuelle = time();
    $inser_annule = $db->prepare("INSERT INTO temp_annule (id_user, id_article, id_boutique, temp_article, temp_restant, etat ) VALUES (?,?,?,?,?,?)");
    $inser_annule -> execute(array($id_user, $id_article, $id_boutique, $temp_article, $heure_actuelle, $etat  ));
    header ('Location: index.php');

}else{
    if($etat_livraison === 'oui'){
        $liste_achate = $db->prepare("SELECT * FROM temp_annule WHERE temp_article = ?");
        $liste_achate -> execute(array($temp_article )); 
        $result_liste_achate = $liste_achate->fetch();
        $etat = $result_liste_achate["etat"];
        if($etat === "a"){
        $etate = 'b';   
        $etat_change = $db->prepare("UPDATE temp_annule SET etat = ? WHERE temp_article = ? ");
        $etat_change -> execute(array( $etate, $temp_article ));
        $temp = '0';
        $temp_epuise = $db->prepare("UPDATE temp_annule SET temp_restant = ? WHERE temp_article = ? ");
        $temp_epuise -> execute(array( $temp, $temp_article));

        header ('Location: index.php');
        }
    }
}