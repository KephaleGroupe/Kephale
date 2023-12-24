<?php 
$pourcentage = 5;
$resultat = ($pourcentage / 100) * $montant_paye;
$montant = $resultat + $montant_paye;
$pourcentage_1 = 40;
$resulta_40 = ($pourcentage_1 / 100) * $montant;

$pourcentage_2 = 30;
$resulta_30 = ($pourcentage_2 / 100) * $montant;

include_once "fonction/trois_mois.php";

?>
<style>
.info_paye{
    width: 300px;
    text-align: left;
}
.info_paye .info_result {
    color: #757575;
    font-size: 13px;
}
.info_totale{
    font-size: 13px;
}
</style>
<section class="boc_articl_commende" >
    <section class="info_article_commande" style="margin-bottom: 5px;"> 
    <span  class="valeur_article" style="margin-top: 10px; margin-bottom: 10px; font-size: 12px; color: #757575;" > 
    <span class="valeur_article" style="font-weight: 700; font-size: 20px;">Payement  /  3 mois</span><br>
    Sur une dure de 3 mois vous paye <span style="font-weight: 700;">5%</span> de l'article achete.
    Pour active l'offre vous paye 40% du montant de l'article plus les 5% et 30% chaque mois pandent 2 mois.
    Nous payons la totalite du de l'article chez le fourniseur a votre place c'est a dire l'article vous serait livre lore du payement du Première mois.</span>
    <section class="info_paye">
        <span class="info_totale">5% de <?php echo $montant_paye ?>F CFA =</span> <span class="info_result"><?php echo $resultat?>F CFA</span><br>
        <span class="info_totale">Première mois 40%  =</span> <span class="info_result"><?php echo $resulta_40?>F CFA</span><br>
        <span class="info_totale">Deuxième mois 30%  =</span> <span class="info_result"><?php echo $resulta_30?>F CFA</span><br>
        <span class="info_totale">Troisième mois 30%  =</span> <span class="info_result"><?php echo $resulta_30?>F CFA</span><br>
        <span class="info_totale">Montant totale sur 3 mois =</span> <span class="info_result"><?php echo $montant?>F CFA</span><br>
    </section>
    <span class="valeur_article" style="font-weight: 700; font-size: 17px; color: #757575; margin-top: 10px;">Montant à payer maintenant</span>
    <span class="valeur_article" style="font-weight: 700; font-size: 15px; color: #757575; margin-top: 3px;"><?php echo $resulta_40?>F CFA</span>
    <form  class="section_form" method="POST" enctype="multipart/form-data">
                <p class="texte_pli">Entre votre mot de passe pour confirme l'achat.</p>
                <input class="form_input input_plus" type="password" placeholder="Mot de passer" name ="password_user_un">
                <input class="form_input_botone" type="submit" value="Confirme l'achat" name ="payement_trois_mois">
                <?php
                    if(isset ($erreure)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreure ?></h1>
                        <?php
                    }
                    ?>
                </form>
    </section>
    </section>