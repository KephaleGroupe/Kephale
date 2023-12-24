<?php
session_start();
if(isset($_POST["conection"])){
    $nom_user = htmlspecialchars($_POST["nom_user"]);
    $passwor_usre = sha1($_POST["password_user"]);
    if(!empty($_POST ["nom_user"]) AND isset($_POST ["password_user"])){

        if(!empty($_POST ["password_user"])){
            $req_user_Non = $db->prepare ("SELECT * FROM user WHERE nom = ? AND mot_de_passe = ? ");
            $req_user_Non -> execute([$nom_user,$passwor_usre]); 
            $exist_user = $req_user_Non -> fetch(PDO::FETCH_ASSOC); 
            if($nom_user == $exist_user["nom"]){
                if($passwor_usre  == $exist_user["mot_de_passe"]){

                    $_SESSION["id"] = $exist_user["id"];
                    header ('Location: ../user/user.php');
                }else{
                    $erreur = 'Nom user introuvable!';
                }
            }else{
                $erreur = 'Mot de passe incorrect! ';
            }
        }else{
          $erreur = 'Entrer votre mot de passe !';
        }
    }else{
        $erreur = 'Entrer vos informations de connection !';
    }
}
?>