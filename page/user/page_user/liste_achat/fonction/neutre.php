<?php
// Prosedure de renbourcement 
                // Selection de la boutique
                $boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
                $boutique -> execute(array($id_boutique)); 
                $result_boutique = $boutique->fetch();
                // Solde de la Boutique
                $solde_boutique = $result_boutique["solde_boutique"];
                // Traitement de recuperation du montant a renbource.
                $montant = $montant_paye;
                $pourcentage = 5;
                $resultat = ($pourcentage / 100) * $montant;
                $montant =   $montant_paye - $resultat ;

                $solde_boutique_reste = $solde_boutique - $montant; 
                $inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
                $inser_solde_boutique -> execute(array($solde_boutique_reste, $id_boutique));

                $id_kephale = '1';
                $kephale_solde = $db->prepare ("SELECT * FROM kephale_solde WHERE id = ? ");
                $kephale_solde -> execute([$id_kephale]); 
                $result_kephale_solde = $kephale_solde->fetch(); 
                $solde_kephale =  $result_kephale_solde['solde'];
                $solde_kephale_final = $solde_kephale - $resultat;

                $inser_solde_kephale = $db->prepare("UPDATE kephale_solde SET solde = ? WHERE id = ? ");
                $inser_solde_kephale -> execute(array($solde_kephale_final, $id_kephale));

                // Traitement du montant a renbource
                // Selection de l'utilisateur
                $user = $db->prepare("SELECT * FROM user WHERE id = ? ");
                $user -> execute(array($id_user)); 
                $result_user = $user->fetch();
                // Solde de l'utilisateur
                $sole_user = $result_user["solde"];
                // Solde de l'utilisateur finale
                $sole_user_finale = $sole_user + $montant_paye ;
                // Enregistre solde de l'utilisateur finale
                $inser_solde_user = $db->prepare("UPDATE user SET solde = ? WHERE id = ? ");
                $inser_solde_user -> execute(array($sole_user_finale, $id_user));
                // Enregistre des infot de d'annullation de l'achat de l'article
                $achat_annule = $db->prepare("INSERT INTO achat_annulle (id_user, id_boutique, id_article, montant_renbourse ) VALUES (?,?,?,?)");
                $achat_annule -> execute(array($_SESSION["id"], $id_boutique, $id_article, $montant_paye));
                // Supression de l'achat dans la liste des achate 
                $surprime_lachat = $db->prepare("DELETE FROM liste_achat WHERE id = ?" );
                $surprime_lachat-> execute(array($id));

                 // traitement recharge
            $type_transaction = 'Deduction sur renbourcement';
            $montant_transacte = $resultat;
            $id_beneficier = $result_user["id"];
            $beneficier = $result_user["nom"];
            $id_deduit = '1';
            $deduit ='Kephale';
            $date_transaction = time();
            $transactions = $db->prepare("INSERT INTO transaction_kephale (type_transactions, id_beneficier, beneficier, id_deduit, deduit, montant_transaction, date_transaction ) VALUES (?,?,?,?,?,?,?)");
            $transactions -> execute(array($type_transaction, $id_beneficier, $beneficier, $id_deduit, $deduit, $montant_transacte, $date_transaction));
            






            

            <?php
            if( $eta_livraison == 'nom'){
                ?>
                <p style="font-size: 12px;" id="resultat"></p>
                <section class="botone_cfrm_sprm">
                    
                <button id="monBouton" style="border: none;" class=" bonton_article" data-articleid="<?php echo $result_liste["temp_livraison"]?>">Confirme la livraison</button>
                </section>
                <?php
        
           }else{

            $liste_achate = $db->prepare("SELECT * FROM temp_annule WHERE temp_article = ?");
            $liste_achate -> execute(array($result_liste["temp_livraison"])); 
            $result_liste_achate = $liste_achate->fetch();
            $etat = $result_liste_achate["etat"];
            $temp_restant = $result_liste_achate["temp_restant"];
            $temps_initial = 10 * 60; // 10 minutes en secondes
            $temps_passe = time() - $temp_restant;
            $temps_restant = $temps_initial - $temps_passe;
            $chrono = gmdate("i", $temps_restant);
            // header("refresh:  60"); actualise la page chque minute

            
             $temp_restant = $result_liste_achate["temp_restant"];
             
             

if($temp_restant == 0 ){
?>   
                        <a style=" padding: 6px 10px; margin-bottom: 7px;  color: #E94E1B; border: 1px solid #E94E1B;    border-radius: 7px;" href="">Supprimer</a> 
              <?php
                if( $etat === 'b'){
                    ?>
                    <p style="font-size: 12px; color: #E94E1B;">Annulation de l'achat en coure de traitement... <br><samp style="color: #6d6d6d;">
                Vous alle etre contacte par le service de livraison.</samp></p>
                    <?php

                }else{
                    if( $etat === 'oui'){
                        if( $etat === 'oui'){
                            ?>

                            <p style="font-size: 12px ; ">Votre demande a ete prix en compte 
                            <br> les procedur de renbourcement sont en coure...</p>
                            <?php
                        }else{

                            if( $etat === 'renbource'){
                                ?>
                                <p style="font-size: 12px ; color: rgb(160, 160, 160); ">Vous ave ete rembourse</p>
                                <?php
                            }
                        }
                       

                    }else{
                        if( $etat === 'nom'){
                            ?>
                            <p style="font-size: 12px ; ">Votre demande na pas ete prix en compte</p>
                            <?php
    
                        }else{
                            if( $etat === 'renbource'){
                                ?>
                                <p style="font-size: 12px ; color: rgb(160, 160, 160); ">Vous ave ete rembourse</p>
                                <?php
                            }else{
                                ?>
                                <p style="font-size: 12px; color: rgb(160, 160, 160); ">Nous vous remercion pour votre comfience.</p>
                                <?php
                            }
                        }
                    }
                }
            }else{
                if($chrono > 0){
                    if( $etat === 'a'){
                        
                        if( $eta_livraison == 'oui'){
                            ?>
                            <p style="font-size: 12px;">Vous dispose de <?php echo $chrono?> minute pour annule votre achate si il y a un probleme avec l'article.</p>
                        <section class="botone_cfrm_sprm">
                        <button id="annule" data-articl="<?php echo $result_liste["temp_livraison"]?>" style="border: none; background-color: #E94E1B;" class="bonton_article"  >Annule l'achat</button>
                        </section>
                       
                            <?php
            
                        }
                    }else{
                        if( $etat === 'b'){
                            ?>
                            <p style="font-size: 12px;">Votre demande d'annulation de l'achat est en coure de traitement...</p>
                            <?php

                        }else{
                            if( $etat === 'oui'){
                                ?>
                                <p style="font-size: 12px ; ">Votre demande a ete prix en compte</p>
                                <?php
                            }else{
                                if( $etat === 'nom'){
                                    ?>
                                    <p style="font-size: 12px ; ">Votre demande na pas ete prix en compte</p>
                                    <?php
                                }
                            }
                        }
                    }
                }else{
                $temp = '0';
                $temp_epuise = $db->prepare("UPDATE temp_annule SET temp_restant = ? WHERE temp_article = ? ");
                $temp_epuise -> execute(array( $temp, $result_liste["temp_livraison"] ));
                if ($temp_epuise->execute()){
                    ?>
                    <p style="font-size: 12px; color: rgb(160, 160, 160); ">Nous vous remercion pour votre comfience.</p>
                    <?php
                }
                }

            }
         }
         ?>