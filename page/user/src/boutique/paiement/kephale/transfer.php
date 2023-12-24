<?php
session_start();
include_once "../../../../../../kephale_bdd/kephale_bdd.php";
$id_boutique = $_SESSION["id_boutique"] ;
$id_users = $_SESSION["id"];
$numero_rechage = $_GET["numero"];


$rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
$rec_boutique-> execute(array($_SESSION["id"]));
$result_rec_boutique = $rec_boutique->fetch();




$_SESSION["id_boutique"] = $result_rec_boutique["id"];
if(isset($_SESSION["id"] ) AND $_SESSION["id"] ==  $result_rec_boutique["id_user"] ){
}else{
    $_SESSION = array();
    session_destroy();
    header ('Location:../../../../../../index.php');
}
$req_numeraux = $db->prepare ("SELECT * FROM user WHERE telephone = ?"); 
$req_numeraux -> execute(array($numero_rechage));
$req_numeraux_existe = $req_numeraux -> fetch(); 
    $id = $req_numeraux_existe["id"];
    $nom = $req_numeraux_existe["nom"];
    $telephone = $req_numeraux_existe["telephone"];
    $solde_user = $req_numeraux_existe["solde"];
    if($id === $id_users){
        
    }else{

    }
if (isset($_POST["suivant"]) AND !empty($_POST["suivant"])){
    $montant_entre = htmlspecialchars($_POST["montant"]);
    $password = sha1($_POST["password"]);
    
    if(!empty($_POST["montant"])){
// traitement solde
if($id === $id_users){
    $montant_transfer = $_POST["montant"];
    if(!empty($_POST["password"])){
        $user = $db->prepare("SELECT * FROM user WHERE id = ? ");
        $user-> execute(array($_SESSION["id"]));
        $result_user = $user->fetch();
        $result_user["mot_de_passe"];
        if($password === $result_user["mot_de_passe"] ){
            $solde_boutique = $result_rec_boutique["solde_boutique"];
          if($solde_boutique >= $montant_transfer){
$liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND livre LIKE 'non'");
$liste_achat-> execute(array($_SESSION["id_boutique"]));
$result_liste_achat = $liste_achat->rowCount();
if($liste_achat->rowCount() === 1){
    $liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND livre LIKE 'non'");
    $liste_achat-> execute(array($_SESSION["id_boutique"]));
    $result_liste_achat = $liste_achat->fetch();
    $result_liste_achat["montant_paye"];
    // reste apres retrait
    $retrait_boutique = $solde_boutique - $montant_transfer ;
    if($retrait_boutique >= $result_liste_achat["montant_paye"]){
                //reste apres retrait
                $retrait_boutique = $solde_boutique - $montant_transfer ;
                // totale apres depot
                $depot_user = $solde_user + $montant_transfer;
    
                // traitement solde boutique
               $inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
               $inser_solde_boutique -> execute(array($retrait_boutique, $_SESSION["id_boutique"]));
    
                // traitement solde user
                $inser_solde_boutique = $db->prepare("UPDATE user SET solde = ? WHERE id = ? ");
                $inser_solde_boutique -> execute(array($depot_user, $id));
    
                $date_transaction = time();
               $frait = 0;
               $historique = $db->prepare("INSERT INTO transaction_transfer (id_retrait, id_depot, montant_envoie, frait_retrait, montant_totale, date_transfer) VALUES (?,?,?,?,?,?)");
               $historique -> execute(array($_SESSION["id_boutique"], $id, $montant_transfer, $frait, $montant_transfer, $date_transaction));
    
               header ('Location: ../../grand.php');
    }else{
        $retrait_posible = $solde_boutique - $result_liste_achat["montant_paye"] ;
        $erreur = "Vous pouvez pas fair le retrait de ".$montant_transfer."F CFA vous pouve fair le retrait de ".$retrait_posible."F CFA";
    }
}else{
    $temp_annule = $db->prepare("SELECT * FROM temp_annule WHERE id_boutique = ? AND etat LIKE 'a'");
    $temp_annule-> execute(array($_SESSION["id_boutique"]));
    $result_temp_annule = $temp_annule->rowCount();
    
    if($temp_annule->rowCount() >= 2 ){
        $erreur = "Vous pouve pas faire de retrait pour le moment par ce que le monbre de vos article en coure de validation est superieur a 2 arcle.";
    }else{
        if($temp_annule->rowCount() === 1){
            $result_temp_annulee = $temp_annule->fetch();
            

    $liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND temp_livraison = ?  ");
    $liste_achat-> execute(array($_SESSION["id_boutique"], $result_temp_annulee["temp_article"] ));
    $result_liste_achat = $liste_achat->fetch();
    $retrait_boutique = $solde_boutique - $montant_transfer ;
   
    if($retrait_boutique >= $result_liste_achat["montant_paye"]){
         //reste apres retrait
         $retrait_boutique = $solde_boutique - $montant_transfer ;
         // totale apres depot
         $depot_user = $solde_user + $montant_transfer;
 
         // traitement solde boutique
        $inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
        $inser_solde_boutique -> execute(array($retrait_boutique, $_SESSION["id_boutique"]));
 
         // traitement solde user
         $inser_solde_boutique = $db->prepare("UPDATE user SET solde = ? WHERE id = ? ");
         $inser_solde_boutique -> execute(array($depot_user, $id));
 
         $date_transaction = time();
        $frait = 0;
        $historique = $db->prepare("INSERT INTO transaction_transfer (id_retrait, id_depot, montant_envoie, frait_retrait, montant_totale, date_transfer) VALUES (?,?,?,?,?,?)");
        $historique -> execute(array($_SESSION["id_boutique"], $id, $montant_transfer, $frait, $montant_transfer, $date_transaction));
 
        header ('Location: ../../grand.php');
    }else{
        $retrait_posible = $solde_boutique - $result_liste_achat["montant_paye"] ;
        $erreur = "Vous pouvez pas fair le retrait de ".$montant_transfer."F CFA pour le moment vous pouve fair le retrait de ".$retrait_posible."F CFA";
    }
        }else{
            if($temp_annule->rowCount() === 0){
          //reste apres retrait
          $retrait_boutique = $solde_boutique - $montant_transfer ;
          // totale apres depot
          $depot_user = $solde_user + $montant_transfer;
  
          // traitement solde boutique
         $inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
         $inser_solde_boutique -> execute(array($retrait_boutique, $_SESSION["id_boutique"]));
  
          // traitement solde user
          $inser_solde_boutique = $db->prepare("UPDATE user SET solde = ? WHERE id = ? ");
          $inser_solde_boutique -> execute(array($depot_user, $id));
  
          $date_transaction = time();
         $frait = 0;
         $historique = $db->prepare("INSERT INTO transaction_transfer (id_retrait, id_depot, montant_envoie, frait_retrait, montant_totale, date_transfer) VALUES (?,?,?,?,?,?)");
         $historique -> execute(array($_SESSION["id_boutique"], $id, $montant_transfer, $frait, $montant_transfer, $date_transaction));
  
         header ('Location: ../../grand.php');
        }
        }
    }
 

}


          }else{
            $erreur = "Solde insuffisant";
            $erreure = "Votre sode est de ".$solde_boutique."F CFA";
          }
        }else{
            $erreur = "Mot de pase incorrecte !";
        }

    }else{
        $erreure = "Entrer votre mot de passe !";
    }

}else{
    $montant_transfer = $_POST["montant"];
    $pourcentage = 2;
    $resultat = ($pourcentage / 100) * $montant_transfer;
    $montant =   $montant_transfer + $resultat ;
// debut
    if(!empty($_POST["password"])){
        $user = $db->prepare("SELECT * FROM user WHERE id = ? ");
        $user-> execute(array($_SESSION["id"]));
        $result_user = $user->fetch();
        $result_user["mot_de_passe"];
        if($password === $result_user["mot_de_passe"] ){
          $solde_boutique = $result_rec_boutique["solde_boutique"];
          if($solde_boutique >= $montant  ){

$liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND livre LIKE 'non'");
$liste_achat-> execute(array($_SESSION["id_boutique"]));
$result_liste_achat = $liste_achat->rowCount();
if($liste_achat->rowCount() === 1){
    $liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND livre LIKE 'non'");
    $liste_achat-> execute(array($_SESSION["id_boutique"]));
    $result_liste_achat = $liste_achat->fetch();
    $result_liste_achat["montant_paye"];
    // reste apres retrait
    $retrait_boutique = $solde_boutique - $montant ;
    if($retrait_boutique >= $result_liste_achat["montant_paye"]){
 // reste apres retrait
 $retrait_boutique = $solde_boutique - $montant ;
 // totale apres depot
 $depot_user = $solde_user + $montant_transfer;
 // montant transfer
 $montant_transfer;
 // frai de retrait
 $resultat;

 // traitement solde boutique
 $inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
 $inser_solde_boutique -> execute(array($retrait_boutique, $_SESSION["id_boutique"]));

 // traitement solde user
 $inser_solde_boutique = $db->prepare("UPDATE user SET solde = ? WHERE id = ? ");
 $inser_solde_boutique -> execute(array($depot_user, $id));

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
 $type_transaction = "Frait d'envoie";
 $montant_transacte = $resultat;
 $id_beneficier =  $id;
 $beneficier = $nom;
 $id_deduit = $_SESSION["id_boutique"];
 $deduit = $result_rec_boutique["nom_boutique"];
 $date_transaction = time();
 $transactions = $db->prepare("INSERT INTO transaction_kephale (type_transactions, id_beneficier, beneficier, id_deduit, deduit, montant_transaction, date_transaction ) VALUES (?,?,?,?,?,?,?)");
 $transactions -> execute(array($type_transaction, $id_beneficier, $beneficier, $id_deduit, $deduit, $montant_transacte, $date_transaction));
 
 $historique = $db->prepare("INSERT INTO transaction_transfer (id_retrait, id_depot, montant_envoie, frait_retrait, montant_totale, date_transfer) VALUES (?,?,?,?,?,?)");
 $historique -> execute(array($_SESSION["id_boutique"], $id, $montant_transfer, $resultat, $montant, $date_transaction));


 header ('Location: ../../grand.php');
    }else{
        $retrait_posible = $solde_boutique - $result_liste_achat["montant_paye"] ;
        $erreur = "Vous pouvez pas fair le retrait de".$montant."F CFA pour le moment vous pouve fair le retrait de".$retrait_posible."F CFA";
    }

}else{
$temp_annule = $db->prepare("SELECT * FROM temp_annule WHERE id_boutique = ? AND etat LIKE 'a'");
$temp_annule-> execute(array($_SESSION["id_boutique"]));
$result_temp_annule = $temp_annule->rowCount();
if($temp_annule->rowCount() >= 2){
    $erreur = "Vous pouve pas faire de retrait pour le moment par ce que le monbre de vos article en coure de validation est superieur a 2 arcle.";
}else{
    if($temp_annule->rowCount() === 1){
        $result_temp_annulee = $temp_annule->fetch();
            

        $liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND temp_livraison = ?  ");
        $liste_achat-> execute(array($_SESSION["id_boutique"], $result_temp_annulee["temp_article"] ));
        $result_liste_achat = $liste_achat->fetch();

$retrait_boutique = $solde_boutique - $montant ;
    if($retrait_boutique >= $result_liste_achat["montant_paye"]){
// reste apres retrait
$retrait_boutique = $solde_boutique - $montant ;
// totale apres depot
$depot_user = $solde_user + $montant_transfer;
// montant transfer
$montant_transfer;
// frai de retrait
$resultat;

// traitement solde boutique
$inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
$inser_solde_boutique -> execute(array($retrait_boutique, $_SESSION["id_boutique"]));

// traitement solde user
$inser_solde_boutique = $db->prepare("UPDATE user SET solde = ? WHERE id = ? ");
$inser_solde_boutique -> execute(array($depot_user, $id));

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
$type_transaction = "Frait d'envoie";
$montant_transacte = $resultat;
$id_beneficier =  $id;
$beneficier = $nom;
$id_deduit = $_SESSION["id_boutique"];
$deduit = $result_rec_boutique["nom_boutique"];
$date_transaction = time();
$transactions = $db->prepare("INSERT INTO transaction_kephale (type_transactions, id_beneficier, beneficier, id_deduit, deduit, montant_transaction, date_transaction ) VALUES (?,?,?,?,?,?,?)");
$transactions -> execute(array($type_transaction, $id_beneficier, $beneficier, $id_deduit, $deduit, $montant_transacte, $date_transaction));

$historique = $db->prepare("INSERT INTO transaction_transfer (id_retrait, id_depot, montant_envoie, frait_retrait, montant_totale, date_transfer) VALUES (?,?,?,?,?,?)");
$historique -> execute(array($_SESSION["id_boutique"], $id, $montant_transfer, $resultat, $montant, $date_transaction));


header ('Location: ../../grand.php');


    }else{
        $retrait_posible = $solde_boutique -  $result_liste_achat["montant_paye"] ;
        $erreur = "Vous pouvez pas fair le retrait de".$montant."F CFA pour le moment vous pouve fair le retrait de".$retrait_posible."F CFA";
    }

    }else{
        if($temp_annule->rowCount() === 0){
    // reste apres retrait
    $retrait_boutique = $solde_boutique - $montant ;
    // totale apres depot
    $depot_user = $solde_user + $montant_transfer;
    // montant transfer
    $montant_transfer;
    // frai de retrait
    $resultat;
   
    // traitement solde boutique
    $inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
    $inser_solde_boutique -> execute(array($retrait_boutique, $_SESSION["id_boutique"]));
   
    // traitement solde user
    $inser_solde_boutique = $db->prepare("UPDATE user SET solde = ? WHERE id = ? ");
    $inser_solde_boutique -> execute(array($depot_user, $id));
   
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
    $type_transaction = "Frait d'envoie";
    $montant_transacte = $resultat;
    $id_beneficier =  $id;
    $beneficier = $nom;
    $id_deduit = $_SESSION["id_boutique"];
    $deduit = $result_rec_boutique["nom_boutique"];
    $date_transaction = time();
    $transactions = $db->prepare("INSERT INTO transaction_kephale (type_transactions, id_beneficier, beneficier, id_deduit, deduit, montant_transaction, date_transaction ) VALUES (?,?,?,?,?,?,?)");
    $transactions -> execute(array($type_transaction, $id_beneficier, $beneficier, $id_deduit, $deduit, $montant_transacte, $date_transaction));
    
    $historique = $db->prepare("INSERT INTO transaction_transfer (id_retrait, id_depot, montant_envoie, frait_retrait, montant_totale, date_transfer) VALUES (?,?,?,?,?,?)");
    $historique -> execute(array($_SESSION["id_boutique"], $id, $montant_transfer, $resultat, $montant, $date_transaction));
   
   
    header ('Location: ../../grand.php');
        }
    }

}
}
           
            


          }else{
            $erreur = "Solde insuffisant";
            $erreure = "Votre sode est de ".$solde_boutique."F CFA";
          }
        }else{
            $erreur = "Mot de pase incorecte !";
        }
    }else{
$erreure = "Entrer votre mot de passe !";
}
// fin
}
}else{
    $erreur = "Entrer le montant de transfer !";
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../../../css/css/style.css">
    <title>Document</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="numero.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
    </section>
    
    <section class="section_input">
        <h1 class="texte_standare" ></h1>
        <p style="text-align: left; width: 280px;"><span style="font-weight: 600;">Info du destinateur</span></p>
        <p style="text-align: left; width: 280px;"><span style="font-weight: 600;">Nom: </span><?php echo  $nom  ?></p>
        <p style="text-align: left; width: 280px;"><span style="font-weight: 600;">Numéro: </span>(+223 <?php echo  $telephone  ?>)</p>
        <?php
         if($id === $id_users){
            ?>
            <p style="font-size: 12px; text-align: left; width: 280px;">Le frait de transfer entre votre boutique et votre compte d'utilisateur est de 0.0F CFA </p>
            <?php
        }else{
            ?>
            <p style="font-size: 12px; text-align: left; width: 280px;">Le frait de transfer est de 2% du montant.</p>
            <?php
        }
        ?>
        <?php
         if($id === $id_users){
            if(!empty($_POST["montant"])){
            ?>
            <section style="margin: 10px; width: 280px; " class="info_prix">
                <h4>Montant: <span style="font-weight: 400;" class="valeur_article"><?php echo $montant_transfer ?>F CFA</span></h4>
                <h4>Frait d'envoi: <span style="font-weight: 400;"  class="valeur_article">0.0F CFA</span></h4>
                <h4>Totale d'envoi: <span style="font-weight: 400;"  class="valeur_article"><?php echo $montant_transfer ?>F CFA</span></h4>
                </section>
            <?php
             }
        }else{
            if(!empty($_POST["montant"])){
                ?>
                <section style="margin: 10px; width: 280px; " class="info_prix">
                    <h4>Montant: <span style="font-weight: 400;" class="valeur_article"><?php echo $montant_transfer ?>F CFA</span></h4>
                    <h4>Frait d'envoi: <span style="font-weight: 400;"  class="valeur_article"><?php echo $resultat ?>F CFA</span></h4>
                    <h4>Totale d'envoi: <span style="font-weight: 400;"  class="valeur_article"><?php echo $montant ?>F CFA</span></h4>
                    </section>
                <?php
              }
        }
         
            ?>
    
        <form class="section_form" method="POST" enctype="multipart/form-data">
            <input class="form_input" type="number" placeholder="Montant a fransfere" name="montant" value="<?php if(isset($montant_entre)) {echo $montant_entre;} ?>">
            <?php
          if(!empty($_POST["montant"])){
            ?>
            <input class="form_input" type="password" placeholder="Mote de passe" name="password" >
            <?php
          }
            ?>
            <input class="form_input_botone" class="submit" type="submit" value="Suivant" name="suivant">
        </form>
        <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>
                        <?php
                    }
                    ?>
                     <?php
                    if(isset ($erreure)){
                        ?>
                        <h1 class="texte_minime" ><?php echo $erreure ?></h1>
                        <?php
                    }
                    ?>
        
    </section>
</body>
</html>