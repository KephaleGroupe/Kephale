<?php
session_start();
include_once "../../../../../../kephale_bdd/kephale_bdd.php";
$id_article = $_GET["id_article"];
$id_produit = $_GET["id_produit"];

$req_articl = $db->prepare("SELECT * FROM articles WHERE id = ?" );
$req_articl-> execute(array($id_article));
$resulte_req_articl = $req_articl->rowCount();

$req_article = $db->prepare("SELECT * FROM articles WHERE id = ?" );
$req_article-> execute(array($id_article));
$resulte_req_article = $req_article->rowCount();


$req_les_article = $db->prepare("SELECT * FROM les_articles WHERE id_article = ?" );
$req_les_article-> execute(array($id_article));
$resulte_req_les_article = $req_les_article->rowCount();

if(isset($_POST["suprime_article"])){
    if($resulte_req_les_article > 0 ){
        while($result_les_article = $req_les_article->fetch(PDO::FETCH_ASSOC)){
            $result_les_article["id_article"];
            $result_les_article["img_articles"];    
            if($id_article == $result_les_article["id_article"]){
                $img_direction_les_article = "../img_les_articles/";
                $img_exists_les_article = $result_les_article["img_articles"];
                $img_suprime_les_article = $img_direction_les_article . $img_exists_les_article;
                if (file_exists($img_suprime_les_article)){
                    unlink($img_suprime_les_article);
                    $surprime_les_article = $db->prepare("DELETE FROM les_articles WHERE id_produit = ?" );
                    $surprime_les_article-> execute(array($result_les_article["id_produit"]));

                    if($resulte_req_article  > 0 ){
                        while($result_article = $req_article->fetch(PDO::FETCH_ASSOC)){
                            $result_article["id"];
                            $result_article["img_article"];
                            if($_GET["id_article"] == $result_article["id"]){
                                $img_direction_article = "../img_article/";
                                $img_exists_article = $result_article["img_article"];
                                $img_suprime_article = $img_direction_article . $img_exists_article;
                                if (file_exists($img_suprime_article)){
                                    unlink($img_suprime_article);
                                    $surprime_article = $db->prepare("DELETE FROM articles WHERE id = ?" );
                                    $surprime_article-> execute(array($result_article["id"]));
                                    header ('Location: ../article.php?id_produit='.$result_article["id_produit"]);

                                }//Verifie si l'image egiste 
                            }//Verifie si le d'id de l'article corespond
                            else{
                                echo 'Proble id_article';
                            }
                        }//conversion l'article en fetch
                    }//Verifie si l'article existe                   


                }//Verifie si l'image egiste 
            }//Verifie si le d'id du produit corespond
            else{
                echo' Probleme id_les_article';
            }
        }//conversion de les article en fetch
    }//Verifie si les l'article existe
    else{
        if($resulte_req_article  > 0 ){
            while($result_article = $req_article->fetch(PDO::FETCH_ASSOC)){
                $result_article["id"];
                $result_article["img_article"];
                if($_GET["id_article"] == $result_article["id"]){
                    $img_direction_article = "../img_article/";
                     $img_exists_article = $result_article["img_article"];
                    $img_suprime_article = $img_direction_article . $img_exists_article;
                    if (file_exists($img_suprime_article)){
                        unlink($img_suprime_article);
                        $surprime_article = $db->prepare("DELETE FROM articles WHERE id = ?" );
                        $surprime_article-> execute(array($result_article["id"]));
                        header ('Location: ../article.php?id_produit='.$id_produit);
                    }//Verifie si l'image egiste 
                }//Verifie si le d'id de l'article corespond
            }//conversion de les article en fetch
        }//Verifie si les l'article existe
        
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
if($resulte_req_articl > 0 ){
    while($article = $req_articl->fetch(PDO::FETCH_ASSOC)){
        ?>
        <section class="section_input">
        <a class="lien_icon" href="../article.php?id_produit=<?php echo $id_produit ?>">
        <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../../../media/icone/retoure.svg" alt="">
        </a>
        <h1 class="texte_petit_titre texte_alert" >Vouller vous Supprimer <br> "<?php echo $article["nom_article"]; ?>" </h1>
            <form class="section_form" method="POST" enctype="multipart/form-data">
                <input class="form_input_botone submit alerte_supresion" type="submit" value="Supprimer" name="suprime_article">
            </form>
    
        </section>
        <?php
    }    
}
?>

</body>
</html>