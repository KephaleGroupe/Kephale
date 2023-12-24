<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";
    $boutique = $_GET["boutique"];
    $req_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
    $req_user -> execute(array($_SESSION["id"])); 
    $result_req_user = $req_user->fetch();
    $_SESSION["solde"] = $result_req_user["solde"];
    $_SESSION["mot_de_passe"] = $result_req_user["mot_de_passe"];

    $req_boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
    $req_boutique -> execute(array($_SESSION["id"]));
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
    
    if($req_boutique->rowCount() > 0 ){
        
        include_once "php/reabonnement.php";
        
    }else{

        if($boutique == 'grand'){
        include_once "php/01_grand.php";
        }else{
            if($boutique == 'standare'){
                include_once "php/02_standare.php";
                }else{
                    if($boutique == 'electro'){
                        include_once "php/03_electro.php";
                        }else{
                            if($boutique == 'cosmetic'){
                                include_once "php/04_cosmetic.php";
                            }else{
                                if($boutique == 'resto'){
                                    include_once "php/05_resto.php";
                                }else{
                                    if($boutique == 'voiture'){
                                        include_once "php/06_voiture.php";
                                    }else{
                                        if($boutique == 'boison'){
                                            include_once "php/07_boison.php";
                                        }else{
                                            if($boutique == 'neutre'){
                                                include_once "php/abonnement_neutre.php";
                                            }else{
                                                if($boutique == 'neutre_standare'){
                                                    include_once "php/abonnement_neutre.php";
                                                }else{
                                                    if($boutique == 'neutre_electro'){
                                                        include_once "php/abonnement_neutre.php";
                                                    }else{
                                                        if($boutique == 'neutre_cosmetic'){
                                                            include_once "php/abonnement_neutre.php";
                                                        }else{
                                                            if($boutique == 'neutre_resto'){
                                                                include_once "php/abonnement_neutre.php";
                                                            }else{
                                                                if($boutique == 'neutre_voiture'){
                                                                    include_once "php/abonnement_neutre.php";
                                                                }else{
                                                                    if($boutique == 'neutre_boison'){
                                                                        include_once "php/abonnement_neutre.php";
                                                                    }else{
                                                                        if($boutique == 'immo'){
                                                                            include_once "php/08_immo.php";
                                                                        }else{
                                                                            if($boutique == 'neutre_immo'){
                                                                                include_once "php/abonnement_neutre.php";
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
    }

        
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
 <?php
 $req_boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
 $req_boutique -> execute(array($_SESSION["id"])); 
if($req_boutique->rowCount() > 0 ){
    include_once "page_type_boutique/page_fin_abonnement.php";
}else{
    if($boutique == 'grand'){
        include_once "page_type_boutique/01_grand.php";
    }else{
        if($boutique == 'standare'){
            include_once "page_type_boutique/01_grand.php";
        }else{
            if($boutique == 'electro'){
                include_once "page_type_boutique/01_grand.php";
            }else{
                if($boutique == 'cosmetic'){
                    include_once "page_type_boutique/01_grand.php";
                }else{
                    if($boutique == 'resto'){
                        include_once "page_type_boutique/01_grand.php";
                    }else{
                        if($boutique == 'voiture'){
                            include_once "page_type_boutique/01_grand.php";
                        }else{
                            if($boutique == 'boison'){
                                include_once "page_type_boutique/01_grand.php";
                            }else{
                                if($boutique == 'neutre'){
                                    include_once "page_type_boutique/01_grand.php";
                                }else{
                                    if($boutique == 'neutre_standare'){
                                        include_once "page_type_boutique/01_grand.php";
                                    }else{
                                        if($boutique == 'neutre_electro'){
                                            include_once "page_type_boutique/01_grand.php";
                                        }else{
                                            if($boutique == 'neutre_cosmetic'){
                                                include_once "page_type_boutique/01_grand.php";
                                            }else{
                                                if($boutique == 'neutre_resto'){
                                                    include_once "page_type_boutique/01_grand.php";
                                                }else{
                                                    if($boutique == 'neutre_voiture'){
                                                        include_once "page_type_boutique/01_grand.php";
                                                    }else{
                                                        if($boutique == 'neutre_boison'){
                                                            include_once "page_type_boutique/01_grand.php";
                                                        }else{
                                                            if($boutique == 'immo'){
                                                                include_once "page_type_boutique/01_grand.php";
                                                            }else{
                                                                if($boutique == 'neutre_immo'){
                                                                    include_once "page_type_boutique/01_grand.php";
                                                                }else{
                                                            include_once "page_type_boutique/01_grand.php";
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

}
    ?>
</body>
</html>
