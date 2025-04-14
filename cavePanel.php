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
                <li><a href="dashboard.php">Accueil</a></li>
                <li><a href="index.html">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <div class="container mt-5">
    <h2 class="mt-4" style="color:rgb(255, 255, 255);" ><strong>Liste des caves disponibles</strong></h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      
      <!-- Exemple de case cliquable -->
      <div class="col">
        <a href="#" class="card-link">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Cave de Bordeaux</h5>
              <p class="card-text"><strong>Type :</strong> Vin rouge</p>
              <p class="card-text"><strong>Taille :</strong> 120 m²</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col">
        <a href="#" class="card-link">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Cave de Champagne</h5>
              <p class="card-text"><strong>Type :</strong> Champagne</p>
              <p class="card-text"><strong>Taille :</strong> 85 m²</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col">
        <a href="#" class="card-link">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Cave du Rhône</h5>
              <p class="card-text"><strong>Type :</strong> Vin blanc</p>
              <p class="card-text"><strong>Taille :</strong> 95 m²</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Ajoute d'autres blocs identiques ici -->

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
    <footer class="footer">
        <p>&copy; 2023 Petit Plaisir. Tous droits réservés.</p>
        <p><a href="mentions_legales.html">Mentions légales</a> | <a href="contact.html">Contactez-nous</a></p>
    </footer>
</body>
</html>
