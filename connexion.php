<?php require('connect.php'); ?>
<?php require('fonctions.php'); ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Petit Plaisir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="connexion-page">
    <header class="menu-banner">
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Connexion</h1>
        <?php session_start(); // Démarre la session pour utiliser les variables de session ?>
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <br>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <br>
            <button type="submit" class="connexion-btn">Connexion</button>
            <p style="color: red;">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']); // On efface le message après l'avoir affiché
            }
            ?></p>
        </form>
    </div>
    <footer class="footer">
        <p>&copy; 2023 Petit Plaisir. Tous droits réservés.</p>
        <p><a href="mentions_legales.html">Mentions légales</a> | <a href="contact.html">Contactez-nous</a></p>
    </footer>
</body>
</html>
