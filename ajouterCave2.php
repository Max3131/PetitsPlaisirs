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
$typeCave = $_POST['wineType'];

$typeU = redirigerCreaCave($connexion, $_SESSION['email']);
if ($typeU == "Client") {
/*$to = "afonsomontes@live.com.pt";
$subject = "Demande d'ajout de cave";
$message = "$email a demandé l'ajout d'une cave avec les informations suivantes :\n" .
           "Nom de la cave : $nomCave\n" .
           "Adresse : $adresse\n" .
           "Code Postal : $codePostal\n" .
           "Ville : $ville\n" .
           "Volume : $volume\n" .
           "Type de vin : $typeVin\n";
$headers = "From: tonemail@example.com\r\n" .
           "Reply-To: tonemail@example.com\r\n" .
           "Content-Type: text/plain; charset=utf-8\r\n";
if (mail($to, $subject, $message, $headers)) {*/
    $_SESSION['message']=  "Demande envoyée avec succès.";
    header("Location: ajouterCave.php"); // Redirige vers le menu
    exit();
/*} else {
    echo "Échec de la demande";
}*/}
else {


$idClient = recupererIdClient($connexion, $email, $dateN);
if (!$idClient) {
    $_SESSION['message'] = "Erreur : Client non trouvé.";
    header("Location: ajouterCave.php"); // Redirige vers la page d'ajout de cave
    exit();
}

if(ajouterCave($connexion, $idClient, $nomCave, $adresse, $codePostal, $ville, $volume, $typeCave)){
    $_SESSION['message'] = "Cave ajoutée avec succès.";
} else {
    $_SESSION['message'] = "Erreur lors de la mise à jour des informations.";
}
header("Location: ajouterCave.php"); // Redirige vers la page de d'ajout de cave
exit(); // Ajoutez exit() après la redirection
}

?>

