<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
    $rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
    $rec_boutique-> execute(array($_SESSION["id"]));
    $result_rec_boutique = $rec_boutique->fetch();
    $_SESSION["id_boutique"] = $result_rec_boutique["id"];

    $rec_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
    $rec_user -> execute(array($_SESSION["id"])); 
    $result_rec_user = $rec_user->fetch();

    $req_produit = $db->prepare("SELECT * FROM produits WHERE id_boutique = ? ORDER BY id DESC " );
    $req_produit-> execute(array($result_rec_boutique["id"]));
    $resulte_req_produit = $req_produit->rowCount();
    //include_once "abonnement.php";

       
if(isset($_SESSION["id"] ) AND $_SESSION["id"] ==  $result_rec_boutique["id_user"] ){
}else{
    $_SESSION = array();
    session_destroy();
    header ('Location:../../../../index.php');
}
include_once "fonction/article_commande.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
<section class="nav_bare transparant" >
        <a href="../../../../index.php">
        <img style="margin-left: 12px; width: 30px; height: 30px;" class="icon_user" src="../../../../media/icone/accuil.svg" alt="">
        </a>
        <h1 class="texte_nom_user"><?php echo $result_rec_boutique["nom_boutique"]?></h1>
        <a class="bloc_lien_user" href="../../user.php">
        <img class="img_user" src="../../../../page/conct_inscrt/img_profile_user/<?php echo $result_rec_user["img_profile"]?> " alt="">
        </a>
    </section>

    <section class="section_grand_bloc">
        <section class="section_element" >
        <section class="section_img_boutique">
            <img class="img_boutique" src="../img_boutique/<?php echo $result_rec_boutique["img_boutique"]?>" alt="">
        </section>

        <section class="section_universel">
            <div style="display: flex; ">
            <?php 
             
            include_once "jour_restant.php";
             ?>


            <section class="section_solde">
                <h1 class="solde">Solde</h1>
                <h1 class="solde_user"><?php echo $result_rec_boutique["solde_boutique"]?> FCFA</h1>
            </section>
            </div>
            
            <a class="botton_retrait" href="paiement/retrait.php">
                <img class="icon_menu" src="../../../../media/icone/retrais.svg">
                <h1 class="texte_retrait">Retrait</h1>
            </a>
        </section>

        <section class="section_universel_deux">
            <section class="section_bloc_lu">
                <a href="article/ajoute_produit.php?id_boutique=<?php echo $result_rec_boutique ["id"]  ?>">
                <h1>Ajoute vos produit</h1>
                </a>
            </section>

            <?php 
             if($resulte_req_produit > 0 ){
                while($result = $req_produit->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <section class="section_bloc_produit">
                <img class="img_produit" src="article/img_produit/<?php echo $result ["img_produit"]  ?>" alt="">
                <section class="texte_produt">
                    <h1 class="texte_titre_produit"><?php echo $result ["nom_produit"]  ?></h1>
                    <h1 class="texte_petit_titre_produit"><?php echo $result ["type_produit"]  ?></h1>
                </section>
                <a href="article/article.php?id_produit=<?php echo $result ["id"]?>">
                <img class="icon_menu doc" src="../../../../media/icone/document.svg" alt="">
                </a>
                <a class="sup_lien" href="article/supresion/suprime_produit.php?id_produit=<?php echo $result ["id"]?>">
                <img class="icon_menu suprime" src="../../../../media/icone/suprime.svg" alt="">
                </a>
            </section>
                    <?php 
                }
             }
            ?>
            


        </section>

        </section>
    </section>

















 <?php include_once "barre_icon.php"; ?>


  





</body>
</html>