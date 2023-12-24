<?php
session_start();
include_once "../kephale_bdd/kephale_bdd.php";
session_start();
if(isset($_POST["conection"])){
    $nom_user = htmlspecialchars($_POST["nom_user"]);
    $fonction = htmlspecialchars($_POST["fonction"]);
    $passwor_usre = sha1($_POST["password_user"]);
    if(isset($_POST ["nom_user"]) AND !empty($_POST ["nom_user"])){
        if(isset($_POST ["password_user"]) AND !empty($_POST ["password_user"])){
            if(isset($_POST ["fonction"]) AND !empty($_POST ["fonction"])){
                $code = 'LKB23SCVWBJL0073BDWDSBSK4563823';
                $codefinale =  $code.$passwor_usre.$code;
                $inser_user = $db->prepare("INSERT INTO admine ( nom, mot_de_passe, fonctions) VALUES (?,?,?)");
                $inser_user -> execute(array($nom_user, $codefinale,  $fonction));
                
                header ('Location: conection.php');
                
            }else{
                $erreur = 'Entre la fonctions';
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

    <title>Kephale</title>
</head>
<body>
<section class="section_input">
    <a href="../../index.php">
    <img style="width: 170px; margin-bottom: 10px;" class="img_logo" src="../media/logo/kephale.png" alt="">
    </a>
        <h1 class="texte_standare" >Administrations</h1>
        <h1 class="texte_standare" >Inscriptions</h1>
        <form class="section_form" method="POST" enctype="multipart/form-data">
            <input class="form_input" type="text" placeholder="Votre nom" name="nom_user" value="<?php if(isset($nom_user)) {echo $nom_user;} ?>">
            <input class="form_input" type="password" placeholder="Mot de passe" name="password_user">
            <select class="section_selecte" name="fonction">
                    <option value="">Sélectionne</option>
                    <option value="directeur">Directeur</option>
                    <option value="contable">Contable</option>
                    <option value="chef_livreur">Chef Livreur</option>
                    <option value="livreur">Livreur</option>
                </select>
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