<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";

$id_produit = $_GET["id_produit"];



$req_id_article = $db->prepare("SELECT * FROM articles WHERE id_produit = ? " );
$req_id_article-> execute(array($id_produit));

$rec_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
$rec_user-> execute(array($_SESSION["id"]));
$result_rec_user = $rec_user->fetch(PDO::FETCH_ASSOC);
    
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
<section class="nav_bare transparant" >
        <a href="boutique.php">
        <img style="margin-left: 12px; width: 30px; height: 30px;" class="icon_user" src="../../../media/icone/retoure.svg" alt="">
        </a>
        <?php
        if(isset($_SESSION["id"]) AND !empty($_SESSION["id"])){
            ?>
            <a class="bloc_lien_user" href="../../user/user.php">
        <img class="img_user" src="../../conct_inscrt/img_profile_user/<?php echo $result_rec_user["img_profile"]?> " alt="">
        </a>
            <?php
        }
        
         
        ?>
    </section>
    <div style="margin-top: 80px;"></div>

<section>
<?php
if($req_id_article->rowCount() > 0 ){
    while ($result = $req_id_article->fetch() ){
        ?>
            <section class="section_bloc_produit">
                <img class="img_produit" src="../../user/src/boutique/article/img_article/<?php echo $result ["img_article"]  ?>" alt="">
                <section class="texte_produt">
                    <div style="margin-top: 17px;"></div>
                    <h1 class="texte_titre_produit"><?php echo $result ["nom_article"]  ?></h1>
                </section>
                <a href="les_article.php?id_article=<?php echo $result ["id"]?>&id_produit=<?php echo $id_produit?>">
                <img class="icon_menu doc" src="../../../media/icone/envoye.svg" alt="">
                </a>
            </section>
        <?php
    }
}


?>
    </section>
</body>
</html>