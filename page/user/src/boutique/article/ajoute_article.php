<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";
$id_boutique = $_GET["id_boutique"];
$id_produit = $_GET["id_produit"];

if(isset($_POST["envoi_article"])){
    $nom_article = htmlspecialchars($_POST["nom_article"]);
    if(isset($_POST["nom_article"]) AND !empty($_POST["nom_article"])){
        if(isset($_FILES["img_articles"]["tmp_name"]) AND !empty($_FILES["img_articles"]["tmp_name"])){
            $img_name = pathinfo($_FILES["img_articles"]["name"], PATHINFO_FILENAME);
                $img_expentions = pathinfo($_FILES["img_articles"]["name"], PATHINFO_EXTENSION);
                $nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;

                $taille_fichier = filesize($_FILES["img_articles"]["tmp_name"]);
$taille_en_ko = $taille_fichier / 1024 ;
$taille_en_mo = $taille_en_ko / 1024 ;
round($taille_en_ko ,2);
$img_autorise = ['jpg','jpeg','png','PNG','JPG','JPEG'];
if(round($taille_en_mo ,1) <= 5){

                        if(in_array($img_expentions,$img_autorise )){
                $img_direction = "img_article/";
                $img_telecharge = $img_direction . $nom_img;
                move_uploaded_file ($_FILES["img_articles"]["tmp_name"], $img_telecharge);
                if(empty(move_uploaded_file ($_FILES["img_articles"]["tmp_name"], $img_telecharge))){
                    $inserArticle = $db->prepare("INSERT INTO articles ( nom_article, id_produit, id_boutique, img_article) VALUES (?,?,?,?)");
                    $inserArticle -> execute(array($nom_article, $id_produit, $id_boutique, $nom_img ));
                    header ('Location: article.php?id_produit='.$_GET["id_produit"]);

                }

                        }else{
                    $erreur = "l'expentions .".$img_expentions." n'est pas une image autorisée, seul les photos aux forment jpg, jpeg, png sons autorisée.";

                        }
                    }else{
                        $erreur = "La taille de votre image est de ".round($taille_en_mo ,1)."Mo elle ne doit pas depase 5Mo ";
                        
                    }
                    
              
        }else{
            $erreur = 'Insere une image';
        }
    }else{
        $erreur = 'Entre le nom de votre article';
    }
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
    <a class="lien_icon" href="article.php?id_produit=<?php echo $id_produit ?>">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../media/icone/retoure.svg" alt="">
    </a>
    <h1 class="texte_moien_titre" >Ajoute l'article</h1>
        <form class="section_form" method="POST" enctype="multipart/form-data">
            <input class="form_input" type="text" placeholder="Nom de l'article" name="nom_article" value="<?php if(isset($nom_article)) {echo $nom_article;} ?>">
                <input type="file" id="file" name="img_articles">
                <h1 class="texte_minime" >Ajoute une </h1>
            <label for="file">
                <img src="../../../../../media/icone/fill_img.svg" alt="">
                Image
            </label>
            <input class="form_input_botone submit" type="submit" value="Ajoute l'article" name="envoi_article">
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




