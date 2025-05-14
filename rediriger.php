<?php
require_once 'connexion.php';     // Connexion à la base de données
require_once 'fonctions.php';     // Contient la fonction dirigerMenu()
      $connexion = mysqli_connect("p:".SERVEUR, NOM, PASSE,BD);

if (isset($_SESSION['email'])) {
    dirigerMenu($connexion, $_SESSION['email']);
} 
?>
