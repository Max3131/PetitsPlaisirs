<?php
// Fonction permettant de vérifier si le login (email) et le mot de passe (password) entrés par l'utilisateur sont corrects.
// Si oui on redirige vers index.php en prenant garde à remplir la variable de session avec le email
// Si non on redirige vers la page de login
function verifieProfil($connexion, $email, $password){


    // à compléter
    $query = "select * from client where EmailCli = '".$email."' and MdpCli = '".$password."'";

    $resultat =  mysqli_query($connexion,$query);


    // à compléter, ci dessous des bouts de code pour vous aider

    if ($resultat && mysqli_num_rows($resultat)==1)
    {// Si l'utilisateur est bien logué, on initialise la session et on redirige vers index.php //
      session_start();
      $row = mysqli_fetch_assoc($resultat); // Récupérer la ligne de résultat
      $_SESSION['nom'] = $row['NomCli']; // Stocker le nom d'utilisateur dans la session
      $_SESSION['prenom'] = $row['PrenomCli']; // Stocker le prénom d'utilisateur dans la session
      $_SESSION['email']=$email;
      $_SESSION['message']='';
      header("Location:dashboard.php");
      exit();
    }
    elseif($resultat && mysqli_num_rows($resultat)!=1)
    {
    //sinon on redirige de nouveau vers la page d'index avec un message d'erreur

    session_start();
    $_SESSION['message']='Login ou mot de passe incorrect';
    header("Location:connexion.php");
    exit();
    }
    // N'oubliez pas de gérer les cas de mauvaise connexion à la base, d'erreur dans la requête, ...
    else
    {
      echo "<p>Erreur dans l\'exécution de la requête.<br>";
        echo $query;
        echo "Message du serveur de base de données : ".mysqli_error($connexion);
    } 
}

function creationProfil($connexion, $prenom, $nom, $date_naissance, $adresse, $ville, $code_postal, ,$email, $password){


    // à compléter
    $query = "insert into client (NomCli, PrenomCli, DateNaissanceCli, AdresseCli, VilleCli, CodePostalCli, EmailCli, MdpCli) values ('".$nom."', '".$prenom."', '".$date_naissance."', '".$adresse."', '".$ville."', '".$code_postal."', '".$email."', '".$password."')";

    $resultat =  mysqli_query($connexion,$query);


    // à compléter, ci dessous des bouts de code pour vous aider

    if ($resultat && mysqli_affected_rows($connexion)==1)
    {// Si l'utilisateur est bien logué, on initialise la session et on redirige vers index.php //
      session_start();
      $_SESSION['nom'] = $nom; // Stocker le nom d'utilisateur dans la session
      $_SESSION['prenom'] = $prenom; // Stocker le prénom d'utilisateur dans la session
      $_SESSION['email']=$email;
      $_SESSION['message']='';
      header("Location:dashboard.php");
      exit();
    }
    {// Si l'utilisateur est bien logué, on initialise la session et on redirige vers index.php //
      session_start();
      $_SESSION['email']=$email;
      $_SESSION['message']='';
      header("Location:index.php");
      exit();
    }
    elseif($resultat && mysqli_num_rows($resultat)!=1)
    {
    //sinon on redirige de nouveau vers la page d'index avec un message d'erreur

    session_start();
    $_SESSION['message']='Login ou mot de passe incorrect';
    header("Location:connexion.php");
    }
    // N'oubliez pas de gérer les cas de mauvaise connexion à la base, d'erreur dans la requête, ...
    else
    {
      echo "<p>Erreur dans l\'exécution de la requête.<br>";
        echo $query;
        echo "Message du serveur de base de données : ".mysqli_error($connexion);
    } 
}
?>