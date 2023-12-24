<?php
session_start();
include_once "../kephale_bdd/kephale_bdd.php";
$_SESSION['id_admine'];
$req_user = $db->prepare ("SELECT * FROM admine WHERE id = ? ");
$req_user -> execute([$_SESSION['id_admine']]); 
$exist_user = $req_user -> fetch(PDO::FETCH_ASSOC); 
$fonctions = $exist_user['fonctions'];

$directeur = 'directeur';
$contable = 'contable';
$chef_livreur = 'chef_livreur';
$livreur = 'livreur';
$livreur = 'livreur';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css/style.css">
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
    <title>kephale</title>
</head>
<body>
    <h1>Kepahe</h1>
    <section class="class_buton">
        <section class="bton_t">
        <a class="class_buto" href="">bouton</a>
        </section>
        <section class="deconecte">
        <a class="class_buto alecte" href="">Déconnection</a>
        </section>
    </section>
<?php
include_once "page_admine/liste_commande.php";
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