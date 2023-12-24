<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";
$offre_kephale = $db->prepare("SELECT * FROM offre_kephale  ");
$offre_kephale -> execute(array()); 

$creation_boutique = $db->prepare("SELECT * FROM creation_boutique WHERE id_user = ?  ");
$creation_boutique -> execute(array($_SESSION["id"])); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/css/style.css">
    <title>Document</title>
</head>
<body>
 <?php
 if($creation_boutique->rowCount() > 0 ){
    while ($result = $creation_boutique->fetch() ){
        $id_user = $result["id_user"];
        $etat = $result["etat"]; 
        if( $etat == 'oui'){
            header ('Location: abonnement.php' );
        }else{
            if( $etat == 'nom'){
                ?>
    <section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="../user.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
    <h1 class="texte_petit_titre"> <br>Nous vous contacteront pour la signature du contrat.</h1>
                 <?php
            }
        }
    }

 }else{
$user = $db->prepare("SELECT * FROM user WHERE id = ?  ");
$user -> execute(array($_SESSION["id"])); 
if($user->rowCount() > 0 ){
    while ($result = $user->fetch() ){
        $nom = $result["nom"];
        $telephone = $result["telephone"]; 
        include_once "page/demande.php";
    }
}
 }
 ?>
    
</body>
</html>