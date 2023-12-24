<?php
session_start();
include_once "../../kephale_bdd/kephale_bdd.php";
if($_SESSION["id"] > 0){
    $getId = intval($_SESSION["id"]);
    $reqUser = $db->prepare("SELECT * FROM user WHERE id = ? ");
    $reqUser -> execute(array($_SESSION["id"])); 
    $UserInfo = $reqUser->fetch();

    $req_boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
    $req_boutique -> execute(array($_SESSION["id"])); 
    $result_req_boutique = $req_boutique->rowCount();

}else{
    header ('Location: ../../page/conct_inscrt/connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
    <section class="nav_bare " >
        <a href="../../index.php">
        <img style="margin-left: 12px; width: 30px; height: 30px;" class="icon_user" src="../../media/icone/accuil.svg" alt="">
        </a>
        <h1 class="texte_nom_user"><?php echo $UserInfo["nom"]?></h1>
        <a class="bloc_lien_user">
        <img class="img_user" src="../../page/conct_inscrt/img_profile_user/<?php echo $UserInfo["img_profile"]?> " alt="">
        </a>
    </section>
    <div style="padding-top: 70px;" ></div>
    <section class="section_grand_bloc">
        <section class="section_element" >
        <section class="section_universel">

<div style="display: flex; ">
<section class="section_solde">
    <h1 class="solde">Solde</h1>
    <h1 class="solde_user"><?php echo $UserInfo["solde"]?> FCFA</h1>
</section>
</div>
<div style="display: flex; ">
<a class="botton_retrait" href="">
    <img class="icon_menu" src="../../media/icone/recharge.svg">
    <h1 class="texte_retrait">charge</h1>
</a>
<a class="botton_retrait" href="">
    <img class="icon_menu" src="../../media/icone/retrais.svg">
    <h1 class="texte_retrait">Retrais</h1>
</a>
</div>
</section>
        </section>
    </section>


















    <section class="section_menu_icon">
        <a class="lien_icon" href="page_user/parametre/parametre_user.php">
            <img class="icon_menu" src="../../media/icone/parametre.svg" alt="">
        </a>
        <?php
        if($result_req_boutique > 0 ){
            ?>
            <a class="lien_icon" href="src/mot_de_passe.php">
            <img class="icon_menu" src="../../media/icone/user_boutique.svg" alt="">
            </a>
            <?php
        }else{
            ?>
            <a class="lien_icon" href="src/abonnement.php">
            <img class="icon_menu" src="../../media/icone/boutique.svg" alt="">
        </a>
            <?php
        }
        ?>

        <a class="lien_icon" href="page_user/liste_article/liste_article_user.php">
            <img class="icon_menu" src="../../media/icone/notification.svg" alt="">
            <?php
            $eta_commande = 'confirme';
            $liste_commende = $db->prepare("SELECT * FROM article_commande WHERE id_user = ? AND eta_commande = ? ");
            $liste_commende -> execute(array($_SESSION["id"], $eta_commande)); 
            if($liste_commende->rowCount() > 0 ){
                ?>
                <section class="alerte_conteur">
                <p class="conteur"><?php echo $liste_commende->rowCount(); ?></p>
                </section>
                 <?php
            }
            ?>
        </a>
        <a class="lien_icon" href="page_user/liste_achat/index.php">
            <img class="icon_menu" src="../../media/icone/panye.svg" alt="">
            <?php
            $livre = 'nom';
            $liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_user = ? AND livre LIKE 'non' ");
            $liste_achat -> execute(array($_SESSION["id"])); 
            if($liste_achat->rowCount() > 0 ){
                ?>
                <section class="alerte_conteur">
                <p class="conteur"><?php echo $liste_achat->rowCount(); ?></p>
                </section>
                 <?php
            }
            ?>
        </a>
    </section>
</body>
</html>