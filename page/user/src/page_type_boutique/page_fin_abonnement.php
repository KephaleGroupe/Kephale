
                       
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="../user.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
    <section class="section_input">
        <h1 style="text-align: center; color: #E94E1B;" >Votre abonnement <br> est epuise !</h1>
    <h1 class="texte_moien_titre">Entre Votre mot de passe<br> pour vous reabonne</h1>
    <h1 class="texte_moien_titre">Montant à payer</h1>
    <form  class="section_form" method="POST" enctype="multipart/form-data">
    <input class="form_input" type="text" placeholder="<?php echo $result_req_offre["montant"] ?> FCFA" name ="prix" readonly>
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
                    <h1 class="texte_petit_titre">Change<a style="color: #95C11F;" href="abonnement.php"> d'abonnement</a></h1>
    </section>