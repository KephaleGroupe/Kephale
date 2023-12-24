<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
$eta_commande = 'confirme';
$liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_user = ? AND client_etat LIKE 'non' ORDER BY id DESC ");
$liste_achat -> execute(array($_SESSION["id"])); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .hidden{
            display: none;
            
        }
        .masque{
            color: #6d6d6d;
            font-size: 14px;
            margin-top: 7px;
            text-align: left;
            background-color: rgb(213, 213, 213);
            border: none;
        }
        
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;">
    <a class="lien_icon" href="../../user.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
 <?php
if($liste_achat->rowCount() > 0 ){
    while ($result = $liste_achat->fetch() ){
        $id_user = $result["id_user"];
        $id_article = $result["id_article"];
        $id_boutique = $result["id_boutique"];
        $id = $result["id"];
        $temp_livraison = $result["temp_livraison"];
        $montant_paye = $result["montant_paye"];
        $eta_livraison = $result["livre"];
        $rec_article = $db->prepare("SELECT * FROM les_articles WHERE id = ? ");
        $rec_article -> execute(array($id_article)); 
        $result_article= $rec_article->fetch();

        $rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
        $rec_boutique -> execute(array($id_boutique)); 
        $result_boutique = $rec_boutique->fetch();

        $info_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_article = ? ");
        $info_achat -> execute(array($id_article)); 
        $result_info_achat = $info_achat->fetch();

        if( $eta_livraison == 'non'){
            $end = $temp_livraison;
            $data = time();
            $remaining_seconds = $end - $data;
            
                
                if($temp_livraison > $data  ){
                $type_boutique = $result_boutique["type_abonnement"];
                $remaining_days = floor($remaining_seconds / (60 * 60 * 24));
                    
                }else{
                    include_once "fonction/grand.php";
                }

          
            
        }
                ?>
                <?php
         $liste = $db->prepare("SELECT * FROM liste_achat WHERE temp_livraison = ?");
         $liste -> execute(array($result["temp_livraison"] )); 
         $result_liste = $liste->fetch();
         $cache = $result_liste["temp_livraison"] + 22;
         ?>
        <section class="boc_articl_commende">
            <img class="img_article" src="../../src/boutique/article/img_les_articles/<?php echo $result_article["img_articles"]?>" alt="">
            <section class="info_article_commande">
                <section class="texte_article colome">
                
                <section class="info_prix">
                    
                <h4>Nom de l'article: <span class="valeur_article"><?php echo $result_article["nom_articles"]?></span></h4>
                <h4>Prix de l'article: <span class="valeur_article"><?php echo $result_article["prix_articles"]?>F CFA</span></h4>
                <div data-toggle = "<?php echo $cache?>" class="content hidden" >
                <h4>Boutique: <span class="valeur_article"><?php echo $result_boutique["nom_boutique"]?></span></h4>
                <h4>Quantite: <span class="valeur_article"><?php echo $result_liste["quantite_article"] ?></span></h4>
                <h4>Taille: <span class="valeur_article"><?php echo $result_info_achat["taille_article"]  ?></span></h4>
                <h4>Description: <span class="valeur_article"><?php echo $result_article["descriptions_articles"]  ?></span></h4>
                <h4>Totale : <span class="valeur_article"><?php echo $result_liste["montant_paye"]  ?>F CFA</span></h4>
                <?php
                 $temp_achat = $db->prepare("SELECT * FROM livraisons WHERE temp_achat = ?");
                 $temp_achat -> execute(array($result_liste["temp_livraison"])); 
                 $result_temp_achat = $temp_achat->rowCount();
                 if($temp_achat->rowCount() > 0 ){
                    while ($result_temp_achat = $temp_achat->fetch() ){
                        ?>
                        <h4>Frait de livraisont :<span class="valeur_article"><?php echo $result_temp_achat["frait"]?>F CFA</span></h4>
                            <?php
                    }
                 }else{
                    ?>
                <h4>Frait de livraisont :<span class="valeur_article"> En traitement...</span></h4>
                    <?php
                 }


                 ?>
                <?php
                $type_boutique = $result_boutique["type_abonnement"];
                $neutre_resto = 'neutre_resto';
                $grand_restaut = 'grand_restaut';
                $grand_voiture = 'grand_voiture';
                $neutre = 'neutre';
                $neutre_restaut = 'neutre_restaut';
                $neutre_voiture = 'neutre_voiture';
                if($type_boutique == $neutre_restaut){
    
                    ?>
                <h1 class="texte_article">Dans un delet de 24h si votre article n'est pas livre l'achat cerai annule et vous sere rebourse.</h1>

                    <?php
                }else{
                    if($type_boutique === $neutre_resto){
                        ?>
                <h1 class="texte_article">Dans un delet de 24h si votre article n'est pas livre l'achat cerai annule et vous sere rebourse.</h1>
                        <?php
                    }else{
                        
                            ?>
                    <h1 class="texte_article">Dans un delet de 48h si votre article n'est pas livre l'achat cerai annule et vous sere rebourse.</h1>
                            <?php
                        
                    }
                
                    }
                
                ?>
                <?php
                if( $eta_livraison === 'non'){
                    ?>
                <h4 style="color: #E94E1B; text-align: center; margin-top: 10px;"><?php  echo $remaining_days . " jours restant."; ?></h4>
                    <?php
            
               }else{
               if( $eta_livraison === 'oui'){
                }
             }
             ?>
                </div>
                <button data-target="<?php echo $cache?>" class="toggle-button masque ">Afficher...</button> 
                </section>
                <?php
                $livre = $result_liste["livre"];
                // la livrai en coure
                if ($livre === 'non') {
                    ?>
                    <p style="font-size: 12px;" id="resultat"></p>
                    <section class="botone_cfrm_sprm">
                        <a href="confirme_livraison.php?id_article=<?php echo $result_liste["temp_livraison"]?>" style="border: none;" class=" bonton_article" >Confirme la livraison</a>
                    </section>
                    <?php
                }else{
                    // si la livrai est fait on lanse le chrono de 10 minute
                    if ($livre == 'oui'){
            $liste_achate = $db->prepare("SELECT * FROM temp_annule WHERE temp_article = ?");
            $liste_achate -> execute(array($result_liste["temp_livraison"])); 
            $result_liste_achate = $liste_achate->fetch();
            $etat = $result_liste_achate["etat"];
            $temp_restant = $result_liste_achate["temp_restant"];
            $temps_initial = 20 * 60; // 10 minutes en secondes
            $temp =  $temp_restant + $temps_initial;
            $temps_passe = time() - $temp_restant;
            $temps_restant = $temps_initial - $temps_passe;
            $chrono = gmdate("i", $temps_restant);
                        ?>
                         <?php
                         if($temp_restant > 0){
                            if( time() < $temp){
                                header("refresh:  60");
                                ?>
                            <p style="font-size: 12px;">Vous dispose de <?php echo $chrono?> minute pour annule votre achate si il y a un probleme avec l'article.</p>
                            <section class="botone_cfrm_sprm">
                           <a href="valide.php?id_article=<?php echo $result_liste["temp_livraison"]?>" style="border: none; " class=" bonton_article" >Valide l'achat</a>
                           </section>

                           <section class="botone_cfrm_sprm">
                           <a href="confirme_livraison.php?id_article=<?php echo $result_liste["temp_livraison"]?>" style="border: none; background-color: #E94E1B;" class=" bonton_article" >Annule l'achat</a>
                           </section>
                           
                    
                                 <?php
                             }else{
                                $temp = '0';
                                $temp_epuise = $db->prepare("UPDATE temp_annule SET temp_restant = ? WHERE temp_article = ? ");
                                $temp_epuise -> execute(array( $temp, $result_liste["temp_livraison"] ));
                                header ('Location: index.php');
                             }

                         }else{
                            if($etat === 'oui'){
                                $id_achat = $db->prepare("SELECT * FROM liste_achat WHERE temp_livraison = ?");
                                $id_achat -> execute(array($result_liste["temp_livraison"] )); 
                                $result_id_achat = $id_achat->fetch();
                                
                                
                                ?>
                                <section class="botone_cfrm_sprm">
                           <a href="suprime.php?temp_livraison=<?php echo $result_id_achat["id"] ?>" style="border: none; background-color: #E94E1B;" class=" bonton_article" >Suprimer de la liste</a>
                           </section>
                              <p style="font-size: 12px; color: rgb(160, 160, 160); ">Nous vous remercion pour votre comfience.</p>
                            <?php
                            }else{
                                if($etat === 'b'){
                                    ?>
                                  <p style="font-size: 12px; color: rgb(160, 160, 160); ">Votre demande d'annulation de l'achat est en coure de traitement...</p>
                                <?php
                                }else{
                                    if($etat === 'valide'){
                                        ?>
                                      <p style="font-size: 12px; color: rgb(160, 160, 160); ">Votre demande a ete prix en compte <br> vous aller etre renbourse dans <br> les minute a venire.</p>
                                    <?php
                                    }else{
                                        if($etat === 'nom'){
                                            ?>
                            <section class="botone_cfrm_sprm">
                           <a href="suprime.php?temp_livraison=<?php echo $result_id_achat["id"] ?>" style="border: none; background-color: #E94E1B;" class=" bonton_article" >Suprimer de la liste</a>
                           </section>
                                          <p style="font-size: 12px; color: rgb(160, 160, 160); ">Votre demande na pas ete prix en compte.</p>
                                        <?php
                                        }else{
                                            if($etat === 'renbource'){
                                                ?>
                            <section class="botone_cfrm_sprm">
                           <a href="suprime.php?temp_livraison=<?php echo $result_id_achat["id"] ?>" style="border: none; background-color: #E94E1B;" class=" bonton_article" >Suprimer de la liste</a>
                           </section>
                                              <p style="font-size: 12px; color: rgb(160, 160, 160); ">Vous ave ete renbourse sur l'achat de cet article.</p>
                                            <?php
                                            }
                                        }
                                    }
                                }
                            }
                         }
                         

                    }
                }
                ?>
                </section>
                
                </section> 
            </section>
         <?php

    }
}
?>
</body>
</html>
<script>

        var buttons = document.querySelectorAll('.toggle-button');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var target = this.getAttribute('data-target');
                var div = document.querySelector('[data-toggle="' + target + '"]');

                if (div.style.display === "none") {
                    div.style.display = "block";
                    this.textContent = "Masquer";
                } else {
                    div.style.display = "none";
                    this.textContent = "Afficher...";
                }
            });
        });
    </script>

