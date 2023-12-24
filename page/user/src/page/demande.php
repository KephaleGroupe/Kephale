<?php
$boutique = $_GET["boutique"];
$nom_user = htmlspecialchars($_POST["nom_user"]);
$numerau_user = htmlspecialchars($_POST["numeraux_user"]);
if (isset($_POST["demande"]) AND !empty($_POST["demande"]) ){
    if(!empty($_POST["numeraux_user"])){
        if(!empty($_FILES["img_user_profil"]["tmp_name"])){
$img_name = pathinfo($_FILES["img_user_profil"]["name"], PATHINFO_FILENAME);
$img_expentions = pathinfo($_FILES["img_user_profil"]["name"], PATHINFO_EXTENSION);
$nom_img = $img_name . '_' . date("ymd_His") . '.' . $img_expentions;
$img_direction = "img_idantite/";

$photo = $_FILES["img_produit"]["name"];
$taille_fichier = filesize($_FILES["img_user_profil"]["tmp_name"]);
$taille_en_ko = $taille_fichier / 1024 ;
$taille_en_mo = $taille_en_ko / 1024 ;
round($taille_en_ko ,2);
$nonbre_photo = "1";
$img_autorise = ['jpg','jpeg','png','PNG','JPG','JPEG'];

        if(in_array($img_expentions,$img_autorise )){

            if(round($taille_en_mo ,1) <= 5){
                $img_telecharge = $img_direction . $nom_img;
            move_uploaded_file ($_FILES["img_user_profil"]["tmp_name"], $img_telecharge);
            $etat = 'nom';
            $inser_user = $db->prepare("INSERT INTO creation_boutique ( id_user, nume_user, type_boutique, image_carte, etat ) VALUES (?,?,?,?,?)");
            $inser_user -> execute(array($_SESSION["id"], $numerau_user, $boutique, $nom_img, $etat ));
            header ('Location: creations_boutique.php?boutique='.$boutique );
        
            }else{
                $erreur = "La taille de votre image est de ".round($taille_en_mo ,1)."Mo elle ne doit pas depaser 5Mo ";
                
            }

        }else{
    $erreur = "l'expentions .".$img_expentions." n'est pas une image autorisée, seul les photos aux forment jpg, jpeg, png sons autorisée.";

        }
    


}else{
    $erreur = "Charge la photo de votre carte";
}
}else{
    $erreur = "Entre votre numeraux.";
}
}else{

}
 
?>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="abonnement.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
 </section>
    <section class="section_input">
    <h1 class="texte_grand_titre">Bonjour <?php echo $nom ?></h1>
    <h5 class="texte_petit_titre" style="width: 330px;">Pour la création d'une boutique il est imporant pour nous de vous garantir et vous expliquer les condition d'utilisation.</h5>
    <form  class="section_form" method="POST" enctype="multipart/form-data">
    <input class="form_input" type="number" placeholder="<?php  echo $telephone ?>" name="numeraux_user" value="<?php  echo $telephone ?>">
    <input type="file" id="file" name="img_user_profil">
            <h1 class="texte_minime" >Ajoute la photo de votre pièce d'identite nationale.</h1>
            <label for="file">
                <img src="../../../media/icone/fill_img.svg" alt="">
                Image
            </label>
    <input class="form_input_botone" type="submit" value="Envoye la demande" name ="demande">
    <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>
                        <?php
                    }
                    ?>
    </form>
    </section>