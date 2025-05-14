<?php
require('connect.php');
require('fonctions.php');

$connexion = mysqli_connect("p:".SERVEUR, NOM, PASSE, BD);
if (!$connexion) {
  $_SESSION['message'] = "Problème : Connexion au serveur ou à la base de données impossible.";
  header("Location: connexion.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCapteur = $_POST['idCapteur'];
    $valeur = $_POST['valeur'];

    
    if (MAJChoixUtilisateur($connexion, $idCapteur, $valeur)) {
        $_SESSION['message'] = "Valeur mise à jour avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de la mise à jour de la valeur.";
    }
}
?>