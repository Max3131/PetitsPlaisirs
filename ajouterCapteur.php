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
    <title>Ajouter des capteurs</title>
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
                <li><a href="dashboardAdmin.php">Dashboard</a></li> <!-- Lien vers le tableau de bord -->
            </ul>
        </nav>
    </header>

    <!-- Conteneur principal pour le contenu du tableau de bord -->
    <div class="menu-container mt-5 mb-5">
        <div class="card p-4">
            <h3 class="text-center mb-4">Ajouter des capteurs</h3>
            <form method="POST" action="ajouterCave2.php">
                <div class="mb-3">
                    <label for="idCave" class="form-label">identifiant de la cave</label>
                    <input type="number" class="form-control" id="idCave" name="idCave" placeholder="1" required>
                </div>
                <div class="mb-3">
                    <label for="nomCapteur" class="form-label">Nom du capteur</label>
                    <input type="text" class="form-control" id="nomCapteur" name="nomCapteur" placeholder="temperature 1" required>
                </div>
                <div class="mb-3">
                    <label for="valeurCpateur" class="form-label">Valeur du capteur</label>
                    <input type="text" class="form-control" id="valeurCapteur" name="valeurCapteur" placeholder="Cave personnelle" required>
                </div>
                <div class="mb-3">
                    <label for="statusCapteur" class="form-label">Status du Capteur</label>
                    <input type="text" class="form-control" id="statusCapteur" name="satutusCapteur" placeholder="150" required>
                </div>put type="text" class="form-control" id="codePostal" placeholder="75000" required>
                </div>
                <div class="mb-3">
                    <label for="typeCapteur" class="form-label">Type de cpateur</label>
                    <select class="form-select" id="wineType" required>
                        <option value="">Choisir...</option>
                        <option value="rouge">Interrupteur</option>
                        <option value="blanc">Lumiere</option>
                        <option value="champagne">Humidite</option>
                    </select>
                </div>  
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Ajouter la cave</button>
                </div>
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