<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="abonnement.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
    <section class="section_input">
    <h1 class="texte_petit_titre">Entre Votre mot de passe<br> pour confirme l'achat</h1>
    <h1 class="texte_moien_titre">Montant à payer</h1>
    <form  class="section_form" method="POST" enctype="multipart/form-data">
    <input class="form_input" type="text" placeholder="35.000 FCFA" name ="prix" readonly>
    <input class="form_input" type="password" placeholder="Mot de passe" name ="passwor_usre">
    <input class="form_input_botone" type="submit" value="Confirme l'achat" name ="achete">
    </form>
    <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>
                        <?php
                    }
                    ?>
    </section>