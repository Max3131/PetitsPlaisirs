<?php require('connect.php'); ?>
<?php require('fonctions.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Caves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <style>
        .card-link {
        text-decoration: none !important;
        color: inherit;
        }

        .card-link:hover .card {
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            transform: scale(1.02);
            transition: 0.2s;
        }
    </style>
</head>
<body>
    <header class="menu-banner">
        <nav>
            <ul>
                <li><a href="rediriger.php">Menu</a></li>
                <li><a href="index.html">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.html');
        exit();
    }
    $connexion = mysqli_connect("p:".SERVEUR, NOM, PASSE, BD);
    if (!$connexion) {
      $_SESSION['message'] = "Problème : Connexion au serveur ou à la base de données impossible.";
      header("Location: connexion.php");
      exit();
    }
    $email = $_SESSION['email'];
    afficherToutesLesCaves($connexion);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
    <footer class="footer">
        <p>&copy; 2023 Petit Plaisir. Tous droits réservés.</p>
        <p><a href="mentions_legales.html">Mentions légales</a> | <a href="contact.html">Contactez-nous</a></p>
    </footer>
</body>
</html>
