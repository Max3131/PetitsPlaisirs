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
      $_SESSION['DateNaissance'] = $row['DateNaissanceCli']; // Stocker la date de naissance dans la session
      $_SESSION['Adresse'] = $row['AdresseCli']; // Stocker l'adresse dans la session
      $_SESSION['Ville'] = $row['VilleCli']; // Stocker la ville dans la session
      $_SESSION['CodePostal'] = $row['CodePostalCli']; // Stocker le code postal dans la session    
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

///////////////////////////////////////////////////////

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
        $_SESSION['DateNaissance'] = $date_naissance;
        $_SESSION['Adresse'] = $adresse;
        $_SESSION['Ville'] = $ville;
        $_SESSION['CodePostal'] = $code_postal;
        $_SESSION['message'] = '';
        return true;
    } else {
        // Si l'insertion échoue, on retourne false pour gérer l'erreur dans register.php
        $_SESSION['message'] = 'Erreur dans la création de compte.';
        return false;

    }
}

///////////////////////////////////////////////////////////////////////////////////////

//affichage les caves de l'utilisateur connecté
/*
function afficheCaves($connexion, $email) {
    // Prépare la requête pour récupérer les caves de l'utilisateur
    $query = "SELECT * FROM cave WHERE EmailCli = '$email'";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        // Affiche les caves dans un tableau
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom de la Cave</th><th>Type de Vin</th><th>Capacité</th></tr>";
        while ($row = mysqli_fetch_assoc($resultat)) {
            echo "<tr>";
            echo "<td>" . $row['IdCave'] . "</td>";
            echo "<td>" . $row['NomCave'] . "</td>";
            echo "<td>" . $row['TypeVin'] . "</td>";
            echo "<td>" . $row['Capacite'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Si aucune cave n'est trouvée, affiche un message
        echo "<p>Aucune cave trouvée.</p>";
    }
}
*/


//////////////////////////////////////////////////////////////////////////////////
//Modification de la temperature de la cave
function modifTemp($connexion, $idCave, $temperature) {
    // Prépare la requête pour mettre à jour la température de la cave
    $query = "UPDATE cave SET Temperature = '$temperature' WHERE IdCave = '$idCave'";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat) {
        // Si la mise à jour réussit, affiche un message de succès
        echo "<p>Température mise à jour avec succès.</p>";
    } else {
        // Si la mise à jour échoue, affiche un message d'erreur
        echo "<p>Erreur dans la mise à jour de la température.</p>";
    }
}

///////////////////////////////////////////////////////////////////////////////////
//Fonction pour modifer les informations clents

function modifInfoClient($connexion, $prenom, $nom, $date_naissance, $adresse, $ville, $code_postal, $email) {
    $query = "UPDATE Client SET 
              PrenomCli='$prenom', 
              NomCli='$nom', 
              DateNaissanceCli='$date_naissance', 
              AdresseCli='$adresse', 
              VilleCli='$ville', 
              CodePostalCli='$code_postal' 
              WHERE EmailCli='$email'";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat) {
        $_SESSION['message'] = "Informations mises à jour avec succès.";
        $_SESSION['prenom'] = $prenom;
        $_SESSION['DateNaissance'] = $date_naissance;
        $_SESSION['Adresse'] = $adresse;
        $_SESSION['Ville'] = $ville;
        $_SESSION['CodePostal'] = $code_postal;
        $_SESSION['nom'] = $nom;
        return true;
    } else {
        $_SESSION['message'] = "Erreur lors de la mise à jour des informations : " . mysqli_error($connexion);
        return false;
    }
}

///////////////////////////////////////////////////////////////////////////////////
//Fonction pour afficher les caves des clients

function afficheCaves($connexion, $email) {
    // Prépare la requête pour récupérer les caves de l'utilisateur
    $query = "SELECT * FROM Cave JOIN Client ON Client.idClient = Cave.idClient WHERE Client.EmailCli = '$email'";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        // Affiche les caves dans un tableau
        echo '<div class="container mt-5 mb-5">';
        echo '<h2 class="mt-4" style="color:rgb(255, 255, 255);" ><strong>Liste des caves disponibles</strong></h2>';
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">';
        while ($row = mysqli_fetch_assoc($resultat)) {
            
            echo '<div class="col">';
            echo '<a href="details.php?id='.$row['idCave'] .'" class="card-link">';
            //echo '<a href="#" class="card-link">';
            echo '<div class="card h-100">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'. $row['NomCave'] .'</h5>';
            echo '<p class="card-text"><strong>Type :</strong>'. $row['TypeCave'] .'</p>';
            echo '<p class="card-text"><strong>Taille :</strong> 120 m²</p>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        // Si aucune cave n'est trouvée, affiche un message
        echo "<p>Aucune cave trouvée.</p>";
    }
}


