<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";
$liste = $db->prepare("SELECT * FROM liste_achat WHERE id = ?");
$liste -> execute(array($_GET["temp_livraison"])); 
$result_liste = $liste->fetch();
$result_liste["id_user"];
$result_liste["id_article"];
$result_liste["id_boutique"];
$result_liste["quantite_article"];
$result_liste["taille_article"];
$result_liste["montant_paye"];
$boutique_suprime = 'nom';
$user_suprime = 'nom';

$select_boutique = $db->prepare("SELECT * FROM boutique WHERE id = ?");
$select_boutique -> execute(array($result_liste["id_boutique"])); 
$result_select_boutique = $select_boutique->fetch();

$result_select_boutique["type_abonnement"];

$oui = 'oui';
$modif_etat = $db->prepare("UPDATE liste_achat SET boutique_etat = ? WHERE id = ? ");
$modif_etat -> execute(array( $oui, $result_liste["id"]));


$select_achat = $db->prepare("SELECT * FROM liste_achat WHERE id = ?");
$select_achat -> execute(array($result_liste["id"])); 
$result_select_achat = $select_achat->fetch(); 

if($result_select_achat["boutique_etat"] === 'oui'){
    if($result_select_achat["client_etat"] === 'oui'){
$surprime_achat = $db->prepare("DELETE FROM liste_achat WHERE id = ?" );
$surprime_achat-> execute(array($_GET["temp_livraison"]));

$surprime_achat = $db->prepare("DELETE FROM temp_annule WHERE temp_article = ?" );
$surprime_achat-> execute(array($result_liste["temp_livraison"]));


    }
}


header ('Location: aaa.php');


