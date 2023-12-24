<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";
$id_boutique = $_GET["id_boutique"];
if(isset($_SESSION["id"])){
if(isset($_POST["envoi_produit"])){
    $nom_produits = htmlspecialchars($_POST["nom_produit"]);
    $type_produits = htmlspecialchars($_POST["type_produit"]);
    if(isset($_POST["nom_produit"]) AND !empty($_POST["nom_produit"])){
        if(isset($_POST["type_produit"]) AND !empty($_POST["type_produit"])){
            if(isset($_FILES["img_produit"]["tmp_name"]) AND !empty($_FILES["img_produit"]["tmp_name"])){
                $img_name = pathinfo($_FILES["img_produit"]["name"], PATHINFO_FILENAME);
                $img_expentions = pathinfo($_FILES["img_produit"]["name"], PATHINFO_EXTENSION);
                $nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;

                $taille_fichier = filesize($_FILES["img_produit"]["tmp_name"]);
                $taille_en_ko = $taille_fichier / 1024 ;
                $taille_en_mo = $taille_en_ko / 1024 ;
                round($taille_en_ko ,2);
                $img_autorise = ['jpg','jpeg','png','PNG','JPG','JPEG'];
                if(round($taille_en_mo ,1) <= 5){
                        if(in_array($img_expentions,$img_autorise )){
                           
                $img_direction = "img_produit/";
                $img_telecharge = $img_direction . $nom_img;
                move_uploaded_file ($_FILES["img_produit"]["tmp_name"], $img_telecharge);
                if(empty(move_uploaded_file ($_FILES["img_produit"]["tmp_name"], $img_telecharge))){
                    $inserProduit = $db->prepare("INSERT INTO produits ( id_boutique, nom_produit, img_produit, type_produit) VALUES (?,?,?,?)");
                    $inserProduit -> execute(array($id_boutique, $nom_produits, $nom_img, $type_produits ));
                    header ('Location: ../grand.php');
                    }

                        }else{
                    $erreur = "l'expentions .".$img_expentions." n'est pas une image autorisée, seul les photos aux formants jpg, jpeg, png  sont autorisées.";

                        }
                    }else{
                        $erreur = "La taille de votre image est de ".round($taille_en_mo ,1)."Mo elle ne doit pas depase 5Mo ";
                        
                    }
                

            }else{
            $erreur = 'Insere une image';
            }
        }else{
            $erreur = 'Selectionner le type de produit';
        }
    }else{
        $erreur = 'Entrer le nom du produit';
    }

}
}else{
    header ('Location: ../../indesx.php');
}

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
    <section class="section_input">
    <a class="lien_icon" href="../grand.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../media/icone/retoure.svg" alt="">
    </a>
    <h1 class="texte_moien_titre" >Ajoute un produit</h1>
        <form class="section_form" method="POST" enctype="multipart/form-data">
            <input class="form_input" type="text" placeholder="Nom de produit" name="nom_produit" value="<?php if(isset($nom_produits)) {echo $nom_produits;} ?>">
            <h1 class="texte_minime" >Type de produits</h1>
            <?php include_once "info_page/fonction.php"; ?>
                <input type="file" id="file" name="img_produit">
                <h1 class="texte_minime" >Ajoute une </h1>
            <label for="file">
                <img src="../../../../../media/icone/fill_img.svg" alt="">
                Image
            </label>
            <input class="form_input_botone submit" type="submit" value="Ajoute le produit" name="envoi_produit">
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