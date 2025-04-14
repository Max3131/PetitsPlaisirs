<?php 
require('connect.php'); 
require('fonctions.php'); 
session_start(); 

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}




?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Mon Compte - Petit Plaisir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="menu-banner">
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <div class="MenuCentrale">
        <h1>Modifier Mes Informations</h1>
        <form action="modificationCompte.php" method="post">
            <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $_SESSION['prenom']; ?>" required>
            <input type="text" name="nom" placeholder="Nom" value="<?php echo $_SESSION['nom']; ?>" required>
            <input type="date" name="date_naissance" placeholder="Date de naissance" value="<?php echo $_SESSION['DateNaissance']; ?>" required>
            <input type="text" name="adresse" placeholder="Adresse" value="<?php echo $_SESSION['Adresse']; ?>" required>
            <input type="text" name="ville" placeholder="Ville" value="<?php echo $_SESSION['Ville']; ?>" required>
            <input type="text" name="code_postal" placeholder="Code postal" value="<?php echo $_SESSION['CodePostal']; ?>" required>
            <button type="submit" class="connexion-btn">Mettre à jour</button>
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
    <footer class="footer">
        <p>&copy; 2023 Petit Plaisir. Tous droits réservés.</p>
        <p><a href="mentions_legales.html">Mentions légales</a> | <a href="contact.html">Contactez-nous</a></p>
    </footer>
</body>
</html>
