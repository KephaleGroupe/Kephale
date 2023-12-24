<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
$temp_article = $_GET['id_article'];
$etate = 'oui';   
$etat_change = $db->prepare("UPDATE temp_annule SET etat = ? WHERE temp_article = ? ");
$etat_change -> execute(array( $etate, $temp_article ));
$temp = '0';
$temp_epuise = $db->prepare("UPDATE temp_annule SET temp_restant = ? WHERE temp_article = ? ");
$temp_epuise -> execute(array( $temp, $temp_article));

header ('Location: index.php');