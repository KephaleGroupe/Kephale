<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
$id_article = $_GET["id_article"];
$id_boutique = $_GET["id_boutique"];
$quantite_article = $_GET["quantite_article"];
$taille_article = $_GET["taille_article"];
$_SESSION["id_article"] = $id_article;
$_SESSION["id_boutique"] = $id_boutique;
$article = $db->prepare("SELECT * FROM les_articles WHERE id = ? ");
$article -> execute(array($id_article )); 
setlocale(LC_TIME, 'fr_FR');
//$date = new DateTime();
//echo strftime('%A %d %B %Y %H:%M:%S', $date->getTimestamp());

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="achete.php?id_article=<?php echo $id_article;?>&id_boutique=<?php echo $id_boutique;?>">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section> 
 <?php
 if($article->rowCount() > 0 ){
    while ($result = $article->fetch(PDO::FETCH_ASSOC) ){
        $prix_article = $result["prix_articles"];
        $montant_paye = $prix_article * $quantite_article;

        $boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
        $boutique -> execute(array($id_boutique)); 
        $result_usere = $boutique->fetch(); 
    $grand = 'grand' ;
    $neutre = 'standare' ;
    $electro = 'electro' ;
    $cosmetic = 'cosmetic' ;
    $resto = 'resto' ;
    $voiture = 'voiture';
    $boison = 'boison';
    $neutre = 'neutre';
    $neutre_standare = 'neutre_standare' ;
    $neutre_electro = 'neutre_electro' ;
    $neutre_cosmetic = 'neutre_cosmetic' ;
    $neutre_resto = 'neutre_resto' ;
    $neutre_voiture = 'neutre_voiture' ;
    $neutre_boison = 'neutre_boison' ;
        
        if(isset($_POST["payement"])){
            
            $result_user["boutique_user"];
            // verification grand
            if($result_usere["type_abonnement"] == 'grand'){
                include_once "php/payement.php";
            }else{
                // verification grand_restaut
                if($result_usere["type_abonnement"] == 'standare'){
                    include_once "php/payement.php";
                }else{
                    // verification grand_voiture
                    if($result_usere["type_abonnement"] == 'electro'){
                        include_once "php/payement.php";
                    }else{
                        // verification neutre
                        if($result_usere["type_abonnement"] == 'cosmetic'){
                            include_once "php/payement.php";
                        }else{
                            // verification neutre_restaut
                            if($result_usere["type_abonnement"] == 'resto'){
                                include_once "php/payement_resto.php";
                            }else{
                                // verification neutre_restaut
                                if($result_usere["type_abonnement"] == 'voiture'){
                                    include_once "php/payement.php";
                                }else{
                                    if($result_usere["type_abonnement"] == 'boison'){
                                        include_once "php/payement.php";
                                    }else{
                                        if($result_usere["type_abonnement"] == 'neutre_resto'){
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

        
        ?>
        <section class="boc_articl_commende">
            <img class="img_article" src="../../src/boutique/article/img_les_articles/<?php echo $result["img_articles"]?>" alt="">
            <section class="info_article_commande">
                <section class="texte_article colome">
                <h1 class="texte_moien_titre texte_limite "><?php echo $result["nom_articles"]?></h1>
                <h1 class="texte_moien_titre texte_plus"><?php echo $result["prix_articles"]?> FCFA</h1>
                <section class="info_prix">
                <h4>Quantite: <span class="valeur_article"><?php echo $quantite_article ?></span></h4>
                <h4>Taille: <span class="valeur_article"><?php echo $taille_article ?></span></h4>
                <h4>Totale : <span class="valeur_article"><?php echo $montant_paye ?>F CFA</span></h4>
                </section>
                <?php
                    $req_localisation = $db->prepare ("SELECT * FROM localisation WHERE id_user = ?"); 
                    $req_localisation -> execute(array($_SESSION["id"] ));
                    $req_localisation_existe = $req_localisation -> rowCount(); 
                    if($req_localisation_existe > 0 ){
                    $req_local = $db->prepare ("SELECT * FROM localisation WHERE id_user = ?"); 
                    $req_local -> execute(array($_SESSION["id"]));
                    $reque_req_local = $req_local -> fetch(); 

                    if(isset($_POST["actualise"])){
                        $quantite_article = htmlspecialchars($_POST["actualis"]);
                        if(!empty($_POST ["actualis"]) AND isset($_POST ["actualis"])){
                        $article_livre = $db->prepare("UPDATE localisation SET localite = ? WHERE id_user = ? ");
                        $article_livre -> execute(array( $quantite_article, $_SESSION["id"]));

                        header("refresh: 1");
                        }

                    }
                        
                        ?>
                        <p class="texte_pli">Lieu de livraison actuele est <?php echo $reque_req_local ["localite"]; ?></p>
                        <p class="texte_petit">Actualise</p>
                        <form class="section_form" method="POST" enctype="multipart/form-data">
                        <input style="padding: 10px 20px ; width: 200px;" class="form_input input_plus" type="texte" placeholder="Mali Bamako" name ="actualis" value="<?php echo $reque_req_local ["localite"]; ?>">
                        <input style="padding: 10px 20px ; width: 200px;" class="form_input_botone" type="submit" value="Actualise" name ="actualise">
                        </form>
                     
                        <?php
                    }else{
                        if(isset($_POST["envoye_locali"])){
                            $quantite_article = htmlspecialchars($_POST["localite"]);
                            if(!empty($_POST ["localite"]) AND isset($_POST ["localite"])){

                            $id_boutique = 'non';
                            $transactions = $db->prepare("INSERT INTO localisation (id_user, id_boutique, localite) VALUES (?,?,?)");
                            $transactions -> execute(array($_SESSION["id"], $id_boutique, $_POST ["localite"] ));
                            header("refresh: 1");
                            }

                        }
                        ?>
                        <p class="texte_pli">Entre le lieu de livraisont</p>
                        <form class="section_form" method="POST" enctype="multipart/form-data">
                        <input style="padding: 10px 20px ; width: 200px;" class="form_input input_plus" type="texte" placeholder="Mali Bamako" name ="localite">
                        <input style="padding: 10px 20px ; width: 200px;" class="form_input_botone" type="submit" value="Envoye" name ="envoye_locali">
                        </form>
                        <?php
                    }
                    ?>
                </section>

                <form  class="section_form" method="POST" enctype="multipart/form-data">
                <p class="texte_pli">Entre votre mot de passe pour confirme l'achat.</p>
                <input class="form_input input_plus" type="password" placeholder="Mot de passer" name ="password_user">
                <input class="form_input_botone" type="submit" value="Confirme l'achat" name ="payement">
                <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>
                        <?php
                    }
                    ?>
                </form>
                <?php
                    $liste_dete = $db->prepare("SELECT * FROM liste_dete WHERE id_user = ? ");
                    $liste_dete -> execute(array($_SESSION["id"])); 
                    $liste_dete->rowCount();
                    if($liste_dete->rowCount() > 0){

                    }else{
                    $kephale_fond = $db->prepare("SELECT * FROM kephale_fond");
                    $kephale_fond -> execute(array()); 
                    $result_kephale_fond = $kephale_fond->fetch();
                    $solde = $result_kephale_fond["solde"];
                    $etat = $result_kephale_fond["etat"];
                    $fond_depart = $result_kephale_fond["fond_depart"];
                    $fond_limite = $result_kephale_fond["fond_limite"];
                    if($etat == "oui"){
                        if(isset($_POST["tranche"])){
                            if ($montant_paye >= $fond_depart AND $montant_paye <= $fond_limite ){
                                $nul = '0';
                                $etat = 'nulle';
                                $transactions = $db->prepare("INSERT INTO verification_infot_user (id_user, image_carte, image_certifica, etat ) VALUES (?,?,?,?)");
                                $transactions -> execute(array($_SESSION["id"], $nul, $nul, $etat ));
                                // charge compte Kephale
                                header ('Location:');
                            }else{
                                $info = 'Le prix du produit doit etre superieur ou egale a '.$fond_depart.'F CFA et inferieur ou egale a '.$fond_limite.'F CFA';
                            }
                        }
                        $verification_infot_user = $db->prepare("SELECT * FROM verification_infot_user WHERE id_user = ? ");
                        $verification_infot_user -> execute(array($_SESSION["id"])); 
                        if($verification_infot_user->rowCount() > 0){

                        }else{
                            ?>
                        <form  class="section_form" method="POST" enctype="multipart/form-data">
                        <input style="background-color: #F7A429;" class="form_input_botone" type="submit" value="Payer par tranche" name ="tranche">
                        </form>
                            <?php
                             if(isset ($info)){
                                ?>
                                <h1 class="texte_minime texte_alert " ><?php echo $info ?></h1>
                                <?php
                            }
                            
                        }
                    }
                    }
                    ?>
                </section> 
            </section>
        <?php
    }
 }
 ?>

</body>
</html>
<script>

document.getElementById('shareLocation').addEventListener('click', function() {
            // Demander la permission d'accéder à la géolocalisation
            if (navigator.geolocation) {
                document.getElementById('resultate').innerHTML = "Localication en coure...";
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    // Affichez la latitude et la longitude
                    
                    // Effectuez une requête Ajax pour envoyer ces données au script PHP
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'enregistrer_position.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send("latitude=" + latitude + "&longitude=" + longitude);

                    // Réception de la réponse du serveur
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var reponse = xhr.responseText;
                            document.getElementById('resultate').innerHTML = reponse;
                        }
                    };
                });
            } else {
                document.getElementById('resultate').innerHTML = "La géolocalisation n'est pas prise en charge par votre navigateur.";
            }
        });
</script>

