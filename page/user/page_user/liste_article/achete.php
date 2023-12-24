<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
$id_article = $_GET["id_article"];
$id_boutique = $_GET["id_boutique"];

$article = $db->prepare("SELECT * FROM les_articles WHERE id = ? ");
$article -> execute(array($id_article )); 
if(isset($_POST["achete"])){
    $quantite_article = htmlspecialchars($_POST["quantite"]);
    $taille_article = htmlspecialchars($_POST["taille"]);
    if(!empty($_POST ["quantite"]) AND isset($_POST ["quantite"])){
        if(is_numeric($quantite_article)){
            if(!empty($_POST ["taille"]) AND isset($_POST ["taille"])){
                header ('Location: payement.php?id_article='.$id_article.'&id_boutique='.$id_boutique.'&quantite_article='.$quantite_article.'&taille_article='.$taille_article);
            }else{
                $taile = '...';
                header ('Location: payement.php?id_article='.$id_article.'&id_boutique='.$id_boutique.'&quantite_article='.$quantite_article.'&taille_article='.$taile);
            }
        }else{
            $erreur = 'Veuille entre un chiffre! ';
        }
    }else{
        $erreur = 'Veuille Presise la quantite a achete! ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="liste_article_user.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
 <?php
 if($article->rowCount() > 0 ){
    while ($result = $article->fetch(PDO::FETCH_ASSOC) ){
        ?>
        <section class="boc_articl_commende">
            <img class="img_article" src="../../src/boutique/article/img_les_articles/<?php echo $result["img_articles"]?>" alt="">
            <section class="info_article_commande">
                <section class="texte_article colome">
                <h1 class="texte_moien_titre texte_limite "><?php echo $result["nom_articles"]?></h1>
                <h1 class="texte_moien_titre texte_plus"><?php echo $result["prix_articles"]?> FCFA</h1>
                <h3>Description</h3>
                <h1 class="description_articles description_plus"><?php echo $result["descriptions_articles"]?></h1>
                </section>
                <form  class="section_form" method="POST" enctype="multipart/form-data">
                    <p>Quantite </p>
                <input class="form_input input_plus" type="text" placeholder="Quantite" name ="quantite" value="1">
                <p>Presise la taille si nécessaire</p>
                <input class="form_input input_plus" type="text" placeholder="Taille" name ="taille">
                <input class="form_input_botone" type="submit" value="Suivant" name ="achete">
                </form>
                <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>
                        <?php
                    }
                    ?>
                </section> 
            </section>
        <?php
    }
 }
 ?>
</body>
</html>