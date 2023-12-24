<?php
    $grand = 'grand';
    $standare = 'standare';
    $electro = 'electro';
    $cosmetic = 'cosmetic';
    $resto = 'resto';
    $voiture = 'voiture';
    $boison = 'boison';
    $immo = 'immo';

    $neutre = 'neutre';
    $neutre_restaut = 'neutre_restaut';
    $neutre_voiture = 'neutre_voiture';


    
    if($result_rec_boutique["type_abonnement"] === $grand){
        $abonnement = "nulle_abon";
        if($result_rec_boutique["tempt_abonnement_boutique"] === $abonnement ){
            header ('Location:../paiement.php');
        }
        $remaining_time = $result_rec_user["temp_abonement"] - time();
        if ($remaining_time > 0) {
            $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
            if($remaining_days === 0){
                $abonnement = "nulle_abon";
                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));

                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));

                header ('Location: ../paiement.php');

                
            }
        } else{
            $abonnement = "nulle_abon";
            $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
            $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                        
            $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
            $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                        
                                        header ('Location: ../paiement.php');
        }
    }else{
       if ($result_rec_boutique["type_abonnement"] === $standare){
        $abonnement = "nulle_abon";
        if($result_rec_boutique["tempt_abonnement_boutique"] === $abonnement ){
            header ('Location:../paiement.php');
        }
        $remaining_time = $result_rec_user["temp_abonement"] - time();
        if ($remaining_time > 0) {
            $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
            if($remaining_days === 0){
                $abonnement = "nulle_abon";
                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));

                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));

                header ('Location: ../paiement.php');

                
            }
        } else{
            $abonnement = "nulle_abon";
                                        $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                        $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                        
                                        $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                        $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                        
                                        header ('Location: ../paiement.php');
        }
            
        }else{
            if ($result_rec_boutique["type_abonnement"] === $electro){
                $abonnement = "nulle_abon";
                if($result_rec_boutique["tempt_abonnement_boutique"] === $abonnement ){
                    header ('Location:../paiement.php');
                }
                $remaining_time = $result_rec_user["temp_abonement"] - time();
                if ($remaining_time > 0) {
                    $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                    if($remaining_days === 0){
                        $abonnement = "nulle_abon";
                        $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                        $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
        
                        $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                        $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
        
                        header ('Location: ../paiement.php');
        
                        
                    }
                } else{
                    $abonnement = "nulle_abon";
                                        $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                        $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                        
                                        $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                        $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                        
                                        header ('Location: ../paiement.php');
                }
                    
                }else{
                    if ($result_rec_boutique["type_abonnement"] === $cosmetic){
                        $abonnement = "nulle_abon";
                        if($result_rec_boutique["tempt_abonnement_boutique"] === $abonnement ){
                            header ('Location:../paiement.php');
                        }
                        $remaining_time = $result_rec_user["temp_abonement"] - time();
                        if ($remaining_time > 0) {
                            $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                            if($remaining_days === 0){
                                $abonnement = "nulle_abon";
                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                
                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                
                                header ('Location: ../paiement.php');
                
                                
                            }
                        } else{
                            $abonnement = "nulle_abon";
                                        $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                        $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                        
                                        $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                        $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                        
                                        header ('Location: ../paiement.php');
                        }
                            
                        }else{
                            if ($result_rec_boutique["type_abonnement"] === $resto){
                                $abonnement = "nulle_abon";
                                if($result_rec_boutique["tempt_abonnement_boutique"] === $abonnement ){
                                    header ('Location:../paiement.php');
                                }
                                $remaining_time = $result_rec_user["temp_abonement"] - time();
                                if ($remaining_time > 0) {
                                    $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                                    if($remaining_days === 0){
                                        $abonnement = "nulle_abon";
                                        $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                        $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                        
                                        $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                        $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                        
                                        header ('Location: ../paiement.php');
                        
                                        
                                    }
                                } else{
                                    $abonnement = "nulle_abon";
                                        $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                        $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                        
                                        $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                        $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                        
                                        header ('Location: ../paiement.php');
                                }
                                    
                                }else{
                                    if ($result_rec_boutique["type_abonnement"] === $voiture){
                                        $abonnement = "nulle_abon";
                                        if($result_rec_boutique["tempt_abonnement_boutique"] === $abonnement ){
                                            header ('Location:../paiement.php');
                                        }else{
                                            $remaining_time = $result_rec_user["temp_abonement"] - time();
                                        if ($remaining_time > 0) {
                                            $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                                            if($remaining_days === 0){
                                                $abonnement = "nulle_abon";
                                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                                
                                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                                
                                                header ('Location: ../paiement.php');
                                
                                                
                                            }
                                        } else{
                                            
                                                $abonnement = "nulle_abon";
                                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                                
                                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                                
                                                header ('Location:../paiement.php');
                                            
                                        }
                                        }
                                        
                                            
                                        }else{
                                            if ($result_rec_boutique["type_abonnement"] === $boison){
                                                $abonnement = "nulle_abon";
                                                if($result_rec_boutique["tempt_abonnement_boutique"] === $abonnement ){
                                                    header ('Location:../paiement.php');
                                                }else{
                                                    $remaining_time = $result_rec_user["temp_abonement"] - time();
                                                if ($remaining_time > 0) {
                                                    $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                                                    if($remaining_days === 0){
                                                        $abonnement = "nulle_abon";
                                                        $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                                        $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                                        
                                                        $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                                        $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                                        
                                                        header ('Location: ../paiement.php');
                                        
                                                        
                                                    }else{
                                                       
                                                            $abonnement = "nulle_abon";
                                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                                
                                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                                
                                                            header ('Location:../paiement.php');
                                                        
                                                    }
                                                } 
                                                }
                                                
                                                    
                                                }else{
                                                    if ($result_rec_boutique["type_abonnement"] === $immo){
                                                        $abonnement = "nulle_abon";
                                                        if($result_rec_boutique["tempt_abonnement_boutique"] === $abonnement ){
                                                            header ('Location:../paiement.php');
                                                        }else{
                                                            $remaining_time = $result_rec_user["temp_abonement"] - time();
                                                        if ($remaining_time > 0 ) {
                                                            $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                                                            if($remaining_days === 0){
                                                                $abonnement = "nulle_abon";
                                                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                                                
                                                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                                                
                                                                header ('Location: ../paiement.php');
                                                
                                                                
                                                            }
                                                        } else{
                                                            
                                                                $abonnement = "nulle_abon";
                                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                                
                                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                                
                                                                header ('Location:../paiement.php');
                                                            
                                                        }
                                                        }
    
                                                            
                                                        }

                                                }

                                        }

                                }

                        }

                }

        }
    }
   
   