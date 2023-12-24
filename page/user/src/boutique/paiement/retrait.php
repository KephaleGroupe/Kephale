<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";
$rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
$rec_boutique-> execute(array($_SESSION["id"]));
$result_rec_boutique = $rec_boutique->fetch();
$_SESSION["id_boutique"] = $result_rec_boutique["id"];
if(isset($_SESSION["id"] ) AND $_SESSION["id"] ==  $result_rec_boutique["id_user"] ){
}else{
    $_SESSION = array();
    session_destroy();
    header ('Location:../../../../../index.php');
}

$liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND livre LIKE 'non'");
$liste_achat-> execute(array($_SESSION["id_boutique"]));
$result_liste_achat = $liste_achat->rowCount();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="../grand.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
 <?php
if($liste_achat->rowCount() >= 2){
    ?>
    <?php
    }else{
        if($liste_achat->rowCount() === 1){
            $liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND livre LIKE 'non'");
            $liste_achat-> execute(array($_SESSION["id_boutique"]));
            $result_liste_achat = $liste_achat->fetch();
            $result_liste_achat["montant_paye"];
            
            ?>
     <h4 style="color: red;">Allerte</h4>
     <style>
        .color{
            text-align: center;
        }
     </style>
     <h4 style="font-size: 12px; text-align: center;">Vous aves un article en coure de validation le solde <br> de votre compte doit être superieur a
    <?php echo $result_liste_achat["montant_paye"] ?>F CFA</h4>
    <section class="bloc_retrait">
        <a class="lien_retrai" href="kephale/numero.php">
            <img class="img_retrait" src="img/kephale_Plan.png" alt="">
        </a>
        <a class="lien_retrai" href="">
            <img class="img_retrait" src="img/moove_money.png" alt="">
        </a>
        <a class="lien_retrai" href="">
            <img class="img_retrait" src="img/orange_money.png" alt="">
        </a>
    </section>
            <?php
        }else{
            ?>
            <h4>Retrait</h4>
           <section class="bloc_retrait">
               <a class="lien_retrai" href="kephale/numero.php">
                   <img class="img_retrait" src="img/kephale_Plan.png" alt="">
               </a>
               <a class="lien_retrai" href="">
                   <img class="img_retrait" src="img/moove_money.png" alt="">
               </a>
               <a class="lien_retrai" href="">
                   <img class="img_retrait" src="img/orange_money.png" alt="">
               </a>
           </section>
                   <?php
        }
    }

 


?>
</body>
</html>