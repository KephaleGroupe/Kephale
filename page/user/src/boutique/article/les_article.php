<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";
    $id_produit = $_GET["id_produit"];
    $id_article = $_GET["id_article"];

    $rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
    $rec_boutique-> execute(array($_SESSION["id"]));
    $result_rec_boutique = $rec_boutique->fetch();
    $result_rec_boutique["id"];

    $rec_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
    $rec_user -> execute(array($_SESSION["id"])); 
    $result_rec_user = $rec_user->fetch();

    $rec_les_article = $db->prepare("SELECT * FROM articles WHERE id = ? ");
    $rec_les_article -> execute(array($id_article)); 
    $result_rec_les_article = $rec_les_article->fetch();

    $req_article = $db->prepare("SELECT * FROM les_articles WHERE id_article = ? ORDER BY id DESC " );
    $req_article-> execute(array($id_article));
    $resulte_req_les_article = $req_article->rowCount();

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
<section class="nav_bare transparant" >
        <a href="article.php?id_produit=<?php echo $id_produit;?>">
        <img style="margin-left: 12px; width: 30px; height: 30px;" class="icon_user" src="../../../../../media/icone/retoure.svg" alt="">
        </a>
        <h1 class="texte_nom_user"><?php echo $result_rec_les_article["nom_article"]?></h1>
        <a class="bloc_lien_user" href="../../../user.php">
        <img class="img_user" src="../../../../../page/conct_inscrt/img_profile_user/<?php echo $result_rec_user["img_profile"]?> " alt="">
        </a>
    </section>
    <div style="margin-top: 70px;"></div>

    <section class="section_grand_bloc">
        <section class="section_element">
        <section class="section_universel_deux">
            <section class="section_bloc_lu">
                <a href="ajoute_les_article.php?id_produit=<?php echo $id_produit ?>&id_article=<?php echo  $id_article?>">
                <h1>Ajoute vos article</h1>
                </a>
            </section>
            <?php 
             if($resulte_req_les_article > 0 ){
                while($result = $req_article->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <section class="section_bloc_produit">
                <img class="img_produit" src="img_les_articles/<?php echo $result ["img_articles"]  ?>" alt="">
                <section class="texte_produt">
                    <h1 class="texte_titre_produit"><?php echo $result ["nom_articles"]  ?></h1>
                    <h1 class="texte_titre_prix"><?php echo $result ["prix_articles"]  ?> FCFA</h1>
                    <h1 class="texte_titre_desc"><?php echo $result ["descriptions_articles"]  ?></h1>
                </section>
                <a href="">
                <img class="icon_menu doc" src="../../../../../media/icone/document.svg" alt="">
                </a>
                <a class="sup_lien" href="supresion/suprime_les_article.php?id_les_article=<?php echo $result ["id"]  ?>&id_produit=<?php echo $id_produit ?>&id_article=<?php echo $id_article ?>">
                <img class="icon_menu suprime" src="../../../../../media/icone/suprime.svg" alt="">
                </a>
            </section>
                    <?php 
                }
             }
            ?>
        </section>
        </section>

    </section>

















    
</body>
</html>