<script>
    document.getElementById("monBouton").addEventListener("click", function() {
  // Créez un objet XMLHttpRequest
  var xhr = new XMLHttpRequest();
  var articleId = this.getAttribute('data-articleid');
  // Configurez la requête AJAX
  xhr.open("GET", "start_chrono.php?id_article="+ articleId, true);

  // Définissez la fonction de rappel à exécuter lorsque la réponse est prête
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Mettez la réponse dans la div "resultat"      

      document.getElementById("resultat").innerHTML = xhr.responseText;
      document.getElementById("monBouton").style.backgroundColor = "#E94E1B";
      document.getElementById("monBouton").innerHTML = "Annule l'achat ";
    }
  };

  // Envoyez la requête
  xhr.send();
});
</script>

<script>
    document.getElementById("annule").addEventListener("click", function() {
  // Créez un objet XMLHttpRequest
  var xhr = new XMLHttpRequest();
  var articl = this.getAttribute('data-articl');
  // Configurez la requête AJAX
  xhr.open("GET", "annule_achat.php?id_article="+ articl, true);

  // Définissez la fonction de rappel à exécuter lorsque la réponse est prête
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Mettez la réponse dans la div "resultat"      

      document.getElementById("resultat").innerHTML = xhr.responseText;
      document.getElementById("monBouton").style.background = "none";
      document.getElementById("monBouton").innerHTML = "";
    }
  };

  // Envoyez la requête
  xhr.send();
});
</script>

