<?php
session_start();
include_once "../../../../../../kephale_bdd/kephale_bdd.php";
$rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ? ");
    $rec_boutique-> execute(array($_SESSION["id"]));
    $result_rec_boutique = $rec_boutique->fetch();
    $_SESSION["id_boutique"] = $result_rec_boutique["id"];
if(isset($_SESSION["id"] ) AND $_SESSION["id"] ==  $result_rec_boutique["id_user"] ){
}else{
    $_SESSION = array();
    session_destroy();
    header ('Location:../../../../../../index.php');
}

if (isset($_POST["suivant"]) AND !empty($_POST["suivant"])){
    $numerau_user = htmlspecialchars($_POST["numeraux_user"]);
    $req_numeraux = $db->prepare ("SELECT * FROM user WHERE telephone = ?"); 
    $req_numeraux -> execute(array($numerau_user));
    $req_numeraux_existe = $req_numeraux -> rowCount(); 
    if(!empty($_POST["numeraux_user"])){
        if(is_numeric($numerau_user)){
    if($req_numeraux_existe > 0 ){
        header ('Location: transfer.php?numero='.$numerau_user);
    }else{
        $erreur = "Ce numéro (".$numerau_user.") n'existe pas ! "; 
    }
}else{
    $erreur = "Entrer juste les chicffre !";
}

}else{
    $erreur = "Entrer votre numéro de téléphone !";
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="../retrait.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
    </section>
    
    <section class="section_input">
        <h1 class="texte_standare" >Entre le numéro du destinateur</h1>
        <p>Entre le numéro </p>
        <form class="section_form" method="POST" enctype="multipart/form-data">
            <input class="form_input" type="number" placeholder="Numéro de telephone" name="numeraux_user" value="<?php if(isset($numerau_user)) {echo $numerau_user;} ?>">
            <input class="form_input_botone" class="submit" type="submit" value="Suivant" name="suivant">
        </form>
        <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>
                        <?php
                    }
                    ?>
        
    </section>
</body>
</html>