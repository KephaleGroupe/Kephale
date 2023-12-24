<?php
    $start_time = time();
    $_SESSION['end_time'] = $start_time;

    $getabonnement= 'neutre_boison';
    $inserSolde = $db->prepare("UPDATE user SET temp_abonement = ?, boutique_user = ? WHERE id = ? ");
    $inserSolde -> execute(array($_SESSION['end_time'], $getabonnement,  $_SESSION["id"]));
    $resultSode = $inserSolde->fetch(); 
 
    header ('Location: creation_boutique.php');