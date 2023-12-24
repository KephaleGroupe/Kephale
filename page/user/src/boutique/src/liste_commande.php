<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";
$_GET["id_boutique"];
$eta_commande = 'nulle';
$liste_commende = $db->prepare("SELECT * FROM article_commande WHERE id_boutique = ?  ORDER BY eta_commande DESC ");
$liste_commende -> execute(array($_GET["id_boutique"] )); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../../css/css/style.css">
    <title>kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="../grand.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
<?php
if($liste_commende->rowCount() > 0 ){
    while ($result = $liste_commende->fetch() ){
        $select_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
        $select_user -> execute(array( $result["id_user"])); 
        $result_user= $select_user->fetch(PDO::FETCH_ASSOC);
        $result_user["nom"];
        $eta_commande = 'nulle';
        ?>
        <section class="boc_articl_commende">
            <img class="img_article" src="../article/img_les_articles/<?php echo $result["img_article"]?>" alt="">
            <section class="info_article_commande">
                <section class="texte_article">
                <h1 class="texte_moien_titre texte_limite "><?php echo $result["nom_aricle"]?></h1>
                <h1 class="texte_moien_titre texte_plus"><?php echo $result["prix_article"]?> FCFA</h1>
                </section>
                <h1 class="texte_article">L'article a été commandé par</h1>
                <section class="info_user"> 
                <img class="img_user" src="../../../../conct_inscrt/img_profile_user/<?php echo $result_user["img_profile"]?>" alt="">
                <h1 class="texte_limite"><?php echo $result_user["nom"]?></h1>
                </section>
                <?php
                if($result['eta_commande'] == $eta_commande ){
                    ?>
                    <section class="botone_cfrm_sprm">
                    <a class="confirme" data-articleid = '<?php echo $result["id_article"]?>' href="">Confirme</a>
                    </section>
                     <?php
                }else{
                    $commande_confirme = 'confirme';
                    if($result['eta_commande'] == $commande_confirme ){
                        ?>
                        <section class="botone_cfrm_sprm">
                        <a class="confirme alert_botone" data-articleid = '<?php echo $result["id_article"]?>' href="">Annule</a>
                        </section>
                         <?php
                    }else{
                        $commande_achete = 'achete';
                    if($result['eta_commande'] == $commande_achete ){
                        ?>
                        <section class="botone_cfrm_sprm">
                        <a class="confirme " href="">Article achete</a>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Écoutez les clics sur les liens
    const liens = document.querySelectorAll(".confirme");
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