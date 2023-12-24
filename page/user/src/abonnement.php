<?php
session_start();
include_once "../../../kephale_bdd/kephale_bdd.php";
$offre_kephale = $db->prepare("SELECT * FROM offre_kephale  ");
$offre_kephale -> execute(array()); 

$creation_boutique = $db->prepare("SELECT * FROM creation_boutique WHERE id_user = ?  ");
$creation_boutique -> execute(array($_SESSION["id"])); 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/css/style.css">
    <title>Kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;" >
    <a class="lien_icon" href="../user.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
    <section class="section_grand_bloc">
    <h1>Abonnément</h1>
    <?php
    if($creation_boutique->rowCount() > 0 ){
        
        while ($result = $creation_boutique->fetch() ){
        $id_user = $result["id_user"];
        $etat = $result["etat"]; 
        if( $etat == 'oui'){
        $boutique = $db->prepare("SELECT * FROM boutique WHERE id_user = ?  ");
        $boutique -> execute(array($_SESSION["id"])); 
        if($boutique->rowCount() > 0 ){
            header ('Location: mot_de_passe.php' );

        }else{
            while ($result = $offre_kephale->fetch() )
            {
                $nom = $result["nom"];
                $descriptions = $result["descriptions"];
                $montant = $result["montant"];
                $type = $result["type_abon"];
                ?>
                 <section class="section_info">
                    <h1 class="texte_gran_titre"><?php echo $nom?></h1>
                        <h1 class="texte_petit_titre"><?php echo $descriptions?></h1>
                            <h1 class="texte_moien_titre"><?php echo $montant?>F CFA / mois</h1>
                        <a class="lien_bouton" href="paiement.php?boutique=<?php echo $type?>">Achete</a>
                    </section>
                 <?php
            
            }

        }


        }else{
            header ('Location: creations_boutique.php');
        }
        }
       
     }else{
        if($offre_kephale->rowCount() > 0 ){
            while ($result = $offre_kephale->fetch() )
        {
            $nom = $result["nom"];
            $descriptions = $result["descriptions"];
            $montant = $result["montant"];
            $type = $result["type_abon"];
            ?>
             <section class="section_info">
                <h1 class="texte_gran_titre"><?php echo $nom?></h1>
                    <h1 class="texte_petit_titre"><?php echo $descriptions?></h1>
                        <h1 class="texte_moien_titre"><?php echo $montant?>F CFA / mois</h1>
                    <a class="lien_bouton" href="creations_boutique.php?boutique=<?php echo $type?>">Faire une demande</a>
                </section>
             <?php
        
        }
            }

     }
        ?>
    </section>
</body>
</html>