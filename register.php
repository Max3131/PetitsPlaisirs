<?php  
require('connect.php'); 
require('fonctions.php'); 

session_start(); // Démarre la session pour utiliser les variables de session

// Connexion à la base de données  
$connexion = mysqli_connect("p:".SERVEUR, NOM, PASSE, BD);
if (!$connexion) {
    // Message d'erreur si la connexion échoue
    $_SESSION['message'] = "Problème : Connexion au serveur ou à la base de données impossible.";
    header("Location: connexion.php"); // Redirige vers la page de connexion
    exit();
}

// Récupération des données du formulaire
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$date_naissance = $_POST['date_naissance'];
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$code_postal = $_POST['code_postal'];
$email = $_POST['email'];
$password = $_POST['password'];

// Appel de la fonction pour créer le profil
/*if (!creationProfil($connexion, $prenom, $nom, $date_naissance, $adresse, $ville, $code_postal, $email, $password)) {
    // Affiche une erreur si la création du profil échoue
    die("Erreur lors de la création du profil : " . mysqli_error($connexion));
}*/
if (creationProfil($connexion, $prenom, $nom, $date_naissance, $adresse, $ville, $code_postal, $email, $password)) {
    // Si la création du profil réussit, on redirige vers le tableau de bord
    header("Location: dashboard.php");
} else {
    // Si la création échoue, on affiche un message d'erreur
    $_SESSION['message'] = 'Erreur lors de la création du profil.';
    header("Location: register.php"); // Redirige vers la page d'inscription
}
// Ferme la connexion à la base de données
?>