<?php 
// Inclure le fichier de connexion à la base de données
require('connect.php'); 

// Inclure le fichier contenant les fonctions utilitaires
require('fonctions.php'); 

// Démarrer la session pour accéder aux variables de session
session_start(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Petit Plaisir</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
    <!-- Barre de menu en haut de la page -->
    <header class="menu-banner">
        <nav>
            <ul>
                <li><a href="rediriger.php">Menu</a></li> <!-- Lien vers le menu -->
                <li><a href="index.html">Déconnexion</a></li> <!-- Lien vers le tableau de bord -->
            </ul>
        </nav>
    </header>

    <!-- Conteneur principal pour le contenu du tableau de bord -->
    <div class="MenuCentrale">
        <h1>Menu</h1>
        <h2 style="color: red;" class="welcome-message">
            Bienvenue, <?php echo isset($_SESSION['nom']) ? $_SESSION['nom'] . " " . $_SESSION['prenom'] : 'Utilisateur'; ?> !
        </h2>
        <!-- Grille pour afficher les différentes cartes du tableau de bord -->
        <div class="dashboard-grid">
            <!-- Carte pour consulter les caves -->
            <div class="dashboard-card">
                <h2>Mes Caves</h2>
                <p>Consultez et gérez vos caves.</p>
                <button onclick="window.location.href='cavePanel.php'">Voir mes caves</button>
            </div>
            <div class="dashboard-card">
                <h2>Demander une Cave</h2>
                <p>Demander une nouvelle cave.</p>
                <button onclick="window.location.href='ajouterCave.php'">Ajouter une cave</button>
            </div>
            <!-- Carte pour accéder aux paramètres utilisateur -->
            <div class="dashboard-card">
                <h2>Paramètres</h2>
                <p>Modifiez vos informations personnelles et vos préférences.</p>
                <button onclick="window.location.href='modifAccount.php'">Accéder aux paramètres</button>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <footer class="footer">
        <p>&copy; 2023 Petit Plaisir. Tous droits réservés.</p>
        <p><a href="mentions_legales.html">Mentions légales</a> | <a href="contact.html">Contactez-nous</a></p>
    </footer>
</body>
</html>