function afficherToutesLesCaves($connexion) {
    // Prépare la requête pour récupérer toutes les caves
    $query = "SELECT * FROM cave";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        // Affiche les caves dans un tableau
        echo '<div class="container mt-5 mb-5">';
        echo '<h2 class="mt-4" style="color:rgb(255, 255, 255);" ><strong>Liste des caves disponibles</strong></h2>';
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">';
        while ($row = mysqli_fetch_assoc($resultat)) {
            echo '<div class="col">';
            echo '<a href="details.php?id='.$row['idCave'] .'" class="card-link">';
            //echo '<a href="#" class="card-link">';
            echo '<div class="card h-100">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'. $row['NomCave'] .'</h5>';
            echo '<p class="card-text"><strong>Type :</strong>'. $row['TypeCave'] .'</p>';
            echo '<p class="card-text"><strong>Identifiant de la cave :</strong> '. $row['idCave'] .'</p>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        // Si aucune cave n'est trouvée, affiche un message
        echo "<p>Aucune cave trouvée.</p>";
    }
}

/////////////////////////////////////////////////////////////////////////////////////
//Fonction pour permettre aux adminstrateur d'ajouter une cave à un client

function recupererIdClient($connexion, $email, $dateN) {
    // Prépare la requête pour récupérer l'ID du client
    $query = "SELECT idClient FROM client WHERE EmailCli = '$email' AND DateNaissanceCli = '$dateN'";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) == 1) {
        $row = mysqli_fetch_assoc($resultat);
        return $row['idClient']; // Retourne l'ID du client
    } else {
        return false; // Aucun client trouvé
    }
}

function ajouterCave($connexion, $idClient, $nomCave, $adresse, $codePostal, $ville, $volume, $typeVin) {
    // Prépare la requête d'insertion
    $query = "INSERT INTO cave (idClient, NomCave, AdresseCave, CodePostalCave, VilleCave, VolumeCave, TypeCave) 
              VALUES ('$idClient', '$nomCave', '$adresse', '$codePostal', '$ville', '$volume', '$typeVin')";

    $resultat = mysqli_query($connexion, $query);

    if ($resultat) {
        return true; // Insertion réussie
    } else {
        return false; // Insertion échouée
    }
}

////////////////////////////////////////////////////////////////////////////////////////
//Fonction pour permettre d'afficher l'inventaire d'une cave

