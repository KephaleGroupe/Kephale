<?php
session_start();
include_once "../../../../../../kephale_bdd/kephale_bdd.php";
$id_produit = $_GET["id_produit"];

$req_produite = $db->prepare("SELECT * FROM produits WHERE id = ?" );
$req_produite-> execute(array($id_produit));
$resulte_produit = $req_produite->rowCount();

$req_produit = $db->prepare("SELECT * FROM produits WHERE id = ?" );
$req_produit-> execute(array($id_produit));
$resulte_req_produit = $req_produit->rowCount();

$req_article = $db->prepare("SELECT * FROM articles WHERE id_produit = ?" );
$req_article-> execute(array($id_produit));
$resulte_req_article = $req_article->rowCount();


$req_les_article = $db->prepare("SELECT * FROM les_articles WHERE id_produit = ?" );
$req_les_article-> execute(array($id_produit));
$resulte_req_les_article = $req_les_article->rowCount();

if(isset($_POST["suprime_produit"])){
    if($resulte_req_les_article > 0 ){
        while($result_les_article = $req_les_article->fetch(PDO::FETCH_ASSOC)){
            $result_les_article["id_produit"];
            $result_les_article["img_articles"];    
            if($id_produit == $result_les_article["id_produit"]){
                $img_direction_les_article = "../img_les_articles/";
                $img_exists_les_article = $result_les_article["img_articles"];
                $img_suprime_les_article = $img_direction_les_article . $img_exists_les_article;
                if (file_exists($img_suprime_les_article)){
                    unlink($img_suprime_les_article);
                    $surprime_les_article = $db->prepare("DELETE FROM les_articles WHERE id_produit = ?" );
                    $surprime_les_article-> execute(array($result_les_article["id_produit"]));

                    if($resulte_req_article  > 0 ){
                        while($result_article = $req_article->fetch(PDO::FETCH_ASSOC)){
                            $result_article["id_produit"];
                            $result_article["img_article"];
                            if($_GET["id_produit"] == $result_article["id_produit"]){
                                $img_direction_article = "../img_article/";
                                $img_exists_article = $result_article["img_article"];
                                $img_suprime_article = $img_direction_article . $img_exists_article;
                                if (file_exists($img_suprime_article)){
                                    unlink($img_suprime_article);
                                    $surprime_article = $db->prepare("DELETE FROM articles WHERE id_produit = ?" );
                                    $surprime_article-> execute(array($result_article["id_produit"]));

                                    if($resulte_req_produit   > 0 ){
                                        while($result_produit = $req_produit->fetch(PDO::FETCH_ASSOC)){
                                            $result_produit["id"];
                                            if($_GET["id_produit"] == $result_produit["id"]){
                                                $img_direction_produit = "../img_produit/";
                                                $img_exists_produit = $result_produit["img_produit"];
                                                $img_suprime_produit = $img_direction_produit . $img_exists_produit;
                                                if(file_exists($img_suprime_produit)){
                                                    unlink($img_suprime_produit);
                                                    $surprime_produit = $db->prepare("DELETE FROM produits WHERE id = ?" );
                                                    $surprime_produit-> execute(array( $result_produit["id"]));
                                                    header ('Location: ../../grand.php');

                                                }//Verifie si l'image egiste 
                                            }//Verifie si le d'id du produit corespond
                                        }//conversion produit en fetch
                                    }//Verifie si le produit existe


                                }//Verifie si l'image egiste 
                            }//Verifie si le d'id de l'article corespond
                        }//conversion l'article en fetch
                    }//Verifie si l'article existe
                    else{
                        if($resulte_req_produit   > 0 ){
                            while($result_produit = $req_produit->fetch(PDO::FETCH_ASSOC)){
                                $result_produit["id"];
                                if($_GET["id_produit"] == $result_produit["id"]){
                                    $img_direction_produit = "../img_produit/";
                                    $img_exists_produit = $result_produit["img_produit"];
                                    $img_suprime_produit = $img_direction_produit . $img_exists_produit;
                                    if(file_exists($img_suprime_produit)){
                                        unlink($img_suprime_produit);
                                        $surprime_produit = $db->prepare("DELETE FROM produits WHERE id = ?" );
                                        $surprime_produit-> execute(array( $result_produit["id"]));
                                        header ('Location: ../../grand.php');

                                    }//Verifie si l'image egiste 
                                }//Verifie si le d'id du produit corespond
                            }//conversion produit en fetch
                        }//Verifie si le produit existe
                    }
                   


                }//Verifie si l'image egiste 
            }//Verifie si le d'id du produit corespond
        }//conversion de les article en fetch
    }//Verifie si les l'article existe
    else{
        if($resulte_req_article  > 0 ){
            while($result_article = $req_article->fetch(PDO::FETCH_ASSOC)){
                $result_article["id_produit"];
                $result_article["img_article"];
                if($_GET["id_produit"] == $result_article["id_produit"]){
                    $img_direction_article = "../img_article/";
                     $img_exists_article = $result_article["img_article"];
                    $img_suprime_article = $img_direction_article . $img_exists_article;
                    if (file_exists($img_suprime_article)){
                        unlink($img_suprime_article);
                        $surprime_article = $db->prepare("DELETE FROM articles WHERE id_produit = ?" );
                        $surprime_article-> execute(array($result_article["id_produit"]));

                        if($resulte_req_produit   > 0 ){
                            while($result_produit = $req_produit->fetch(PDO::FETCH_ASSOC)){
                                $result_produit["id"];
                                if($_GET["id_produit"] == $result_produit["id"]){
                                    $img_direction_produit = "../img_produit/";
                                    $img_exists_produit = $result_produit["img_produit"];
                                    $img_suprime_produit = $img_direction_produit . $img_exists_produit;
                                    if(file_exists($img_suprime_produit)){
                                        unlink($img_suprime_produit);
                                        $surprime_produit = $db->prepare("DELETE FROM produits WHERE id = ?" );
                                        $surprime_produit-> execute(array( $result_produit["id"]));
                                        header ('Location: ../../grand.php');

                                    }//Verifie si l'image egiste 
                                }//Verifie si le d'id du produit corespond
                            }//conversion produit en fetch
                        }//Verifie si le produit existe


                    }//Verifie si l'image egiste 
                }//Verifie si le d'id de l'article corespond
            }//conversion de les article en fetch
        }//Verifie si les l'article existe
        else{
            if($resulte_req_produit   > 0 ){
                while($result_produit = $req_produit->fetch(PDO::FETCH_ASSOC)){
                    $result_produit["id"];
                    if($_GET["id_produit"] == $result_produit["id"]){
                        $img_direction_produit = "../img_produit/";
                        $img_exists_produit = $result_produit["img_produit"];
                        $img_suprime_produit = $img_direction_produit . $img_exists_produit;
                        if(file_exists($img_suprime_produit)){
                            unlink($img_suprime_produit);
                            $surprime_produit = $db->prepare("DELETE FROM produits WHERE id = ?" );
                            $surprime_produit-> execute(array( $result_produit["id"]));
                            header ('Location: ../../grand.php');

                        }//Verifie si l'image egiste 
                    }//Verifie si le d'id du produit corespond
                }//conversion produit en fetch
            }//Verifie si le produit existe
        }
    }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../../../css/css/style.css">

    <title>Supretion</title>
</head>
<body>
<?php
if($resulte_produit > 0 ){
    while($produite = $req_produite->fetch(PDO::FETCH_ASSOC)){
        ?>
        <section class="section_input">
        <a class="lien_icon" href="../../grand.php">
        <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../../media/icone/retoure.svg" alt="">
        </a>
        <h1 class="texte_petit_titre texte_alert" >Comfirme la Supresion de<br> "<?php echo $produite["nom_produit"]; ?>" </h1>
            <form class="section_form" method="POST" enctype="multipart/form-data">
                <input class="form_input_botone submit alerte_supresion" type="submit" value="Supprimer" name="suprime_produit">
            </form>
    
        </section>
        <?php
    }    
}
?>

</body>
</html>