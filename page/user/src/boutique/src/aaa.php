<?php
session_start();
include_once "../../../../../kephale_bdd/kephale_bdd.php";
$id_boutique = $_SESSION["id_boutique"]; 
$liste_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_boutique = ? AND boutique_etat LIKE 'non'  ORDER BY id DESC ");
$liste_achat -> execute(array($id_boutique)); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../../css/css/style.css">
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
    <title>Document</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;">
    <a class="lien_icon" href="../grand.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
 <?php
 if($liste_achat->rowCount() > 0 ){
    while ($result = $liste_achat->fetch()){
        $id_user = $result["id_user"];
        $id_article = $result["id_article"];
        $id_boutique = $result["id_boutique"];
        $id = $result["id"];
        $temp_livraison = $result["temp_livraison"];
        $montant_paye = $result["montant_paye"];
        $id_achat = $result["id"];

        $rec_article = $db->prepare("SELECT * FROM les_articles WHERE id = ? ");
        $rec_article -> execute(array($id_article)); 
        $result_article= $rec_article->fetch();

        $rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
        $rec_boutique -> execute(array($id_boutique)); 
        $result_boutique = $rec_boutique->fetch();


        $rec_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
        $rec_user -> execute(array($id_user)); 
        $result_rec_user= $rec_user->fetch();

        $end = $temp_livraison;
        $data = time();
        $remaining_seconds = $end - $data;
        if($remaining_seconds > 0 ){
            $remaining_days = floor($remaining_seconds / (60 * 60 * 24));
        }
        ?>
         <?php
         $liste = $db->prepare("SELECT * FROM liste_achat WHERE temp_livraison = ?");
         $liste -> execute(array($result["temp_livraison"] )); 
         $result_liste = $liste->fetch();
         $cache = $result_liste["temp_livraison"] + 22;

         ?>
        <section class="boc_articl_commende">
            <img class="img_article" src="../article/img_les_articles/<?php echo $result_article["img_articles"]?>" alt="">
            <section class="info_article_commande">
                <section class="texte_article colome">
                
                <section class="info_prix">
                    
                <h4>Nom de l'article: <span class="valeur_article"><?php echo $result_article["nom_articles"]?></span></h4>
                <h4>Prix de l'article: <span class="valeur_article"><?php echo $result_article["prix_articles"]?>F CFA</span></h4>
                <div data-toggle = "<?php echo $cache ?>" class="content hidden" >
                <h4>Client: <span class="valeur_article"><?php echo $result_rec_user["nom"]?></span></h4>
                <h4>Quantité: <span class="valeur_article"><?php echo $result["quantite_article"] ?></span></h4>
                <h4>Taille: <span class="valeur_article"><?php echo $result["taille_article"]  ?></span></h4>
                <h4>Description: <span class="valeur_article"><?php echo $result_article["descriptions_articles"]  ?></span></h4>
                <?php
                $type_abonnement = $result_boutique["type_abonnement"];
                $montant_paye = $result["montant_paye"];
                $montant = $montant_paye;
                $pourcentage = 5;
                $resultat = ($pourcentage / 100) * $montant;
                $montant =   $montant - $resultat ;
                
                if($type_abonnement == 'neutre'){
                    ?>
                    <span class="valeur_article">
                        Kephale à 5% sur chaque achat effectuer sur votre boutique.</span>
                    <h4>Montant de l'achat: <span class="valeur_article"> <?php echo $result["montant_paye"]  ?>F CFA</span></h4> 
                    <h4>5% : <span class="valeur_article"> <?php echo $resultat ?>F CFA</span></h4> 
                    <h4>Montant versé: <span class="valeur_article"> <?php echo $montant  ?>F CFA</span></h4> 


                    <?php
                }else{
                    if($type_abonnement == 'neutre_standare'){
                       
                        ?>
                        
                        <span class="valeur_article">
                            Kephale à 5% sur chaque achat effectuer sur votre boutique.</span>
                        <h4>Montant de l'achat: <span class="valeur_article"> <?php echo $result["montant_paye"]  ?>F CFA</span></h4> 
                        <h4>5% : <span class="valeur_article"> <?php echo $resultat ?>F CFA</span></h4> 
                        <h4>Montant versé: <span class="valeur_article"> <?php echo $montant  ?>F CFA</span></h4> 
    
    
                        <?php
                    }else{
                        if($type_abonnement == 'neutre_electro'){
                            ?>
                            <span class="valeur_article">
                                Kephale à 5% sur chaque achat effectuer sur votre boutique.</span>
                            <h4>Montant de l'achat: <span class="valeur_article"> <?php echo $result["montant_paye"]  ?>F CFA</span></h4> 
                            <h4>5% : <span class="valeur_article"> <?php echo $resultat ?>F CFA</span></h4> 
                            <h4>Montant versé: <span class="valeur_article"> <?php echo $montant  ?>F CFA</span></h4> 
        
        
                            <?php
                        }else{
                            if($type_abonnement == 'neutre_resto'){
                                ?>
                                <span class="valeur_article">
                                    Kephale à 5% sur chaque achat effectuer sur votre boutique.</span>
                                <h4>Montant de l'achat: <span class="valeur_article"> <?php echo $result["montant_paye"]  ?>F CFA</span></h4> 
                                <h4>5% : <span class="valeur_article"> <?php echo $resultat ?>F CFA</span></h4> 
                                <h4>Montant versé: <span class="valeur_article"> <?php echo $montant  ?>F CFA</span></h4> 
            
            
                                <?php
                            }else{
                                if($type_abonnement == 'neutre_voiture'){
                                    ?>
                                    <span class="valeur_article">
                                        Kephale à 5% sur chaque achat effectuer sur votre boutique.</span>
                                    <h4>Montant de l'achat: <span class="valeur_article"> <?php echo $result["montant_paye"]  ?>F CFA</span></h4> 
                                    <h4>5% : <span class="valeur_article"> <?php echo $resultat ?>F CFA</span></h4> 
                                    <h4>Montant versé: <span class="valeur_article"> <?php echo $montant  ?>F CFA</span></h4> 
                
                
                                    <?php
                                }else{
                                    if($type_abonnement == 'neutre_boison'){
                                        ?>
                                        <span class="valeur_article">
                                            Kephale à 5% sur chaque achat effectuer sur votre boutique.</span>
                                        <h4>Montant de l'achat: <span class="valeur_article"> <?php echo $result["montant_paye"]  ?>F CFA</span></h4> 
                                        <h4>5% : <span class="valeur_article"> <?php echo $resultat ?>F CFA</span></h4> 
                                        <h4>Montant versé: <span class="valeur_article"> <?php echo $montant  ?>F CFA</span></h4> 
                    
                    
                                        <?php
                                    }else{
                                        if($type_abonnement == 'neutre_cosmetic'){
                                            ?>
                                            <span class="valeur_article">
                                                Kephale à 5% sur chaque achat effectuer sur votre boutique.</span>
                                            <h4>Montant de l'achat: <span class="valeur_article"> <?php echo $result["montant_paye"]  ?>F CFA</span></h4> 
                                            <h4>5% : <span class="valeur_article"> <?php echo $resultat ?>F CFA</span></h4> 
                                            <h4>Montant verse: <span class="valeur_article"> <?php echo $montant  ?>F CFA</span></h4> 
                        
                        
                                            <?php
                                        }else{
                                         ?>
                                         <h4>Totale : <span class="valeur_article"><?php echo $result["montant_paye"]  ?>F CFA</span></h4> 
                                        <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                                </div>
                <button data-target="<?php echo $cache?>" class="toggle-button masque ">Afficher...</button> 

                </section>
                <?php
                 $liste_achate = $db->prepare("SELECT * FROM temp_annule WHERE temp_article = ?");
                 $liste_achate -> execute(array($result_liste["temp_livraison"])); 
                 $result_liste_achate = $liste_achate->fetch();
                 $etat = $result_liste_achate["etat"];
                 $temp_restant = $result_liste_achate["temp_restant"];
                 $id_boutique = $result["livre"];
                 if($id_boutique == 'nom'){
                    ?>
                     <p style="font-size: 12px ; color: rgb(160, 160, 160); ">Livraisons en coure...</p>
                    <?php
                 }else{
                    if($id_boutique == 'oui'){
                        if( $etat === 'a'){
                            if($temp_restant == 0) {
                                $id_achat = $db->prepare("SELECT * FROM liste_achat WHERE temp_livraison = ?");
                                $id_achat -> execute(array($result_liste["temp_livraison"] )); 
                                $result_id_achat = $id_achat->fetch();
                                ?>
                                <section class="botone_cfrm_sprm">
                           <a href="suprime.php?temp_livraison=<?php echo $result_id_achat["id"]  ?>" style="border: none; background-color: #E94E1B;" class=" bonton_article" >Suprimer de la liste</a>
                           </section>
                                <p style="font-size: 12px ;  color: rgb(160, 160, 160); font-weight: 600; ">Le client est satisfait du service Merci.</p>
                               <?php
                            }else{
                                ?>
                                <p style="font-size: 12px ; color: rgb(160, 160, 160); ">Article Livré</p>
                               <?php
                            }
                         }else{
                            if( $etat === 'b'){
                            ?>
                             <p style="font-size: 12px ; color: #E94E1B; ">L'achat a été annulé par le client.<br>
                             <samp style="color: #6d6d6d;">Vous allez être contacter par le service  <br> de livraison pour déterminer le problème.</samp></p>
                            <?php
                             }else{
                                if( $etat === 'nom'){
                                    ?>
                                     <p style="font-size: 12px ; color: rgb(160, 160, 160); ">L'annulation a été resfusée.</p>
                                    <?php
                                     }else{
                                        if( $etat === 'oui'){
                                            ?>
                                             <p style="font-size: 12px ; color: #E94E1B; ">L'annulation a été validée.</p>
                                            <?php
                                             }else{
                                                if( $etat === 'renbource'){
                                                    ?>
                                                     <p style="font-size: 12px ; color: #E94E1B; ">L'achat a été annulée.</p>
                                                     <p style="font-size: 14px ; color: #E94E1B;  font-weight: 600;">Avertissement</p>
                                                     <p style="font-size: 12px ; color: rgb(160, 160, 160); ">Si vos clients se plaignent une fois de plus <br> votre compte sera suspendut.</p>
                                                    <?php
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