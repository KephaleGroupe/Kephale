<?php 
$grand = 'grand' ;
$neutre = 'standare' ;
$electro = 'electro' ;
$cosmetic = 'cosmetic' ;
$resto = 'resto' ;
$voiture = 'voiture';
$boison = 'boison';
$immo = 'immo';

        
        if($result_rec_boutique["type_abonnement"] == "grand"){
                if($result_rec_user["temp_abonement"] > time()){
                        $remaining_time = $result_rec_user["temp_abonement"] - time();
                        $remaining_days = floor($remaining_time / ( 24 * 60 * 60));

                }else{
                        $abonnement = "nulle_abon";
                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));

                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));

                header ('Location: ../paiement.php');
                }
               
                    ?>
            <section  class="section_solde">
            <h1 class="solde_user"><?php echo $remaining_days;?></h1>
            <h1 class="solde">jours restants.</h1>
            </section>
                     <?php 
             }else{
                if($result_rec_boutique["type_abonnement"] == "standare"){
                        if($result_rec_user["temp_abonement"] > time()){

                $remaining_time = $result_rec_user["temp_abonement"] - time();
                $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                        }else{
                                $abonnement = "nulle_abon";
                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                
                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                
                                header ('Location: ../paiement.php');
                        }
               
                    ?>
            <section  class="section_solde">
            <h1 class="solde_user"><?php echo $remaining_days;?></h1>
            <h1 class="solde">jours restants.</h1>
            </section>
                     <?php 
             }else{
                if($result_rec_boutique["type_abonnement"] == "electro"){
                        if($result_rec_user["temp_abonement"] > time()){

                $remaining_time = $result_rec_user["temp_abonement"] - time();
                $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                        }else{
                                $abonnement = "nulle_abon";
                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                
                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                
                                header ('Location: ../paiement.php');
                        }
               
                    ?>
            <section  class="section_solde">
            <h1 class="solde_user"><?php echo $remaining_days;?></h1>
            <h1 class="solde">jours restants.</h1>
            </section>
                     <?php 
             }else{
                if($result_rec_boutique["type_abonnement"] == "cosmetic"){
                        if($result_rec_user["temp_abonement"] > time()){
                                $remaining_time = $result_rec_user["temp_abonement"] - time();
                                $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                        }else{
                                $abonnement = "nulle_abon";
                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));

                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));

                header ('Location: ../paiement.php');
                        }
                    ?>
            <section  class="section_solde">
            <h1 class="solde_user"><?php echo $remaining_days;?></h1>
            <h1 class="solde">jours restants.</h1>
            </section>
                     <?php 
             }else{
                if($result_rec_boutique["type_abonnement"] == "resto"){
                        if($result_rec_user["temp_abonement"] > time()){

                                $remaining_time = $result_rec_user["temp_abonement"] - time();
                                $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                        }else{
                                $abonnement = "nulle_abon";
                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));

                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));

                header ('Location: ../paiement.php');
                        }
                        
                    ?>
            <section  class="section_solde">
            <h1 class="solde_user"><?php echo $remaining_days;?></h1>
            <h1 class="solde">jours restants.</h1>
            </section>
                     <?php 
             }else{
                if($result_rec_boutique["type_abonnement"] == "voiture"){
                        if($result_rec_user["temp_abonement"] > time()){

                                $remaining_time = $result_rec_user["temp_abonement"] - time();
                                $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                        }else{
                                $abonnement = "nulle_abon";
                                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                
                                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                
                                header ('Location: ../paiement.php');
                        }
                        ?>
                <section  class="section_solde">
                <h1 class="solde_user"><?php echo $remaining_days;?></h1>
                <h1 class="solde">jours restants.</h1>
                </section>
                         <?php 
                 }else{
                        if($result_rec_boutique["type_abonnement"] == "boison"){
                                $remaining_day = floor($result_rec_user["temp_abonement"] / (  60 * 60 * 60));
                                
                                if($result_rec_user["temp_abonement"] > time()){

                                        $remaining_time = $result_rec_user["temp_abonement"] - time();
                                        $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                                }else{
                                        $abonnement = "nulle_abon";
                                        $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                                        $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));
                        
                                        $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                                        $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));
                        
                                        header ('Location: ../paiement.php');
                                }
                                ?>
                        <section  class="section_solde">
                        <h1 class="solde_user"><?php echo $remaining_days;?></h1>
                        <h1 class="solde">jours restants.</h1>
                        </section>
                                 <?php 
                         }else{
                                if($result_rec_boutique["type_abonnement"] == "immo"){
                                        if($result_rec_user["temp_abonement"] > time()){

                                                $remaining_time = $result_rec_user["temp_abonement"] - time();
                                                $remaining_days = floor($remaining_time / ( 24 * 60 * 60));
                                        }else{
                                                $abonnement = "nulle_abon";
                $inser_fin_abonnement = $db->prepare("UPDATE boutique SET tempt_abonnement_boutique = ? WHERE id = ? ");
                $inser_fin_abonnement -> execute(array($abonnement,  $result_rec_boutique["id"]));

                $inser_fin_abonnement_user = $db->prepare("UPDATE user SET temp_abonement = ? WHERE id = ? ");
                $inser_fin_abonnement_user -> execute(array($abonnement,  $_SESSION["id"]));

                header ('Location: ../paiement.php');
                                        }
                                        
                                        ?>
                                <section  class="section_solde">
                                <h1 class="solde_user"><?php echo $remaining_days;?></h1>
                                <h1 class="solde">jours restants.</h1>
                                </section>
                                         <?php 
                                 }

                         }

                 }

             }
             }

             }
             }

             }

                    ?>