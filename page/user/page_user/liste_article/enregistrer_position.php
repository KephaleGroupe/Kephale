<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $id_user = $_SESSION['id'];
    $id_article = $_SESSION["id_article"];
    $id_boutique = $_SESSION["id_boutique"];
    $req_localisation = $db->prepare ("SELECT * FROM localisation WHERE id_user = ?"); 
    $req_localisation -> execute(array($id_user));
    $req_localisation_existe = $req_localisation -> rowCount(); 

    if($req_localisation_existe > 0 ){
        $inser_localisation = $db->prepare("UPDATE localisation SET id_user = ?, id_article = ?, id_boutique = ?, latitude = ?, longitude = ?  WHERE id_user = ?");
        $inser_localisation -> execute(array($id_user, $id_article, $id_boutique, $latitude, $longitude, $id_user ));
        echo 'Lieu de livraison actualise';
    }else{
        $inser_localisation = $db->prepare("INSERT INTO localisation (id_user, id_article, id_boutique, latitude, longitude) VALUES (?,?,?,?,?)");
        $inser_localisation -> execute(array($id_user, $id_article, $id_boutique, $latitude, $longitude ));
        echo 'Lieu de livraison trouve!';
    }
    // Enregistrez la position dans un fichier ou une base de données (c'est un exemple basique)

    



    // Répondez avec la position enregistrée
}



?>