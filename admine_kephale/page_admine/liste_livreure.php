<?php
$liste_achat = $db->query("SELECT * FROM admine WHERE fonctions LIKE 'livreur'");


?>
<section class="class_un">
    <h1 class="texte_liste ou_ac">Liste livreur</h1>
    <section class="block_livreur"> 

        <?php
        if($liste_achat->rowCount() > 0 ){
            while ($result = $liste_achat->fetch()){
                $nom_livreur = $result["nom"];
                $id_livreur = $result["id"];
                $info_achat = $db->prepare("SELECT * FROM livraisons WHERE livraire = ? AND livre LIKE 'non' ");
                $info_achat -> execute(array($id_livreur)); 
                $result_info_achat = $info_achat->rowCount();
                ?>

        <h1 style="text-align: center;"><?php echo $nom_livreur?> (<?php echo $info_achat->rowCount()?>) livraison en charge</h1>
                <?php
                if($info_achat->rowCount() > 0 ){
                    while ($result = $info_achat->fetch()){
                        $id_article = $result["id_article"];
                        $id_user = $result["id_user"];

                        $info_user = $db->prepare("SELECT * FROM user WHERE id = ? ");
                        $info_user -> execute(array($id_user)); 
                        $result_info_user = $info_user->fetch();
                        $nom_user = $result_info_user["nom"];
                        
                        $info_article = $db->prepare("SELECT * FROM les_articles WHERE id = ? ");
                        $info_article -> execute(array($id_article)); 
                        $result_info_article = $info_article->fetch();
                        $id_produit = $result_info_article["id_produit"];
                
                        $info_produit = $db->prepare("SELECT * FROM produits WHERE id = ? ");
                        $info_produit -> execute(array($id_produit)); 
                        $result_info_produit = $info_produit->fetch();
                        $id_boutique = $result_info_produit["id_boutique"];
                
                        $info_boutique = $db->prepare("SELECT * FROM boutique WHERE id = ? ");
                        $info_boutique -> execute(array($id_boutique)); 
                        $result_info_boutique = $info_boutique->fetch();
                        $id_boutique = $result_info_boutique["id_boutique"];
                
                        $localite = $db->prepare("SELECT * FROM localisation WHERE id_user = ? ");
                        $localite -> execute(array($id_user)); 
                        $result_localite = $localite->fetch();
                        $local = $result_localite["localite"];
                        ?>
                      
                       <section class="info_usere"> 
                       <img style="width: 40px; border-radius: 100px;" class="img_usere" src="../page/conct_inscrt/img_profile_user/<?php echo $result_info_user["img_profile"]?>" alt="">
                       <h1 class="texte_limite"><?php echo $result_info_user["nom"]?></h1>
                       <section class="info_usere"> 
                       <h4 class="class_ddd">Localite: <span class="valeur_article"><?php echo $local?></span></h4>
                       <h4 class="class_ddd">Boutique: <span class="valeur_article"><?php echo $result_boutique["nom_boutique"]?></span></h4>
                       </section>
                       </section>
                       
                       <?php
                    }
                }
                

                
                
            }
        }
         ?>
                        </section>
   

    </section>