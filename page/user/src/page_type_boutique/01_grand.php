
<?php
 $boutique = $_GET["boutique"];
 $grand = 'grand' ;
    $neutre = 'standare' ;
    $electro = 'electro' ;
    $cosmetic = 'cosmetic' ;
    $resto = 'resto' ;
    $voiture = 'voiture';
    $boison = 'boison';
    $immo = 'immo';
    $neutre_standare = 'neutre';
    $neutre_standare = 'neutre_standare' ;
    $neutre_electro = 'neutre_electro' ;
    $neutre_cosmetic = 'neutre_cosmetic' ;
    $neutre_resto = 'neutre_resto' ;
    $neutre_voiture = 'neutre_voiture' ;
    $neutre_boison = 'neutre_boison' ;
    $neutre_immo = 'neutre_immo' ;

    
 if( $boutique == 'grand'){
    $grand = 'grand';
    $offre_kephale = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ?  ");
    $offre_kephale -> execute(array( $grand)); 
    $result_offre_kephale = $offre_kephale->fetch();
    $montant = $result_offre_kephale["montant"];
 }else{
    if( $boutique == 'standare'){
        $grand = 'standare';
        $offre_kephale = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ?  ");
        $offre_kephale -> execute(array( $grand)); 
        $result_offre_kephale = $offre_kephale->fetch();
        $montant = $result_offre_kephale["montant"];

    }else{
        if( $boutique == 'electro'){
            $grand = 'electro';
            $offre_kephale = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ?  ");
            $offre_kephale -> execute(array( $grand)); 
            $result_offre_kephale = $offre_kephale->fetch();
            $montant = $result_offre_kephale["montant"];
    
        }else{
            if( $boutique == 'cosmetic'){
                $grand = 'cosmetic';
                $offre_kephale = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ?  ");
                $offre_kephale -> execute(array( $grand)); 
                $result_offre_kephale = $offre_kephale->fetch();
                $montant = $result_offre_kephale["montant"];
        
            }else{
                if( $boutique == 'resto'){
                    $grand = 'resto';
                    $offre_kephale = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ?  ");
                    $offre_kephale -> execute(array( $grand)); 
                    $result_offre_kephale = $offre_kephale->fetch();
                    $montant = $result_offre_kephale["montant"];
            
                }else{
                    if( $boutique == 'voiture'){
                        $grand = 'voiture';
                        $offre_kephale = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ?  ");
                        $offre_kephale -> execute(array( $grand)); 
                        $result_offre_kephale = $offre_kephale->fetch();
                        $montant = $result_offre_kephale["montant"];
                
                    }else{
                        if( $boutique == 'boison'){
                            $grand = 'boison';
                            $offre_kephale = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ?  ");
                            $offre_kephale -> execute(array( $grand)); 
                            $result_offre_kephale = $offre_kephale->fetch();
                            $montant = $result_offre_kephale["montant"];
                            
                    
                        }else{
                            if( $boutique == 'immo'){
                                $grand = 'immo';
                                $offre_kephale = $db->prepare("SELECT * FROM offre_kephale WHERE type_abon = ?  ");
                                $offre_kephale -> execute(array( $grand)); 
                                $result_offre_kephale = $offre_kephale->fetch();
                                $montant = $result_offre_kephale["montant"];
                        
                            }else{
                                $montant = "0.0";

                            }

                        }

                    }

                }

            }

        }

    }
 }


?>
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
    <input class="form_input" type="text" placeholder="<?php echo $montant ?>F CFA" name ="prix" readonly>
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