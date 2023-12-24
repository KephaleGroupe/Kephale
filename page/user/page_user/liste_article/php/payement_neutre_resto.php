<?php
$passwor_usre = sha1($_POST["password_user"]);
if(!empty($_POST ["password_user"])){
    $req_user_Non = $db->prepare ("SELECT * FROM user WHERE id = ? AND mot_de_passe = ? ");
    $req_user_Non -> execute([$_SESSION["id"],$passwor_usre]); 
    $exist_user = $req_user_Non -> fetch(PDO::FETCH_ASSOC); 
    if($passwor_usre  == $exist_user["mot_de_passe"]){
        if($exist_user["solde"] >= $montant_paye ){
            $solde_finale_user = $exist_user["solde"] - $montant_paye;
            $inser_solde = $db->prepare("UPDATE user SET solde = ? WHERE id = ? ");
            $inser_solde -> execute(array($solde_finale_user, $_SESSION["id"]));
            $result_sode = $inser_solde->fetch(); 
            // recherche de la boutique
            $req_boutique = $db->prepare ("SELECT * FROM boutique WHERE id = ? ");
            $req_boutique -> execute([$id_boutique]); 
            $result_req_boutique = $req_boutique->fetch(); 
            // traitement solde
            $montant = $montant_paye;
            $pourcentage = 5;
            $resultat = ($pourcentage / 100) * $montant;
            $montant =   $montant_paye - $resultat ;

            $solde_boutique = $result_req_boutique['solde_boutique'];
            $nom_boutique = $result_req_boutique['nom_boutique'];
            $recharge_achat = $solde_boutique + $montant;
            // traitement solde boutique
            $inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
            $inser_solde_boutique -> execute(array($recharge_achat, $id_boutique));
            // traitement solde kephale
            $id_kephale = '1';
            $kephale_solde = $db->prepare ("SELECT * FROM kephale_solde WHERE id = ? ");
            $kephale_solde -> execute([$id_kephale]); 
            $result_kephale_solde = $kephale_solde->fetch(); 
            $solde_kephale =  $result_kephale_solde['solde'];
            $solde_kephale_final = $solde_kephale + $resultat;

            $inser_solde_kephale = $db->prepare("UPDATE kephale_solde SET solde = ? WHERE id = ? ");
            $inser_solde_kephale -> execute(array($solde_kephale_final, $id_kephale));
            // traitement recharge
            $type_transaction = 'Poursantage sur achat';
            $montant_transacte = $resultat;
            $id_beneficier = '1';
            $beneficier = 'Kephale';
            $id_deduit = $id_boutique;
            $deduit = $nom_boutique;
            $date_transaction = time();
            $transactions = $db->prepare("INSERT INTO transaction_kephale (type_transactions, id_beneficier, beneficier, id_deduit, deduit, montant_transaction, date_transaction ) VALUES (?,?,?,?,?,?,?)");
            $transactions -> execute(array($type_transaction, $id_beneficier, $beneficier, $id_deduit, $deduit, $montant_transacte, $date_transaction));
            
            // Date actuelle
            $now = time();
            // Date dans deux jours
            $temp_livraison = strtotime("+2 days", $now);
            // Calcul du nombre de secondes restantes
            // $remaining_seconds = $end - $now;
            // Calcul du nombre de jours restants
            // $remaining_days = floor($remaining_seconds / (60 * 60 * 24));
            // echo "Le chrono se termine dans " . $remaining_days . " jours.";
            $livre = 'non';
            $boutique_etat = 'non';
            $client_etat = 'non';
            $inser_achat = $db->prepare("INSERT INTO liste_achat ( id_user, id_article, id_boutique, quantite_article, taille_article, montant_paye, livre, temp_livraison, boutique_etat, client_etat ) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $inser_achat -> execute(array($_SESSION["id"], $id_article, $id_boutique, $quantite_article, $taille_article, $montant_paye, $livre, $temp_livraison, $boutique_etat,  $client_etat ));
            $surprime_article = $db->prepare("DELETE FROM article_commande WHERE id = ?" );
            $surprime_article-> execute(array($id_article));

            $surprime_article = $db->prepare("DELETE FROM article_commande WHERE id_article = ?" );
            $surprime_article-> execute(array($id_article));

            header ('Location: ../liste_achat/index.php');

        }else{
            $erreur = 'Votre solde est insufisant!';
        }
    }else{
    $erreur = 'Mot de passe incorecte!';
    }
}else{

    $erreur = 'Entre votre mot de passe !';
}