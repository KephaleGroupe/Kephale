<?php
                if( $eta_livraison == 'nom'){
                    ?>
                    <p style="font-size: 12px;" id="resultat"></p>
                    <section class="botone_cfrm_sprm">
                        
                    <button id="monBouton" style="border: none;" class=" bonton_article" data-articleid="<?php echo $result_liste["temp_livraison"]?>">Confirme la livraison</button>
                    </section>
                    <?php
            
                }else{
                    
                    $liste_achat = $db->prepare("SELECT * FROM temp_annule WHERE temp_article = ?");
                    $liste_achat -> execute(array($result_liste["temp_livraison"])); 
                    $result_liste_achat = $liste_achat->fetch();
                    $etat = $result_liste_achat["etat"];
                    $temp_restant = $result_liste_achat["temp_restant"];
                    if($chrono > 0){
                        if( $etat === 'a'){
                            if( $eta_livraison == 'oui'){
                                $temps_initial = 10 * 60; // 10 minutes en secondes
                    $temps_passe = time() - $temp_restant;
                    $temps_restant = $temps_initial - $temps_passe;
                    $chrono = gmdate("i", $temps_restant);
                    header("refresh:  60");
                                ?>
                                <p style="font-size: 12px;">Vous dispose de <?php echo $chrono?> minute pour annule votre achate si il y a un probleme.</p>
                            <div id="resultat"></div>
                            <section class="botone_cfrm_sprm">
                            <button id="annule" data-articleid="<?php echo gmdate("i:s", $temps_restant);?>" style="border: none; background-color: #E94E1B;" class="bonton_article"  >Annule l'achat</button>
                            </section>
                                <?php
                
                            }
                        }else{
                            if( $etat === 'b'){
                                ?>
                                <p style="font-size: 12px;">Votre demande est en coure de traitement...</p>
                                <?php
    
                            }else{
                                if( $etat === 'oui'){
                                    ?>
                                    <p style="font-size: 12px ; ">Votre demande a ete prix en compte</p>
                                    <?php
                                }
                            }
                        }
                    }else{
                        ?>
                        <p style="font-size: 12px; color: rgb(160, 160, 160); ">Nous vous remercion pour votre comfience.</p>
                        <?php
                    }
                    
                }
                
               
                ?>