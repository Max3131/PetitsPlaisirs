<?php
require('connect.php'); 
require('fonctions.php'); 

session_start(); // Ajoutez cette ligne pour démarrer la session

// Connexion à la base de données
$connexion = mysqli_connect("p:".SERVEUR, NOM, PASSE, BD);
if (!$connexion) {
    $_SESSION['message'] = "Problème : Connexion au serveur ou à la base de données impossible.";
    header("Location: connexion.php");
    exit();
}

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$date_naissance = $_POST['date_naissance'];
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$code_postal = $_POST['code_postal'];
$email = $_SESSION['email'];

if(modifInfoClient($connexion, $prenom, $nom, $date_naissance, $adresse, $ville, $code_postal, $email)){
    $_SESSION['message'] = "Informations mises à jour avec succès.";
} else {
    $_SESSION['message'] = "Erreur lors de la mise à jour des informations.";
}
header("Location: modifAccount.php"); // Redirige vers la page de modification de compte
exit(); // Ajoutez exit() après la redirection
?>