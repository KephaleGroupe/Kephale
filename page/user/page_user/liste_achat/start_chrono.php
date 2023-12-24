<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
$temp_article= $_GET['id_article'];

$liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE temp_livraison = ?");
$liste_achat -> execute(array($temp_article)); 
$result_liste_achat = $liste_achat->fetch();

$etat_livraison = $result_liste_achat['livre'];
$id_user = $result_liste_achat['id_user'];
$id_article = $result_liste_achat['id_article'];
$id_boutique = $result_liste_achat['id_boutique'];

if($etat_livraison == 'nom' ){
    $articl_livre = 'oui';
    $etat = 'a';
    $article_livre = $db->prepare("UPDATE liste_achat SET livre = ? WHERE temp_livraison = ? ");
    $article_livre -> execute(array( $articl_livre, $temp_article ));
    $heure_actuelle = time();
    $inser_annule = $db->prepare("INSERT INTO temp_annule (id_user, id_article, id_boutique, temp_article, temp_restant, etat ) VALUES (?,?,?,?,?,?)");
    $inser_annule -> execute(array($id_user, $id_article, $id_boutique, $temp_article, $heure_actuelle, $etat  ));

    $_temp_annule = 'Vous dispose de 10 minute pour annule votre achate si il y a un probleme.';
    echo $_temp_annule;
}else{
    if( $etat_livraison == 'oui'){
    $etat = 'etat';
    $article_livre = $db->prepare("UPDATE temp_annule SET etat = ? WHERE temp_article = ? ");
    $article_livre -> execute(array( $articl_livre, $temp_article ));

        header ('Location: index.php');
    }
   
}
