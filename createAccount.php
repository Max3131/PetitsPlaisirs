<?php require('connect.php'); ?>
<?php require('fonctions.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte - Petit Plaisir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="menu-banner">
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
            </ul>
        </nav>
    </header>
    <div class="MenuCentrale">
        <h1>Créer un compte</h1>
        <form action="register.php" method="post">
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="date" name="date_naissance" placeholder="Date de naissance" required>
            <input type="text" name="adresse" placeholder="Adresse" required>
            <input type="text" name="ville" placeholder="Ville" required>
            <input type="text" name="code_postal" placeholder="Code postal" required>
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="connexion-btn">Créer un compte</button>
            <p style="color: red;"> 
            <?php
            session_start(); // Démarre la session pour utiliser les variables de session
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']); // On efface le message après l'avoir affiché
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
