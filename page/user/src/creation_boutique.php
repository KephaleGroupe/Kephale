<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";
$reqUserId = $db->prepare ("SELECT * FROM user WHERE id = ? ");
$reqUserId -> execute(array($_SESSION["id"])); 
$existUserId = $reqUserId -> fetch(); 
$_SESSION["boutique_user"] = $existUserId["boutique_user"];
$_SESSION["temp_abonement"] = $existUserId["temp_abonement"];
        $user_id = $db->prepare ("SELECT * FROM boutique WHERE id_user = ? ");
        $user_id -> execute(array($_SESSION["id"])); 
        $result_user_id = $user_id -> fetch(); 
        $_SESSION["id_boutique"] = $result_user_id ["id"];
        $_SESSION["tempt_abonnement_boutique"] = $result_user_id ["tempt_abonnement_boutique"];
      
        if(isset($_POST["creat_boutique"])){
            $nom_boutique = htmlspecialchars($_POST["nom_boutique"]);
            $soldeBoutique = '0';
            if(!empty($_POST["nom_boutique"])){
                $reqBoutiquenom = $db->prepare ("SELECT * FROM boutique WHERE nom_boutique = ?"); 
                $reqBoutiquenom -> execute(array($nom_boutique));
                $nomBoutiqueExist = $reqBoutiquenom -> rowCount(); 
                if($nomBoutiqueExist === 0){
                    if(isset($_FILES["img_user_profil"]["tmp_name"]) AND !empty($_FILES["img_user_profil"]["tmp_name"])){
                        $img_name = pathinfo($_FILES["img_user_profil"]["name"], PATHINFO_FILENAME);
                        $img_expentions = pathinfo($_FILES["img_user_profil"]["name"], PATHINFO_EXTENSION);
                        $nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;
                        $img_direction = "img_boutique/";
                        $photo = $_FILES["img_produit"];
                        
                        $nonbre_photo = "1";
                        $img_autorise = ['jpg','jpeg','png'];
                     
                          
                                if(in_array($img_expentions,$img_autorise )){
                                    $img_telecharge = $img_direction . $nom_img;
                                    move_uploaded_file ($_FILES["img_user_profil"]["tmp_name"], $img_telecharge);
                                    $solde_boutique = '0';
                                    $latitude = '0';
                                    $longitude = '0';
                                $inser_boutique = $db->prepare("INSERT INTO boutique ( id_user, nom_boutique, type_abonnement, tempt_abonnement_boutique, solde_boutique, img_boutique, latitude, longitude ) VALUES (?,?,?,?,?,?,?,?)");
                                $inser_boutique -> execute(array($_SESSION["id"], $nom_boutique,$_SESSION["boutique_user"], $existUserId["temp_abonement"],  $solde_boutique, $nom_img, $latitude, $longitude));
                               
                                header ('Location: boutique/grand.php');
                       
                                }else{
                            $erreur = "l'expentions .".$img_expentions." n'est pas une image autorisée, seul les photos en forment jpeg et png sons autorisée.";
        
                                }
                            
                       
                                             
                    }else{
                        $errer = 'Insere une image';
                    }
                    
                }else{
                    $errer = 'Le nom existe dejat';
                }
            }else{
                $errer = 'Entre le nom de votre boutique';
            }
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/css/style.css">

    <title>Kephale</title>
</head>
<body>
<?php
if(isset($_SESSION["id"])){
    ?>
    <section class="section_input">
    <h1 class="texte_petit_titre">Entre le nom de votre Boutique</h1>
    <form  class="section_form" method="POST" enctype="multipart/form-data">
    <input class="form_input" type="text" placeholder="nom" name ="nom_boutique" value="<?php if(isset($nom_boutique)) {echo $nom_boutique;} ?>" >
    <input type="file" id="file" name="img_user_profil">
            <h1 class="texte_minime" >Ajoute une </h1>
            <label for="file">
                <img src="../../../media/icone/fill_img.svg" alt="">
                Image
            </label>
    <input class="form_input_botone" type="submit" value="Confirme l'achat" name ="creat_boutique">
    </form>
    <?php
                    if(isset ($errer)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $errer ?></h1>
                        <?php
                    }
                    ?>
    </section>
    <?php
}else{
    header ('Location: ../../../index.php');
    
}
    ?>
</body>
</html>