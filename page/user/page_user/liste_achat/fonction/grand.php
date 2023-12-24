<?php
// Prosedure de renbourcement 
                // Selection de la boutique
                $boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
                $boutique -> execute(array($id_boutique)); 
                $result_boutique = $boutique->fetch();
                // Solde de la Boutique
                $solde_boutique = $result_boutique["solde_boutique"];
                // Traitement de recuperation du montant a renbource.
                if($solde_boutique > $montant_paye ){
                    
                $solde_boutique_reste = $solde_boutique - $montant_paye ; 
                $inser_solde_boutique = $db->prepare("UPDATE boutique SET solde_boutique = ? WHERE id = ? ");
                $inser_solde_boutique -> execute(array($solde_boutique_reste, $id_boutique));
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
                }else{

                }
                