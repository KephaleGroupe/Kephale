<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";
$recherche = $db->query("SELECT * FROM produits WHERE type_produit LIKE 'boissons' ORDER BY id DESC " );
$recherche = $db->query("SELECT * FROM produits INNER JOIN boutique ON produits.id_boutique = boutique.id WHERE produits.type_produit LIKE 'boissons' ORDER BY produits.id DESC " );
$homme = 'boissons';
$recherche = $db->prepare("SELECT * FROM produits WHERE type_produit = ? ORDER BY id DESC " );
$recherche-> execute(array($homme));
if(isset($_GET["recherche"]) AND !empty($_GET["recherche"])){
    $rech = htmlspecialchars($_GET["recherche"]);
    $recherche = $db->query("SELECT * FROM boutique INNER JOIN  produits ON produits.id_boutique = boutique.id WHERE produits.type_produit LIKE 'boissons' and boutique.nom_boutique LIKE  '%$rech%'   ORDER BY produits.id DESC " );
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
    <section class="barre_de_recherche">
        <a href="../../../index.php">
        <img class="icon_retoure" src="../../../media/icone/retoure.svg" alt="">
        </a>
    <form class="recherche_forme" method="$_GET" >
            <input class="recherch" type="searche" name="recherche" placeholder="Recherche...">
            <button class="boton"><img class="icon_recherche" src="../../../media/icone/envoye.svg" alt=""></button>
    </form>
    </section>
    
    <section class="info_article">
        <img src="photos-07.png" alt="">
        <h1>KEPHALÉ VOUS OFFRE LES MEILLIEUR <br> BOISSONS DU MALI </h1>
    </section>

    <section class="bloc_boutique">
    <?php
    if($recherche->rowCount() > 0 ){
        while ($result = $recherche->fetch() ){
            $req_id_boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? " );
            $req_id_boutique-> execute(array($result ["id_boutique"] ));
            $req_id_boutique_result = $req_id_boutique->fetch();


            ?>
            <section class="bloc_boutique_info">
            <section class="info_boutique">
                    <img class="img_boutique" src="../../user/src/img_boutique/<?php echo $req_id_boutique_result["img_boutique"]?>" alt="">
                    <h1 class="nom_boutique"><?php echo $req_id_boutique_result["nom_boutique"]?></h1>
                </section>
            <img class="img_produit" src="../../user/src/boutique/article/img_produit/<?php echo $result["img_produit"]?>" alt="">
            <section class="infon_boutique_produi">
                <h1 class="nom_produit"><?php echo $result["nom_produit"]?></h1>
            </section>
            <?php
             $req_id_produit = $db->prepare("SELECT * FROM produits WHERE id_boutique = ? " );
             $req_id_produit-> execute(array($result ["id"] ));
             $req_id_produit_result = $req_id_produit->fetch();
            ?>
                <a class="bouton_lien" href="article_boutique.php?id_produit=<?php echo $result["id"]?>">Parcourir</a>
            </section>
            <?php 
        }
    }else{
        ?>
        <h4 style="text-align: center;  margin-top: 20px;">Pas de reponses pour <span style="color: red;" ><?php echo $rech ?></span> </h4>
        <?php
    }
     ?>
    </section>
</body>
</html>