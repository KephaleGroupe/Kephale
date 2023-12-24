<?php
session_start();
include_once "../kephale_bdd/kephale_bdd.php";

if(isset($_POST["conection"])){
    $nom_user = htmlspecialchars($_POST["nom_user"]);
    $passwor_usre = sha1($_POST["password_user"]);
    if(isset($_POST ["nom_user"]) AND !empty($_POST ["nom_user"])){
        if(isset($_POST ["password_user"]) AND !empty($_POST ["password_user"])){
            $code = 'LKB23SCVWBJL0073BDWDSBSK4563823';
            $codefinale =  $code.$passwor_usre.$code;

            $req_user = $db->prepare ("SELECT * FROM admine WHERE nom = ? AND mot_de_passe = ? ");
            $req_user -> execute([$nom_user,$codefinale]); 
            $exist_user = $req_user -> fetch(PDO::FETCH_ASSOC); 
            $_SESSION['id_admine'] = $exist_user['id'];
            $_SESSION['nom'] = $exist_user['nom'];
            $_SESSION['mot_de_passe'] = $exist_user['mot_de_passe'];

            if($nom_user === $exist_user['nom']){

                if($_SESSION['mot_de_passe'] === $codefinale ){
            header ('Location: index.php');

                }else{
                    $erreur = 'Mot de passe incorecte.';
                }
            }else{
                $erreur = 'Nom incorecte.';
            }

            
        }else{
        $erreur = 'Entre votre mot de passe !';
        }
    }else{
        $erreur = 'Entre votre nom!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css/style.css">
    <title>kephale</title>
</head>
<body>
<section class="section_input">
    <a href="../../index.php">
    <img style="width: 170px; margin-bottom: 10px;" class="img_logo" src="../media/logo/kephale.png" alt="">
    </a>
        <h1 class="texte_standare" >Administrations</h1>
        <form class="section_form" method="POST" enctype="multipart/form-data">
            <input class="form_input" type="text" placeholder="Votre nom" name="nom_user" value="<?php if(isset($nom_user)) {echo $nom_user;} ?>">
            <input class="form_input" type="password" placeholder="Mot de passe" name="password_user">
            <input class="form_input_botone" class="submit" type="submit" value="Commexion" name="conection">
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