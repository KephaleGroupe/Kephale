<?php
$liste_commende = $db->prepare("SELECT * FROM article_commande WHERE id_article = ? ");
$liste_commende -> execute(array($_SESSION["id"])); 



?>