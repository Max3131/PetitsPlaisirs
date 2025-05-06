<?php require('connect.php'); ?>
<?php require('fonctions.php'); ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.html');
        exit();
    }
    $id = $_GET['id'];
    $connexion = mysqli_connect("p:".SERVEUR, NOM, PASSE, BD);
    if (!$connexion) {
        $_SESSION['message'] = "Problème : Connexion au serveur ou à la base de données impossible.";
        header("Location: connexion.php");
        exit();
    }
    ?>
    <!-- <nav class="navbar navbar-expand-md shadow sticky-top" style="background-color: lightskyblue;" data-bs-theme="dark">
        <div class="container-fluid">
                <a class="navbar-brand text-light fw-bold" href="Accueil.html">Size Me </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                  
              
                <div class="collapse navbar-collapse justify-content-end" id="nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="Accueil.html">Compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="equipe.html">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="equipe.html">Mes produits</a>
                        </li>
                    </ul>
                </div>
                
        </div>
    </nav> -->

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
    
    <main>
        <div class="container-fluid">
            <section>
                <div class="row mt-5 mb-4">
                    <div class="col-12 text-center">
                        <h2>Dashboard <?php echo $id ?></h2>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center">
                                <div class="card" style="width: 18rem;">
                                    <!--img src="..." class="card-img-top" alt="..."!-->
                                    <div class="card-body">
                                      <h5 class="card-title">Luminosité</h5>
                                      <h1 class="card-text">26 Lux</h1>
                                      <p class="card-text">Recommandé : 26 Lux</p>
                                      <!--a href="#" class="btn btn-primary">Go somewhere</a!-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <div class="card" style="width: 18rem;">
                                    <!--img src="..." class="card-img-top" alt="..."!-->
                                    <div class="card-body">
                                      <h5 class="card-title">Luminosité</h5>
                                      <h1 class="card-text">26 Lux</h1>
                                      <p class="card-text">Recommandé : 26 Lux</p>
                                      <!--a href="#" class="btn btn-primary">Go somewhere</a!-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <div class="card" style="width: 18rem;">
                                    <!--img src="..." class="card-img-top" alt="..."!-->
                                    <div class="card-body">
                                      <h5 class="card-title">Luminosité</h5>
                                      <h1 class="card-text">26 Lux</h1>
                                      <p class="card-text">Recommandé : 26 Lux</p>
                                      <!--a href="#" class="btn btn-primary">Go somewhere</a!-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col d-flex justify-content-center align-items-center">
                                <div class="card custom-card">
                                    <h5 class="card-header">Caractéristiques de la cave</h5>
                                    <div class="card-body">
                                        <h5 class="card-title">Volume</h5>
                                        <p class="card-text">40 m3</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>
    </main>

    <body>
<div class="container py-5">
  <h2 class="mb-4 text-center">Inventaire de la Cave</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nom du produit</th>
          <th>Quantité</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Exemple de produit -->
        <tr>
          <td>1</td>
          <td>Vin Rouge 2018</td>
          <td><span class="quantity">12</span></td>
          <td>
            <div class="quantity-control justify-content-center">
              <button class="btn btn-sm btn-success">+</button>
              <button class="btn btn-sm btn-danger">−</button>
            </div>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Champagne Brut</td>
          <td><span class="quantity">6</span></td>
          <td>
            <div class="quantity-control justify-content-center">
              <button class="btn btn-sm btn-success">+</button>
              <button class="btn btn-sm btn-danger">−</button>
            </div>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>Fromage Affiné</td>
          <td><span class="quantity">4</span></td>
          <td>
            <div class="quantity-control justify-content-center">
              <button class="btn btn-sm btn-success">+</button>
              <button class="btn btn-sm btn-danger">−</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- Bouton pour ajouter un produit -->
  <div class="text-center mt-4">
    <a href="#" class="btn btn-primary">➕ Ajouter un produit</a>
  </div>
</div>

    <!-- Pied de page -->
    <footer class="footer">
        <p>&copy; 2023 Petit Plaisir. Tous droits réservés.</p>
        <p><a href="mentions_legales.html">Mentions légales</a> | <a href="contact.html">Contactez-nous</a></p>
    </footer>
            

</body>