<?php
$id_boutique ;
$rec_user = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
$rec_user -> execute(array($id_boutique)); 
$result_rec_user = $rec_user->fetch();
$type_abonnement = $result_rec_user["type_abonnement"];
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
$neutre_immo = 'neutre_immo';
if($type_abonnement == 'grand'){
    
    include_once "01_grand.php";
    
}else{
    if($type_abonnement == 'standare'){
    
        include_once "02_standare.php";
        
    }else{
        if($type_abonnement == 'electro'){
    
            include_once "03_electro.php";
            
        }else{
            if($type_abonnement == 'cosmetic'){
                include_once "04_cosmetic.php";
            }else{
                if($type_abonnement == 'resto'){
                    include_once "05_restau.php";
                }else{
                    if($type_abonnement == 'voiture'){
                        include_once "06_voiture.php";
                    }else{
                        if($type_abonnement == 'boison'){
                            include_once "07_boison.php";
                        }else{
                            if($type_abonnement == 'neutre'){
                                include_once "01_grand.php";
                            }else{
                                if($type_abonnement == 'neutre_standare'){
                                    include_once "02_standare.php";
                                }else{
                                    if($type_abonnement == 'neutre_electro'){
                                        include_once "03_electro.php";
                                    }else{
                                        if($type_abonnement == 'neutre_cosmetic'){
                                            include_once "04_cosmetic.php";
                                        }else{
                                            if($type_abonnement == 'neutre_resto'){
                                                include_once "05_restau.php";
                                            }else{
                                                if($type_abonnement == 'neutre_voiture'){
                                                    include_once "06_voiture.php";
                                                }else{
                                                    if($type_abonnement == 'neutre_boison'){
                                                        include_once "07_boison.php";
                                                    }else{
                                                        if($type_abonnement == 'immo'){
                                                            include_once "08_immo.php";
                                                        }else{
                                                            if($type_abonnement == 'neutre_immo'){
                                                                include_once "08_immo.php";
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
                    }
                }
            }
        }
    }
    
}
