<?php
session_start();
include_once "../../../../kephale_bdd/kephale_bdd.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../css/css/style.css">
    <title>kephale</title>
</head>
<body>
<section class="section_retour">
    <section style="position: fixed;">
    <a class="lien_icon" href="../../user.php">
    <img style="width: 25px; height: 25px;" class="icon_menu" src="../../../../media/icone/retoure.svg" alt="">
    </a>
    </section>
 </section>
    <section class="bloc_botone">
    <a class="bouton" href="">Modifier mon profil</a>
    <a class="bouton" href="">Historique d'achat</a>
    <a class="bouton rouge" href="deconnection/deconnections.php">Déconecte</a>
   
    </section>
</body>
</html>