function afficherInventaire($connexion, $idCave) {
    // Prépare la requête pour récupérer l'inventaire de la cave
    $query = "SELECT * FROM Produit WHERE idCave = '$idCave'";
    $resultat = mysqli_query($connexion, $query);
    // Affiche l'inventaire dans un tableau
    echo '<div class="container ">';
    echo '<h1 class="mb-4 text-center">Inventaire de la Cave</h2>';

    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered table-striped align-middle text-center">';
    echo '<thead class="table-dark">';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nom</th>';
    echo '<th>Type</th>';
    echo '<th>Annee</th>';
    echo '<th>Quantité</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        while ($row = mysqli_fetch_assoc($resultat)) {
            echo '<tr>';
            echo '<td>' . $row['idProduit'] . '</td>';
            echo '<td>' . $row['NomProduit'] . '</td>';
            echo '<td>' . $row['TypeProduit'] . '</td>';
            echo '<td>' . $row['AnneeProduit'] . '</td>';
            echo '<td><span class="quantity" id="qte-' . $row['idProduit'] . '">' . $row['QuantiteProduit'] . '</span></td>';
            echo '<td>';
            echo '<div class="quantity-control justify-content-center">';
            echo '<button class="btn btn-sm btn-success" onclick="modifierQuantite(' . $row['idProduit'] . ', \'plus\')">+</button>';
            echo '<button class="btn btn-sm btn-danger" onclick="modifierQuantite(' . $row['idProduit'] . ', \'moins\')">-</button>';
            echo '<button class="btn btn-sm btn-outline-danger" onclick="supprimerProduit(' . $row['idProduit'] . ')">';
            echo '<i class="bi bi-trash"></i>';
            echo '</div>';
            echo '</td>';
            echo '</tr>';
        }
        
    }
    else {
        // Si aucun vin n'est trouvé, affiche un message
        echo "<p>Aucun vin trouvé dans cette cave.</p>";
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

//////////////////////////////////////////////////////////////////////////////////////////
//Fonction pour permettre de motifier la quantité d'un article dans l'inventaire d'une cave (ajout, suppression, modification)

function modifierQuantite($connexion) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_action'])) {
        if ($_POST['ajax_action'] === 'modifier_quantite') {
            $id = intval($_POST['id']);
            $action = $_POST['action'];

            $result = mysqli_query($connexion, "SELECT QuantiteProduit FROM Produit WHERE idProduit = $id");
            if ($row = mysqli_fetch_assoc($result)) {
                $quantite = $row['QuantiteProduit'];
                if ($action === 'plus') $quantite++;
                elseif ($action === 'moins' && $quantite > 0) $quantite--;

                mysqli_query($connexion, "UPDATE Produit SET QuantiteProduit = $quantite WHERE idProduit = $id");
                echo json_encode(['success' => true, 'nouvelle_quantite' => $quantite]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Produit non trouvé']);
            }
            exit();
        }

        if ($_POST['ajax_action'] === 'ajouter_produit') {
            $idCave = intval($_POST['idCave']);
            $nom = mysqli_real_escape_string($connexion, $_POST['nom']);
            $type = mysqli_real_escape_string($connexion, $_POST['type']);
            $annee = intval($_POST['annee']);
            $quantite = intval($_POST['quantite']);

            $sql = "INSERT INTO Produit (NomProduit, TypeProduit, AnneeProduit, QuantiteProduit, idCave) 
                    VALUES ('$nom', '$type', $annee, $quantite, $idCave)";
            if (mysqli_query($connexion, $sql)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => mysqli_error($connexion)]);
            }
            exit();
        }

        if ($_POST['ajax_action'] === 'supprimer_produit') {
            $idProduit = intval($_POST['idProduit']);
            $sql = "DELETE FROM Produit WHERE idProduit = $idProduit";
            if (mysqli_query($connexion, $sql)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => mysqli_error($connexion)]);
            }
            exit();
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////////////
//Fonction pour affciher les capteurs d'une cave

function afficherCapteurs($connexion, $idCave) {
    // Prépare la requête pour récupérer les capteurs de la cave
    $query = "SELECT * FROM Capteur WHERE idCave = '$idCave'";
    $resultat = mysqli_query($connexion, $query);

    echo '<div class="col-4">';
    echo '<div class="row">';
    echo '<div class="col d-flex justify-content-center align-items-center">';
    echo '<div class="card w-100">';
    echo '<h5 class="card-header">Capteurs de la cave</h5>';
    if ($resultat && mysqli_num_rows($resultat) > 0) {
        // Affiche les capteurs dans un tableau
        while ($row = mysqli_fetch_assoc($resultat)) {
            if ($row['TypeCapteur'] == 'Prise'){
            echo '<div class="card-body">';
            echo '<div class="d-flex justify-content-between align-items-center">';
            echo '<h5 class="card-title mb-0">' . $row['NomCapteur'] . '</h5>';
            echo '<form method="post" action="changer_status.php">'; // adapt if needed
            echo '<input type="hidden" name="StatusCapteur" value="' . $row['StatusCapteur'] . '">';
            echo '<button type="button" class="btn btn-sm btn-primary" onclick="modifierStatusCapteur(' . $row['idCapteur'] . ', \'' . addslashes($row['StatusCapteur']) . '\')"
 >Status</button>';
            echo '</form>';
            echo '</div>';
            echo '<p class="card-text mt-2">' . htmlspecialchars($row['StatusCapteur']) . '</p>';
            echo '</div>';
        } else {
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['NomCapteur'] . '</h5>';
            echo '<p class="card-text">' . $row['StatusCapteur'] . '</p>';
            echo '</div>';
        }
            
        }
    } else {
        // Si aucun capteur n'est trouvé, affiche un message
        echo "<p>Aucun capteur trouvé.</p>";
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

function modifierStatusCapteur($connexion) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_action'])) {
        if ($_POST['ajax_action'] === 'modifier_status_capteur') {
            $statusCapteur = $_POST['status'];
            $idCapteur = intval($_POST['idCapteur']);
            if ($statusCapteur === 'On') {
                $statusCapteur = 'Off';
            } else {
                $statusCapteur = 'On';
            }
            $query = "UPDATE Capteur SET StatusCapteur = '$statusCapteur' WHERE idCapteur = $idCapteur";
            if (mysqli_query($connexion, $query)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => mysqli_error($connexion)]);
            }
            exit();
        }
    }
}


