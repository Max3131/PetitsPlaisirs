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
                <li><a href="index.html">Accueil</a></li> <!-- Lien vers la page d'accueil -->
                <li><a href="dashboard.php">Dashboard</a></li> <!-- Lien vers le tableau de bord -->
                <li><a href="logout.php">Déconnexion</a></li> <!-- Lien pour se déconnecter -->
            </ul>
        </nav>
    </header>

    <!-- Conteneur principal pour le contenu du tableau de bord -->
    <div class="container">
        <h1>Dashboard</h1>
        <!-- Message de bienvenue avec le nom d'utilisateur -->
        <p style="color: red;">Bienvenue, <?php echo $_SESSION['nom']." ".$_SESSION['prenom'] ?? 'Utilisateur'; ?> !</p>

        <!-- Grille pour afficher les différentes cartes du tableau de bord -->
        <div class="dashboard-grid">
            <!-- Carte pour consulter les caves -->
            <div class="dashboard-card">
                <h2>Mes Caves</h2>
                <p>Consultez et gérez vos caves à vin.</p>
                <button onclick="window.location.href='mes_caves.php'">Voir mes caves</button>
            </div>

            <!-- Carte pour ajouter une nouvelle cave -->
            <div class="dashboard-card">
                <h2>Ajouter une Cave</h2>
                <p>Ajoutez une nouvelle cave à vin à votre collection.</p>
                <button onclick="window.location.href='ajouter_cave.php'">Ajouter une cave</button>
            </div>

            <!-- Carte pour consulter les statistiques -->
            <div class="dashboard-card">
                <h2>Statistiques</h2>
                <p>Analysez vos caves avec des statistiques détaillées.</p>
                <button onclick="window.location.href='statistiques.php'">Voir les statistiques</button>
            </div>

            <!-- Carte pour accéder aux paramètres utilisateur -->
            <div class="dashboard-card">
                <h2>Paramètres</h2>
                <p>Modifiez vos informations personnelles et vos préférences.</p>
                <button onclick="window.location.href='parametres.php'">Accéder aux paramètres</button>
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
