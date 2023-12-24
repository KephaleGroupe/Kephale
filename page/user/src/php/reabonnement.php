<?php
$req_boutique_U = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
$req_boutique_U -> execute(array($_SESSION["id"])); 
$result_req_boutique_U = $req_boutique_U->fetch();
$id_boutique = $result_req_boutique_U["id"];
$type_abonnement = $result_req_boutique_U["type_abonnement"];

$req_offre = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ? ");
$req_offre -> execute(array($type_abonnement)); 
$result_req_offre = $req_offre->fetch();
$result_req_offre["montant"];
if(isset($_POST["achete"])){
    $passwor_usre = sha1($_POST["passwor_usre"]);
    if(isset($_POST["passwor_usre"]) AND !empty($_POST["passwor_usre"])){
        if($_SESSION["mot_de_passe"] == $passwor_usre){
            $getPrix = $result_req_offre["montant"]; 
            if($getPrix <= $result_req_user["solde"]){
                $start_time = time();
                $end_time = $start_time + (30 * 24 * 60 * 60);// 30 jour 
                $_SESSION['end_time'] = $end_time;

                $getPrix = $result_req_offre["montant"];; 
                $resuletAchat = $result_req_user["solde"] - $getPrix;
                $Solde =  $resuletAchat;
                $getabonnement= $result_req_offre["type_abon"];
                $inserSolde = $db->prepare("UPDATE user SET solde = ?, temp_abonement = ?, boutique_user = ? WHERE id = ? ");
                $inserSolde -> execute(array($Solde, $_SESSION['end_time'], $getabonnement,  $_SESSION["id"]));
                $resultSode = $inserSolde->fetch(); 

                $inser_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                $inser_abonnement -> execute(array($_SESSION['end_time'], $id_boutique  ));
                $result_abonnement = $inser_abonnement->fetch(); 
                // transactions 
                $type_transaction = 'abonnement';
                $montant_transaction = $getPrix;
                $id_beneficier = '1';
                $beneficier = 'Kephale';
                $id_deduit = $_SESSION["id"];
                $deduit = $result_req_user["nom"];
                $date_transaction = time();
                $transactions = $db->prepare("INSERT INTO transaction_kephale (type_transactions, id_beneficier, beneficier, id_deduit, deduit, montant_transaction, date_transaction ) VALUES (?,?,?,?,?,?,?)");
                $transactions -> execute(array($type_transaction, $id_beneficier, $beneficier, $id_deduit, $deduit, $montant_transaction, $date_transaction));
                // charge compte Kephale
                $kephale_solde = $db->prepare("SELECT * FROM kephale_solde WHERE id = ? ");
                $kephale_solde -> execute(array($id_beneficier)); 
                $result_kephale_solde = $kephale_solde->fetch();
                $result_kephale_solde["solde"]; 
                $solde_finale = $result_kephale_solde["solde"] + $montant_transaction ; 

                $solde_k = $db->prepare("UPDATE kephale_solde SET solde = ? WHERE id = ? ");
                $solde_k -> execute(array($solde_finale, $id_beneficier ));
                $result_solde_k = $solde_k->fetch(); 

                header ('Location: boutique/grand.php');
            }else{
                $erreur = 'Solde insuffisant !';
            }
        }else{
            $erreur = 'Mot de passe incorecte !';
        }

    }else{
        $erreur = 'Entre votre mot de passe !';
    }

}