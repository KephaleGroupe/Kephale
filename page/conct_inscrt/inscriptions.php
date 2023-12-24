<?php
session_start();
include_once "../../kephale_bdd/kephale_bdd.php";
include_once "php/inscription.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css/style.css">
    <title>Inscriptions</title>
</head>
<body>
<section class="section_input">
    <a href="../../index.php">
    <img style="width: 90px; margin-bottom: 10px;" class="img_logo" src="../../media/logo/logo_kephale.png" alt="">
    </a>
        <h1 class="texte_standare" >Inscriptions</h1>
        <form class="section_form" method="POST" enctype="multipart/form-data" >
            <input class="form_input" type="text" placeholder="Nom d'utilisateur" name="nom_user" value="<?php if(isset($nom_user)) {echo $nom_user;} ?>">
            <input class="form_input" type="number" placeholder="Numéro de telephone" name="numeraux_user" value="<?php if(isset($numerau_user)) {echo $numerau_user;} ?>">
            <input class="form_input" type="password" placeholder="Mot de passe" name="password_user">
            <input class="form_input" type="password" placeholder="Confirmer votre mot de passe" name="password_user_2">
            <input type="file" id="file" name="img_user_profil">
            <h1 class="texte_minime" >Inserer une </h1>
            <label for="file">
                <img src="../../media/icone/fill_img.svg" alt="">
                Image
            </label>
            <input class="form_input_botone" class="submit" type="submit" value="Connexion" name="inscription_user">
            <h1 class="texte_minime" >Se<a class="texte_lien" href="connexion.php"> connecter...</a></h1>
        </form>
        <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>

                        <?php
                    }
                    ?>
    </section>
</body>
</html>