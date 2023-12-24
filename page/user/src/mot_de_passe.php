<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";
$req_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
$req_user -> execute(array($_SESSION["id"])); 
$result_req_user = $req_user->fetch();
$grand = 'grand';
if(isset($_POST["achete"])){
    $passwor_usre = sha1($_POST["passwor_usre"]);
    if(isset($_POST["passwor_usre"]) AND !empty($_POST["passwor_usre"])){
        if($result_req_user["mot_de_passe"] == $passwor_usre){
           
                header ('Location: boutique/grand.php');
                
    } else{
        $erreur = 'Mot de passe incorecte !';
        
        
    }
}else{
    $erreur = 'Entre votre mot de passe !';
    
    
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/css/style.css">
    <title>kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="../user.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
 <?php
if(isset($_SESSION["id"] )){
    ?>
    <section class="section_input">
    <h1 class="texte_petit_titre">Entre Votre mot de passe</h1>
    <form  class="section_form" method="POST" enctype="multipart/form-data">
    <input class="form_input" type="password" placeholder="Mot de passe" name ="passwor_usre">
    <input class="form_input_botone" type="submit" value="Confirme" name ="achete">
    </form>
    <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>
                        <?php
                    }
                    ?>
    </section>
    <?php
}
    ?>
</body>
</html>