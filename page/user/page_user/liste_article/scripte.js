

        document.getElementById('shareLocation').addEventListener('click', function() {
            // Demander la permission d'accéder à la géolocalisation
            document.getElementById('resultate').innerHTML = "Localication en coure...";
            if ("geolocation" in navigator) {
                document.getElementById('resultate').innerHTML = "Localication en coure...";
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    // Affichez la latitude et la longitude
                    
                    // Effectuez une requête Ajax pour envoyer ces données au script PHP
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'enregistrer_position.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send("latitude=" + latitude + "&longitude=" + longitude);

                    // Réception de la réponse du serveur
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var reponse = xhr.responseText;
                            document.getElementById('resultate').innerHTML = reponse;
                        }
                    };
                });
            } else {
                document.getElementById('resultate').innerHTML = "La géolocalisation n'est pas prise en charge par votre navigateur.";
            }
        });
