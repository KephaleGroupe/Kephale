<?php
session_start();
include_once "kephale_bdd/kephale_bdd.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="manifest" href="manifest.json">
    <title>Kephale Groupe</title>
</head>
<body>
    <section class="nav_bare" >
        <img class="img_logo" src="media/logo/logo_kephale.png" alt="">
        
        <?php
        if($_SESSION["id"] > 0){
            $getId = intval($_SESSION["id"]);
            $reqUser = $db->prepare("SELECT * FROM user WHERE id = ? ");
            $reqUser -> execute(array($_SESSION["id"])); 
            $UserInfo = $reqUser->fetch();
            ?> 
            <a class="bloc_lien_user" href="page/user/user.php">
            <img class="img_user" src="page/conct_inscrt/img_profile_user/<?php echo $UserInfo["img_profile"]?> " alt="">
            </a>
            <?php
        }else{
            ?>
            <a href="page/conct_inscrt/connexion.php">
               
            <img class="icon_user" src="media/icone/user.svg" alt="">
            </a>
            <?php
        }
        ?>
    </section>
    <div style="padding-top: 70px;" ></div>

    <section class="section_pub">
        <img class="img_anim" src="media/logo/anim_kephal.gif" alt="">
    </section>

    <section class="bloc_scrole_menu">
        <section class="scrole">
        <a class="slider" href="page/publique/homme/boutique.php">
            <img class="slider_img" src="img_page/Hommes.png" alt="">
        </a>

        <a class="slider" href="page/publique/femme/boutique.php">
        <img class="slider_img" src="img_page/Femmes.png" alt="">
        </a>

        <a class="slider" href="page/publique/enfant/boutique.php">
        <img class="slider_img" src="img_page/Enfants.png" alt="">
        </a>

        <a class="slider" href="page/publique/electronique/boutique.php">
        <img class="slider_img" src="img_page/Electro.png" alt="">
        </a>

        <a class="slider" href="page/publique/cosmetique/boutique.php">
        <img class="slider_img" src="img_page/cosmetique.png" alt="">
        </a>
    
        </section>
    </section>

    <section class="section_reste_info">
        <a class="lien_produit_reste" href="page/publique/restaurant/boutique.php">
            <img  src="img_page/Restau_recup.png" alt="">
        </a>

        <a class="lien_produit_reste" href="page/publique/boisson/boutique.php">
            <img  src="img_page/boison_reste.png" alt="">
        </a>

        <a class="lien_produit_reste" href="page/publique/immo/boutique.php">
            <img  src="img_page/Immo_reste.png" alt="">
        </a>

        <a class="lien_produit_reste" href="page/publique/voiture/boutique.php">
            <img  src="img_page/Voiture_retse.png" alt="">
        </a>
    </section>
</body>
</html>