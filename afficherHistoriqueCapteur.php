<?php
require('connect.php'); // ou ton fichier de connexion
require('fonctions.php'); // ou là où est définie afficherHistoriqueCapteur

$connexion = mysqli_connect("p:" . SERVEUR, NOM, PASSE, BD);
if (!$connexion) {
    http_response_code(500);
    echo "Erreur de connexion à la base de données.";
    exit();
}

if (isset($_GET['id'])) {
    $idCapteur = $_GET['id'];
    afficherHistoriqueCapteur($connexion, $idCapteur);
} else {
    echo "Aucun ID de capteur fourni.";
}

?>
