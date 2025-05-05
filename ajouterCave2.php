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

// Récupération des données du formulaire
$email = $_POST['email'];
$dateN = $_POST['DateN'];
$nomCave = $_POST['NomCave'];
$adresse = $_POST['Adresse'];
$codePostal = $_POST['CodePostal'];
$ville = $_POST['Ville'];
$volume = $_POST['volume'];
$typeVin = $_POST['wineType'];

$idClient = recupererIdClient($connexion, $email, $dateN);
if (!$idClient) {
    $_SESSION['message'] = "Erreur : Client non trouvé.";
    header("Location: ajouterCave.php"); // Redirige vers la page d'ajout de cave
    exit();
}

if(ajouterCave($connexion, $idClient, $nomCave, $adresse, $codePostal, $ville, $volume, $typeVin)){
    $_SESSION['message'] = "Cave ajoutée avec succès.";
} else {
    $_SESSION['message'] = "Erreur lors de la mise à jour des informations.";
}
header("Location: ajouterCave.php"); // Redirige vers la page de d'ajout de cave
exit(); // Ajoutez exit() après la redirection
?>

