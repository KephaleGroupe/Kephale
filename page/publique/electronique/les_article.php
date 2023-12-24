<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";

$id_produit = $_GET["id_produit"];
$id_article = $_GET["id_article"];


$rec_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
$rec_user-> execute(array($_SESSION["id"]));
$result_rec_user = $rec_user->fetch(PDO::FETCH_ASSOC);

$req_id_les_article = $db->prepare("SELECT * FROM les_articles WHERE id_article = ? " );
$req_id_les_article-> execute(array($id_article));
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
        <a href="article_boutique.php?id_produit=<?php echo  $id_produit?>">
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
    <?php
    if($req_id_les_article->rowCount() > 0 ){
        while ($result = $req_id_les_article->fetch() ){
            $result["id"] ;
            echo ''
            ?>
<section class="bloc_les_article">
        <img class="img_les_article" src="../../user/src/boutique/article/img_les_articles/<?php echo $result["img_articles"]?>" alt="">
        <section class="bloc_info_art">
            <h1 class="nom_articles"><?php echo $result["nom_articles"]?></h1>
            <h1 class="prix_articles"><?php echo $result["prix_articles"]?> FCFA</h1>
            <h1 class="description_articles"><?php echo $result["descriptions_articles"]?></h1>
            <section class="bouton_passe_commande">
            <?php 
             if(isset($_SESSION["id"])){
                $Id_article_id_user = $_SESSION["id"].$result["id"];
                $req_article_commande = $db->prepare("SELECT * FROM article_commande WHERE Id_article_id_user = ? " );
                $req_article_commande-> execute(array($Id_article_id_user));    
                if($req_article_commande->rowCount() > 0 ){
                    $req_article_valide = $db->prepare("SELECT * FROM article_valide WHERE id_article = ? " );
                    $req_article_valide-> execute(array($result["id"]));    
                    if($req_article_valide->rowCount() > 0 ){
                        ?>
                        <a class="article_valide" href="">Article valide</a>
                        <?php 
                    }else{
                        ?>
                        <a class="ajaxLink rouge" data-articleid="<?php echo $result["id"]?>" href="">Annuler la commande</a>
                        <?php 
                    }
                }else{
                    ?>
                    <a class="ajaxLink" data-articleid="<?php echo $result["id"]?>" href="">Passer la commande</a>
                    <?php 
                }
             }else{
                ?>
                    <a class="article_valide rouge" data-articleid="<?php echo $result["id"]?>" href="../../conct_inscrt/connexion.php">Veuillez vous connecter</a>
                    <?php 
             }
            ?>
                
            </section>
            </section>
        </section>
    </section>
           <?php
        }
    }
    
    ?>    
 
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Écoutez les clics sur les liens
    const liens = document.querySelectorAll(".ajaxLink");
    liens.forEach(function (lien) {
        lien.addEventListener("click", function (event) {
            event.preventDefault();
            const articleId = this.getAttribute("data-articleid");
            effectuerRequeteAjax(articleId, this);
        });
    });
});

function effectuerRequeteAjax(articleId, lien) {
    // Utilisez XMLHttpRequest ou fetch pour effectuer votre requête Ajax ici
    // Par exemple, avec fetch :
    fetch("fonction.php?articleId=" + articleId)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            // Modifiez le background-color et le texte du lien
            lien.style.backgroundColor = data.backgroundColor;
            lien.textContent = data.nouveauTexte;
        })
        .catch(function (error) {
            console.error("Erreur Ajax : " + error);
        });
}

</script>