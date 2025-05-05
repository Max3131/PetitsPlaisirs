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
    <title>Ajouter une cave à vin</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .menu-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            width: 100%;
            max-width: 500px;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
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
    <div class="menu-container mt-5 mb-5">
        <div class="card p-4">
            <h3 class="text-center mb-4">Ajouter une Cave à Vin</h3>
            <form method="POST" action="ajouterCave2.php">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail (Client)</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Jean.Dupont@gmail.com" required>
                </div>
                <div class="mb-3">
                    <label for="DateN" class="form-label">Date de naissance (Client)</label>
                    <input type="date" class="form-control" id="DateN" name="DateN" required>
                </div>
                <div class="mb-3">
                    <label for="NomCave" class="form-label">Nom de la cave</label>
                    <input type="text" class="form-control" id="NomCave" name="NomCave" placeholder="Cave personnelle" required>
                </div>
                <div class="mb-3">
                    <label for="volume" class="form-label">Volume (en m3)</label>
                    <input type="number" class="form-control" id="volume" name="volume" placeholder="150" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse de la cave</label>
                    <input type="text" class="form-control" id="adresse"name="Adresse" placeholder="123 Rue de la Cave" required>
                </div>
                <div class="mb-3">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="ville" name="Ville" placeholder="Paris" required>
                </div>
                <div class="mb-3">
                    <label for="codePostal" class="form-label">Code Postal</label>
                    <input type="text" class="form-control" id="codePostal" name="CodePostal" placeholder="75000" required>
                </div>
                <div class="mb-3">
                    <label for="wineType" class="form-label">Type de vin</label>
                    <select class="form-select" id="wineType" name="wineType" required>
                        <option value="">Choisir...</option>
                        <option value="rouge">Vin</option>
                        <option value="blanc">Ciagre</option>
                        <option value="champagne">Fromage</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Ajouter la cave</button>
                </div>
                <p style="color: red;">
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
                </p>
            </form>
        
        </div>
    </div>

    <!-- Pied de page -->
    <footer class="footer">
        <p>&copy; 2023 Petit Plaisir. Tous droits réservés.</p>
        <p><a href="mentions_legales.html">Mentions légales</a> | <a href="contact.html">Contactez-nous</a></p>
    </footer>
</body>
</html>