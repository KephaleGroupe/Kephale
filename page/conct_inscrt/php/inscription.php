<?php
if (isset($_POST["inscription_user"]) AND !empty($_POST["inscription_user"]) ){
    $nom_user = htmlspecialchars($_POST["nom_user"]);
    $numerau_user = htmlspecialchars($_POST["numeraux_user"]);
    $password_user_1 = sha1($_POST["password_user"]);
    $password_user_2 = sha1($_POST["password_user_2"]);
    $nom_limite = strlen ($nom_user);
    $numerau_user_limite = strlen ($numerau_user);
    $solde_usre = '0';
    $boutique_user = 'nulle';
    $temp_abonnement_user = '0';
    $req_numeraux = $db->prepare ("SELECT * FROM user WHERE telephone = ?"); 
    $req_numeraux -> execute(array($numerau_user));
    $req_numeraux_existe = $req_numeraux -> rowCount(); 

    if(!empty($_POST["nom_user"])){
        if(!empty($_POST["numeraux_user"])){
            if(!empty($_POST["password_user"])){
                if(!empty($_POST["password_user_2"])){
                    if(!empty($_FILES["img_user_profil"]["tmp_name"])){
                        if($req_numeraux_existe === 0) {
                            if($password_user_1 === $password_user_2){
                                    $img_name = pathinfo($_FILES["img_user_profil"]["name"], PATHINFO_FILENAME);
                                    $img_expentions = pathinfo($_FILES["img_user_profil"]["name"], PATHINFO_EXTENSION);
                                    $nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;
                                    $img_direction = "img_profile_user/";
                                    $taille_fichier = filesize($_FILES["img_user_profil"]["tmp_name"]);
                $taille_en_ko = $taille_fichier / 1024 ;
                $taille_en_mo = $taille_en_ko / 1024 ;
                round($taille_en_ko ,2);
                $img_autorise = ['jpg','jpeg','png','PNG','JPG','JPEG'];
                    
                if(round($taille_en_mo ,1) <= 5){
                                            if(in_array($img_expentions,$img_autorise )){
                                               
                                                $img_telecharge = $img_direction . $nom_img;
                                                move_uploaded_file ($_FILES["img_user_profil"]["tmp_name"], $img_telecharge);
                                                $inser_user = $db->prepare("INSERT INTO user ( nom, telephone, mot_de_passe, img_profile, solde, temp_abonement, boutique_user ) VALUES (?,?,?,?,?,?,?)");
                                                $inser_user -> execute(array($nom_user, $numerau_user, $password_user_2, $nom_img, $solde_usre,$temp_abonnement_user , $boutique_user ));
                            
                                                header ('Location: connexion.php');
                    
                                            }else{
                                        $erreur = "l'expentions .".$img_expentions." n'est pas une image autorisée, seul les photos aux formant jpeg, jpeg, png sons autorisées.";
                    
                                            }
                                        }else{
                                            $erreur = "La taille de votre image est de ".round($taille_en_mo ,1)."Mo elle ne doit pas depase 5Mo ";
                                            
                                        }
                                        
                                  
                            }else{
                                $erreur = "Les deux mots de passe ne sont pas indentiques";
                            }
                        }else{
                            $erreur = "Ce numreo existe deja";
                        }
                    }else{
                        $erreur = "Inserer une image de profil";
                    }
                }else{
                    $erreur = "Confirmer votre mot de passe !";
                }
            }else{
                $erreur = "Entrer votre mot de passe !";
            }
        }else{
            $erreur = "Entrer votre numéro de téléphone !";
        }
    }else{
        $erreur = "Entrer votre nom complet !";
    }

}
?>