/////////////////////////////////////////////////////////////////////////////////////////////
//Fonction pour afficher les notification d'une cave

function afficherNotifications($connexion, $idCave) {
    // Prépare la requête pour récupérer les notifications de la cave
    $query = "SELECT * FROM Notification WHERE idCave = '$idCave'";
    $resultat = mysqli_query($connexion, $query);
    echo '<div class="row mt-5">';
    echo '<div class="col d-flex justify-content-center align-items-center">';
    echo '<div class="card w-100" style="max-height: 400px; overflow-y: auto;">';
    echo '<h5 class="card-header">Centre de Notification</h5>';
    echo '<div class="card-body">';
    echo '<ul class="list-group">';

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        // Affiche les notifications dans un tableau
        
        while ($row = mysqli_fetch_assoc($resultat)) {
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
        echo '<div>' . $row['MessageNotification'] . '</div>';
        echo '<div>';
        echo '<span class="text me-4">' . $row['HeureNotification'] . '</span>';
        echo '<span class="text me-3">' . $row['DateNotification'] . '</span>';
        echo '<button type="button" class="btn btn-sm btn-danger" onclick="supprimerNotification(' . $row['idNotification'] . ')" >';
        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">';
        echo '<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>';
        echo '</svg>';
        echo '</button>';
        echo '</div>';
        echo '</li>';
    }
    }else {
        // Si aucune notification n'est trouvée
        echo "<p>Aucune notification trouvée.</p>";
    }
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

}

function supprimerNotification($connexion) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_action'])) {
        if ($_POST['ajax_action'] === 'supprimer_notification') {
            $idNotification = intval($_POST['idNotification']);
            $query = "DELETE FROM Notification WHERE idNotification = $idNotification";
            if (mysqli_query($connexion, $query)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => mysqli_error($connexion)]);
            }
            exit();
        }
    }
}


function getLuminosite($connexion, $idCave) {
    //requête SQL
    $query = "
        SELECT R.ValeurReleve 
        FROM releve R 
        JOIN capteur C ON C.idCapteur = R.idCapteur 
        WHERE C.idCave = $idCave 
          AND C.TypeCapteur = 'Luminosite'
    ";
$resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat); 
        return $row['ValeurReleve'];
    } else {
        return null;
    }
}
function getTemperature($connexion, $idCave) {
    //requête SQL
    $query = "
        SELECT R.ValeurReleve 
        FROM releve R 
        JOIN capteur C ON C.idCapteur = R.idCapteur 
        WHERE C.idCave = $idCave 
          AND C.TypeCapteur = 'Temperature'
          ORDER BY R.dateReleve DESC
    LIMIT 1
    ";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat); 
        return $row['ValeurReleve'];
    } else {
        echo "<p>Aucun capteur temp trouvé.</p>";
        return null;
        
    }
}
function getHumidite($connexion, $idCave) {
    //requête SQL
    $query = "
        SELECT R.ValeurReleve 
        FROM releve R 
        JOIN capteur C ON C.idCapteur = R.idCapteur 
        WHERE C.idCave = $idCave 
          AND C.TypeCapteur = 'Humidity' 
    ";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat); 
        return $row['ValeurReleve'];
    } else {
        echo "<p>Aucun capteur humidite trouvé.</p>";
        return null;
    }
}
function getOpti($connexion, $idCave) {
    //requête SQL
    $query = "
        SELECT TC.TempOptiC, TC.LumOptiC, TC.HumOptiC 
        FROM cave Ca
        JOIN typecave TC ON Ca.typecave = TC.idtypecave
        JOIN capteur C ON C.idCave = Ca.idCave
        JOIN client CL ON CL.idClient = Ca.idClient
        WHERE CL.EmailCli = '".$_SESSION['email']."' 
          AND C.idCave = $idCave        
    ";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
       return mysqli_fetch_assoc($resultat);
    } else {
        echo "<p>Aucun opti trouvé.</p>";
        return null;    
    }
}
function getVolume($connexion, $idCave) {
    //requête SQL
    $query = "
        SELECT Ca.VolumeCave
        FROM cave Ca JOIN client CL ON CL.idClient = Ca.idClient
        WHERE CL.EmailCli = '".$_SESSION['email']."' 
          AND Ca.idCave = $idCave       
    ";
    $resultat = mysqli_query($connexion, $query);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
       $row=  mysqli_fetch_assoc($resultat);
       return $row['VolumeCave'];
    } else {
        echo "<p>Aucun volume trouvé.</p>";
        return null;    
    }
}
?>