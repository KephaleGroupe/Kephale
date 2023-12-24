<?php
if(isset($_POST["achete"])){
$passwor_usre = sha1($_POST["passwor_usre"]);
if(isset($_POST["passwor_usre"]) AND !empty($_POST["passwor_usre"])){
    if($_SESSION["mot_de_passe"] == $passwor_usre){

        if($boutique == 'neutre'){
            include_once "neutre/01_neutre.php";
        }else{
            if($boutique == 'neutre_standare'){
                include_once "neutre/02_neutre_standare.php";
            }else{
                if($boutique == 'neutre_electro'){
                    include_once "neutre/03_neutre_electro.php";
                }else{
                    if($boutique == 'neutre_cosmetic'){
                        include_once "neutre/04_neutre_cosmetic.php";
                    }else{
                        if($boutique == 'neutre_resto'){
                            include_once "neutre/05_neutre_resto.php";
                        }else{
                            if($boutique == 'neutre_voiture'){
                                include_once "neutre/06_neutre_voiture.php";
                            }else{
                                if($boutique == 'neutre_boison'){
                                    include_once "neutre/07_neutre_boison.php";
                                }else{
                                    if($boutique == 'neutre_immo'){
                                        include_once "neutre/08_neutre_immo.php";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }    

} else{
    $erreur = 'Mot de passe incorecte !';
    
    
}
}else{
$erreur = 'Entre votre mot de passe !';


}
}