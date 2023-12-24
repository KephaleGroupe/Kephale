<?php
$liste_achat = $db->query("SELECT * FROM liste_achat WHERE livre LIKE 'non' ORDER BY id DESC ");
?>
<section class="bloc_troix">
    <section class="class_un">
    <h1 class="texte_liste non_ac">Liste achat non livre (<?php echo $liste_achat->rowCount()?>)</h1>
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

        $rec_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
        $rec_user -> execute(array($id_user)); 
        $result_rec_user = $rec_user->fetch();

        $localite = $db->prepare("SELECT * FROM localisation WHERE id_user = ? ");
        $localite -> execute(array($id_user)); 
        $result_localite = $localite->rowCount();

        $rec_article = $db->prepare("SELECT * FROM les_articles WHERE id = ? ");
        $rec_article -> execute(array($id_article)); 
        $result_article= $rec_article->fetch();

        $rec_boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
        $rec_boutique -> execute(array($id_boutique)); 
        $result_boutique = $rec_boutique->fetch();

        $info_achat = $db->prepare("SELECT * FROM liste_achat WHERE id_article = ? ");
        $info_achat -> execute(array($id_article)); 
        $result_info_achat = $info_achat->fetch();

        $liste = $db->prepare("SELECT * FROM liste_achat WHERE temp_livraison = ?");
        $liste -> execute(array($result["temp_livraison"] )); 
        $result_liste = $liste->fetch();
        $cache = $result_liste["temp_livraison"] + 22;

        $temp_achat = $db->prepare("SELECT * FROM livraisons WHERE temp_achat = ?");
        $temp_achat -> execute(array($result_liste["temp_livraison"])); 
        $result_temp_achat = $temp_achat->rowCount();
        ?> 
       
       <section class="boc_articl_commende">
            <img class="img_article" src="../page/user/src/boutique/article/img_les_articles/<?php echo $result_article["img_articles"]?>" alt="">
            <section class="info_article_commande">
                <section class="texte_article colome">
                <section class="info_prix">
                <h4>Nom du client: <span class="valeur_article"><?php echo $result_rec_user["nom"]?></span></h4>
                <h4>Numereaux: <span class="valeur_article"> (+223) <?php echo $result_rec_user["telephone"]?></span></h4>
                <?php 
                if($localite->rowCount() > 0 ){
                    while ($result_result_localite = $localite->fetch()){
                        ?>
                <h4>Localite: <span class="valeur_article"><?php echo $result_result_localite["localite"]?></span></h4>
                        <?php 
                    }
                }else{
                    ?>
                <h4>Localite: <span class="valeur_article">indisponible</span></h4>
                        <?php 
                }
                    
                ?>
                <h4>Nom de l'article: <span class="valeur_article"><?php echo $result_article["nom_articles"]?></span></h4>
                <?php
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
                <div data-toggle = "<?php echo $cache?>" class="content hidden" > 
                <h4>Prix de l'article: <span class="valeur_article"><?php echo $result_article["prix_articles"]?>F CFA</span></h4>
                <h4>Boutique: <span class="valeur_article"><?php echo $result_boutique["nom_boutique"]?></span></h4>
                <h4>Quantite: <span class="valeur_article"><?php echo $result_info_achat["quantite_article"] ?></span></h4>
                <h4>Taille: <span class="valeur_article"><?php echo $result_info_achat["taille_article"]  ?></span></h4>
                <h4>Description: <span class="valeur_article"><?php echo $result_article["descriptions_articles"]  ?></span></h4>
                <h4>Totale : <span class="valeur_article"><?php echo $result_info_achat["montant_paye"]  ?>F CFA</span></h4>
                </div>
 <button data-target="<?php echo $cache?>" class="toggle-button masque ">Afficher...</button> 

 <?php 
  $req_frait = $db->prepare ("SELECT * FROM livraisons WHERE temp_achat = ?");
  $req_frait -> execute([$temp_livraison]); 
  if($req_frait->rowCount() > 0 ){

  }else{
    if(isset($_POST["$id"])){
        $frait = htmlspecialchars($_POST["frait"]);
        $livreur = htmlspecialchars($_POST["fonction"]);
        if(isset($_POST ["frait"]) AND !empty($_POST ["frait"])){
            if(isset($_POST ["fonction"]) AND !empty($_POST ["fonction"])){
                $livre = 'non';
                $inser_user = $db->prepare("INSERT INTO livraisons ( id_article, id_user, livraire, frait, temp_achat, livre) VALUES (?,?,?,?,?,?)");
                $inser_user -> execute(array($id_article, $id_user, $livreur, $frait, $temp_livraison, $livre));
                header ('Location: index.php');

            }else{
                $erreur = 'Precise le livreure';
            }

        }else{
            $erreur = 'Donne le frait de livraisont.';
        }
    }
    ?>
     <form style="width: 300px;" class="section_form" method="POST" enctype="multipart/form-data">
 <p style="font-size: 12px;">Frait de livraison</p>
            <input style="padding: 10px 30px;" class="form_input" type="number" placeholder="0.0f cfa" name="frait" value="<?php if(isset($frait)) {echo $frait;} ?>">
            <p style="font-size: 12px;">Sélectionne le livraire</p>
            <select style="margin-bottom: 10px;" name="fonction">
                    <option value="">Sélectionne</option>
                    <?php
                    $liste_livreur = $db->query("SELECT * FROM admine WHERE fonctions LIKE 'livreur' ");
                    if($liste_livreur->rowCount() > 0 ){
                        while ($result_liste_livreur = $liste_livreur->fetch() ){
                            $nom_livreur = $result_liste_livreur["nom"];
                            $id_livreur = $result_liste_livreur["id"];
                            $fonctions = $result_liste_livreur["fonctions"];
                            ?>
                            <option value="<?php echo $id_livreur?>"><?php echo $nom_livreur?></option>
                              <?php
                        }
                    }
                     ?>
                </select>
            <input style="padding: 10px 30px;" class="form_input_botone" class="submit" type="submit" value="Commexion" name="<?php echo $id ?>">
        </form>
        <?php
                    if(isset ($erreur)){
                        ?>
                        <h1 class="texte_minime texte_alert " ><?php echo $erreur ?></h1>
                        <?php
                    }
                    ?>
     <?php 
  }
 
 ?>
                </section>
                </section>
                </section>
                </section>
         <?php

    }
}
        
         ?>
    
    </section>



    <section class="class_un">
    <h1 class="texte_liste oui_ac">Liste achat livre (0)</h1>

    </section>

    <?php
include_once "liste_livreure.php";

         ?>  
</section>







