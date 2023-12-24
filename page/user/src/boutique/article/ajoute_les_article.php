<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";
$id_produit = $_GET["id_produit"];
$id_article = $_GET["id_article"];

if(isset($_POST["envoi_les_article"])){
    $nom_article = htmlspecialchars($_POST["nom_article"]);
    $prix_article = htmlspecialchars($_POST["prix_article"]);
    $descriptions_article = htmlspecialchars($_POST["descriptions_article"]);
    if(isset($_POST["nom_article"]) AND !empty($_POST["nom_article"])){
        if(isset($_POST["prix_article"]) AND !empty($_POST["prix_article"])){
            if(isset($_POST["descriptions_article"]) AND !empty($_POST["descriptions_article"])){
                if(isset($_FILES["img_article"]["tmp_name"]) AND !empty($_FILES["img_article"]["tmp_name"])){
                $img_name = pathinfo($_FILES["img_article"]["name"], PATHINFO_FILENAME);
                $img_expentions = pathinfo($_FILES["img_article"]["name"], PATHINFO_EXTENSION);
                $nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;

                $taille_fichier = filesize($_FILES["img_article"]["tmp_name"]);
                $taille_en_ko = $taille_fichier / 1024 ;
                $taille_en_mo = $taille_en_ko / 1024 ;
                round($taille_en_ko ,2);
                $img_autorise = ['jpg','jpeg','png','PNG','JPG','JPEG'];
                if(round($taille_en_mo ,1) <= 5){
                        if(in_array($img_expentions,$img_autorise )){
                            $img_direction = "img_les_articles/";
                            $img_telecharge = $img_direction . $nom_img;
                            move_uploaded_file ($_FILES["img_article"]["tmp_name"], $img_telecharge);
                            if(empty(move_uploaded_file ($_FILES["img_article"]["tmp_name"], $img_telecharge))){
                                $inserArticle = $db->prepare("INSERT INTO les_articles (id_article, id_produit, nom_articles, prix_articles, descriptions_articles, img_articles ) VALUES (?,?,?,?,?,?)");
                                $inserArticle -> execute(array($id_article, $id_produit, $nom_article, $prix_article, $descriptions_article, $nom_img, ));
                                header ('Location: les_article.php?id_article='.$id_article.'&id_produit='.$id_produit);
                            }
            

                        }else{
                    $erreur = "l'expentions .".$img_expentions." n'est pas une image autorisée, seul les photos aux forment jpg, jpeg, png sons autorisée.";

                        }
                    }else{
                        $erreur = "La taille de votre image est de ".round($taille_en_mo ,1)."Mo elle ne doit pas depase 5Mo ";
                        
                    }
                    
              

             
                }else{
                    $erreur = 'insere la photo de l';
                }
            }else{
                $erreur = 'Entre la description de votre aticle';
            }
        }else{
            $erreur = 'Entre le prix de votre aticle';
        }
    }else{
        $erreur = 'Entre le nom de votre aticle';
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
    <a class="lien_icon" href="les_article.php?id_article=<?php echo $id_article ?>&id_produit=<?php echo $id_produit ?>">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../media/icone/retoure.svg" alt="">
    </a>
    <h1 class="texte_moien_titre" >Ajoute l'article</h1>
        <form class="section_form" method="POST" enctype="multipart/form-data">
            <input class="form_input" type="text" placeholder="Nom de l'article" name="nom_article" value="<?php if(isset($nom_article)) {echo $nom_article;} ?>">
            <input class="form_input" type="number" placeholder="Prix de l'article" name="prix_article" value="<?php if(isset($prix_article)) {echo $prix_article;} ?>">
            <input class="form_input" type="text" placeholder="Descriptions" name="descriptions_article" value="<?php if(isset($descriptions_article)) {echo $descriptions_article;} ?>">


                <input type="file" id="file" name="img_article">
                <h1 class="texte_minime" >Ajoute une </h1>
            <label for="file">
                <img src="../../../../../media/icone/fill_img.svg" alt="">
                Image
            </label>
            <input class="form_input_botone submit" type="submit" value="Ajoute l'article" name="envoi_les_article">
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