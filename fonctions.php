<?php
// Fonction permettant de vérifier si le login (email) et le mot de passe (password) entrés par l'utilisateur sont corrects.
// Si oui on redirige vers index.php en prenant garde à remplir la variable de session avec le email
// Si non on redirige vers la page de login
function verifieProfilU($connexion, $email, $password){

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
      return true; // Connexion réussie
    }
    elseif($resultat && mysqli_num_rows($resultat)!=1)
    {
    //sinon on redirige de nouveau vers la page d'index avec un message d'erreur
    session_start();
    $_SESSION['message']='Login ou mot de passe incorrect';
    return false; // Connexion échouée
    }
    // N'oubliez pas de gérer les cas de mauvaise connexion à la base, d'erreur dans la requête, ...
    else
    {
      echo "<p>Erreur dans l\'exécution de la requête.<br>";
        echo $query;
        echo "Message du serveur de base de données : ".mysqli_error($connexion);
    } 
}

function verifieProfilA($connexion, $email, $password){

    // à compléter
    $query = "select * from admin where EmailAdmin = '".$email."' and MdpAdmin = '".$password."'";

    $resultat =  mysqli_query($connexion,$query);


    // à compléter, ci dessous des bouts de code pour vous aider
    if ($resultat && mysqli_num_rows($resultat)==1)
    {// Si l'utilisateur est bien logué, on initialise la session et on redirige vers index.php //
      session_start();
      $row = mysqli_fetch_assoc($resultat); // Récupérer la ligne de résultat
      $_SESSION['nom'] = $row['NomAdmin']; // Stocker le nom d'utilisateur dans la session
      $_SESSION['prenom'] = $row['PrenomAdmin']; // Stocker le prénom d'utilisateur dans la session
      $_SESSION['email']=$email;
      $_SESSION['message']='';
      return true; // Connexion réussie
    }
    elseif($resultat && mysqli_num_rows($resultat)!=1)
    {
    //sinon on redirige de nouveau vers la page d'index avec un message d'erreur
    session_start();
    $_SESSION['message']='Login ou mot de passe incorrect';
    return false; // Connexion échouée
    }
    // N'oubliez pas de gérer les cas de mauvaise connexion à la base, d'erreur dans la requête, ...
    else
    {
      echo "<p>Erreur dans l\'exécution de la requête.<br>";
        echo $query;
        echo "Message du serveur de base de données : ".mysqli_error($connexion);
    } 
}


function verifieEmail($connexion, $email) {
    // Vérifie si l'email existe déjà dans la base de données
    $query = "SELECT * FROM client WHERE EmailCli = '$email'";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        return true; // L'email existe déjà
    } else {
        return false; // L'email n'existe pas
    }
}
// Fonction permettant de créer un profil utilisateur dans la base de données

function creationProfil($connexion, $prenom, $nom, $date_naissance, $adresse, $ville, $code_postal, $email, $password) {
    // Vérifie si l'email existe déjà
    if (verifieEmail($connexion, $email)) {
        $_SESSION['message'] = 'Cet email est déjà utilisé.';
        return false;
    }
    // Prépare la requête d'insertion

    $query = "INSERT INTO client (NomCli, PrenomCli, DateNaissanceCli, AdresseCli, VilleCli, CodePostalCli, EmailCli, MdpCli) 
              VALUES ('$nom', '$prenom', '$date_naissance', '$adresse', '$ville', '$code_postal', '$email', '$password')";

    $resultat = mysqli_query($connexion, $query);

    if ($resultat) {
        // Si l'insertion réussit, on initialise la session et redirige vers le tableau de bord
        session_start();
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['email'] = $email;
        $_SESSION['message'] = '';
        return true;
    } else {
        // Si l'insertion échoue, on retourne false pour gérer l'erreur dans register.php
        $_SESSION['message'] = 'Erreur dans la création de compte.';
        return false;

    }
}
?>