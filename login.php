<?php  require('connect.php'); ?>
<?php  require('fonctions.php'); ?>
<?php session_start(); // Démarre la session pour utiliser les variables de session ?>

 <?php 

      
      $connexion = mysqli_connect("p:".SERVEUR, NOM, PASSE,BD);
      if (!$connexion)
        {
            //echo "<p>Problème : Connexion au serveur ".SERVEUR." ou à la base ".BD." impossible. <br/> Erreur : ".mysqli_error()."</p>";
            $_SESSION['message'] = "Problème : Connexion au serveur ou à la base de données impossible.";
            header("Location: connexion.php"); // Redirige vers la page de connexion
            exit();
        }

      $email = $_POST["email"];
      $password = $_POST["password"];

      verifieProfil($connexion, $email, $password);

?>