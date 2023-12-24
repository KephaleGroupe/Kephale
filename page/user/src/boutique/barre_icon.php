<?php 
$eta_commande = 'nulle';

$liste_commende = $db->prepare("SELECT * FROM article_commande WHERE id_boutique = ? AND eta_commande = ? ");
$liste_commende -> execute(array($result_rec_boutique["id"], $eta_commande )); 

?>

<section class="section_menu_icon">
        <a class="lien_icon" href="">
            <img class="icon_menu" src="../../../../media/icone/parametre.svg" alt="">
        </a>

        <a class="lien_icon" href="">
            <img class="icon_menu" src="../../../../media/icone/message.svg" alt="">
            <section class="alerte_conteur">
                <p class="conteur">0</p>
            </section>
        </a>

        <a class="lien_icon" href="src/liste_commande.php?id_boutique=<?php echo $result_rec_boutique["id"]; ?>">
            <img class="icon_menu" src="../../../../media/icone/notification.svg" alt="">
            <?php 
            if($liste_commende->rowCount() > 0 ){
                ?>
                <section class="alerte_conteur">
                <p class="conteur"><?php echo $liste_commende->rowCount(); ?></p>
            </section>
                <?php 
            }
            ?>
            
        </a>

        <a class="lien_icon" href="src/aaa.php">
            <img class="icon_menu" src="../../../../media/icone/panye.svg" alt="">
            <?php 
            $liste_achate = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND livre LIKE 'non' ");
            $liste_achate -> execute(array($_SESSION["id_boutique"])); 
            if($liste_achate->rowCount() > 0 ){
                ?>
                <section class="alerte_conteur">
                <p class="conteur"><?php echo $liste_achate->rowCount(); ?></p>
            </section>
                <?php 
            }
            ?>
        </a>
    </section>