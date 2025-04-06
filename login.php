<?php  require('connect.php'); ?>
<?php  require('fonctions.php'); ?>


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

      if(verifieProfilU($connexion, $email, $password)){
          header("Location: dashboard.php"); // Redirige vers le tableau de bord
          exit();
      } elseif(verifieProfilA($connexion, $email, $password)){
          header("Location: dashboardAdmin.php"); // Redirige vers la page admin
          exit();
      } else {
          header("Location: connexion.php"); // Redirige vers la page de connexion
          exit();
      }

?>