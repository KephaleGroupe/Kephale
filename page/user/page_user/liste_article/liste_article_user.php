<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
$eta_commande = 'confirme';
$liste_commende = $db->prepare("SELECT * FROM article_commande WHERE id_user = ? AND eta_commande = ? ORDER BY id DESC  ");
$liste_commende -> execute(array($_SESSION["id"], $eta_commande)); 

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
    <a class="lien_icon" href="../../user.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
 <?php
if($liste_commende->rowCount() > 0 ){
    while ($result = $liste_commende->fetch() ){
        $id_article = $result["id_article"];
        $id_boutique = $result["id_boutique"];

        $rec_article = $db->prepare("SELECT * FROM les_articles WHERE id = ? ");
        $rec_article -> execute(array($id_article)); 
        $result_article= $rec_article->fetch(PDO::FETCH_ASSOC);
        $id_produit = $result_article["id_produit"];
        

        $rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
        $rec_boutique -> execute(array($id_boutique)); 
        $result_boutique = $rec_boutique->fetch(PDO::FETCH_ASSOC);

        $rec_produit = $db->prepare("SELECT * FROM produits WHERE id_boutique = ? ");
        $rec_produit -> execute(array($id_produit)); 
        $result_produit = $rec_produit->fetch(PDO::FETCH_ASSOC);

        $user = $db->prepare("SELECT * FROM user WHERE id = ? ");
        $user -> execute(array($_SESSION["id"])); 
        $result_user = $user->fetch(PDO::FETCH_ASSOC);

        ?>
        <section class="boc_articl_commende">
            <img class="img_article" src="../../src/boutique/article/img_les_articles/<?php echo $result_article["img_articles"]?>" alt="">
            <section class="info_article_commande">
                <section class="texte_article colome">
                <h1 class="texte_moien_titre texte_limite "><?php echo $result_article["nom_articles"]?></h1>
                <h1 class="texte_moien_titre texte_plus"><?php echo $result_article["prix_articles"]?> FCFA</h1>
                <h3>Description</h3>
                <h1 class="description_articles description_plus"><?php echo $result_article["descriptions_articles"]?></h1>
                </section>
                <?php
                if($result_produit["type_produit"] == 'voiture'){
                    ?>
                        <h1 class="texte_article">La voiture est disponible chez</h1>
                        <?php
                }else{
                    if($result_produit["type_produit"] == 'neutre_voiture'){
                        ?>
                        <h1 class="texte_article">La voiture est disponible chez</h1>
                        <?php
                    }else{
                        ?>
                        <h1 class="texte_article">L'article est disponible chez</h1>
                        <?php
                    }
                }
                ?>
                <section class="info_user"> 
                <img class="img_user" src="../../src/img_boutique/<?php echo $result_boutique["img_boutique"]?>" alt="">
                <h1 class="texte_limite"><?php echo $result_boutique["nom_boutique"]?></h1>
                </section>
                <?php
                $voiture_commande = $db->prepare("SELECT * FROM voiture_commande WHERE id_article = ? ");
                $voiture_commande -> execute(array($result_article["id"])); 
                $etat_voiture = $voiture_commande->rowCount() ;
                
                if($etat_voiture > 0){
                    while ($result_voiture_commande = $voiture_commande->fetch() ){
                        $result_voiture_commande["etat"];
                        if($result_voiture_commande["etat"] == 'nom'){
                            ?>
                            <span class="valeur_article" style="font-size: 12px;">Le service vous contactera dans les minutes à venir.</span>
                             <?php
                        }else{
                            ?>
                        <section class="botone_cfrm_sprm">
                        <a class="bonton_article"  href="achete.php?id_article=<?php echo $result_article["id"]?>&id_boutique=<?php echo $result_boutique["id"]?>">Acheter</a>
                        <a class="bonton_article alert_botone"  href="">Supprimer</a>
                        </section>
                        <?php
                        }
                    }
                }else{
                
            if($result_produit["type_produit"] == 'voiture'){
                if(isset($_POST['voire'])){
                    $etat = 'nom';
                    $inser_user = $db->prepare("INSERT INTO voiture_commande (id_user, id_boutique, id_article, etat ) VALUES (?,?,?,?)");
                    $inser_user -> execute(array($_SESSION["id"], $id_boutique, $result_article["id"], $etat ));

                    //header ('Location: connexion.php');
                }
                ?>
                <span class="valeur_article" style="font-size: 12px;">
                    Bonjour <?php echo $result_user["nom"]?> si vous ete pret a achete la voiture vous pouvez click sur 
                    <span style="font-weight: 700;">Voire la voiture</span> 
                    le service client vous concatera pour une visite fisique de la voiture 
                    en suite vous poure procede a l'achat si elle vous convient </span>
                <section class="botone_cfrm_sprm" style="flex-direction: column;">
                <form class="section_form" method="POST" enctype="multipart/form-data">
                <input type="submit" name="voire" value="Voire la voiture" class="bonton_article" style="margin-bottom: 7px; border: none; font-size: 16px;">
                </form>
                <a class="bonton_article alert_botone"  href="">Supprimer</a>
            </section>
                <?php

            }else{
                if($result_produit["type_produit"] == 'neutre_voiture'){
                    if(isset($_POST['voire'])){
                        $etat = 'nom';
                        $inser_user = $db->prepare("INSERT INTO voiture_commande (id_user, id_boutique, id_article, etat ) VALUES (?,?,?,?)");
                        $inser_user -> execute(array($_SESSION["id"], $id_boutique, $result_article["id"], $etat ));
    
                        //header ('Location: connexion.php');
                    }
                    ?>
                    <span class="valeur_article" style="font-size: 12px;">
                        Bonjour <?php echo $result_user["nom"]?> si vous ete pret a achete la voiture vous pouvez click sur 
                        <span style="font-weight: 700;">Voire la voiture</span> 
                        le service client vous concatera pour une visite fisique de la voiture 
                        en suite vous poure procede a l'achat si elle vous convient </span>
                    <section class="botone_cfrm_sprm" style="flex-direction: column;">
                    <form class="section_form" method="POST" enctype="multipart/form-data">
                    <input type="submit" name="voire" value="Voire la voiture" class="bonton_article" style="margin-bottom: 7px; border: none; font-size: 16px;">
                    </form>
                    <a class="bonton_article alert_botone"  href="">Supprimer</a>
                </section>
                    <?php

                }else{
                    ?>
                    <section class="botone_cfrm_sprm">
                    <a class="bonton_article"  href="achete.php?id_article=<?php echo $result_article["id"]?>&id_boutique=<?php echo $result_boutique["id"]?>">Acheter</a>
                    <a class="bonton_article alert_botone"  href="">Supprimer</a>
                    </section>
                    <?php
                }
            }

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