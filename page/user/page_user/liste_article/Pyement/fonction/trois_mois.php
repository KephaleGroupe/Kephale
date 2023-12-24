<?php 
$rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
$rec_boutique -> execute(array($_SESSION["id_boutique"])); 
$result_rec_boutique = $rec_boutique->fetch(); 
if(isset($_POST["payement_trois_mois"])){

    if($result_rec_boutique["type_abonnement"] == 'grand'){
        include_once "php/payement.php";
    }else{
        // verification grand_restaut
        if($result_rec_boutique["type_abonnement"] == 'standare'){
            include_once "php/payement.php";
        }else{
            // verification grand_voiture
            if($result_rec_boutique["type_abonnement"] == 'electro'){
                include_once "php/payement.php";
            }else{
                // verification neutre
                if($result_rec_boutique["type_abonnement"] == 'cosmetic'){
                    include_once "php/payement.php";
                }else{
                    // verification neutre_restaut
                    if($result_rec_boutique["type_abonnement"] == 'resto'){
                        include_once "php/payement_resto.php";
                    }else{
                        // verification neutre_restaut
                        if($result_rec_boutique["type_abonnement"] == 'voiture'){
                            include_once "php/payement.php";
                        }else{
                            if($result_rec_boutique["type_abonnement"] == 'boison'){
                                include_once "php/payement.php";
                            }else{
                                if($result_rec_boutique["type_abonnement"] == 'neutre_resto'){
                                    include_once "php/payement_neutre_resto.php";
                                }else{
                                    include_once "php/payement_neutre.php";
                                }
                            }
                            
                        }
                    }
                }
            }
        }
    }
}