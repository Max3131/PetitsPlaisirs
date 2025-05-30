<?php 
require('connect.php');
require('fonctions.php');

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
  modifierQuantite($connexion); 
  supprimerNotification($connexion);

  /*$lux= getLuminosite($connexion, $id);
  $temperature = getTemperature($connexion, $id);
  $humid = getHumidite($connexion, $id);
  $opti= getOpti($connexion, $id);
  $volume = getVolume($connexion, $id);*/

modifierQuantite($connexion);
supprimerNotification($connexion);
modifierStatusCapteur($connexion);
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
  <title>Accueil</title>
</head>

<body>
  <!-- Barre de menu en haut de la page -->
  <header class="menu-banner">
    <nav>
      <ul>
        <li><a href="rediriger.php">Menu</a></li>
        <li><a href="index.html">Déconnexion</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="container-fluid">
      <section>
        <div class="row pt-5 mt-5 mb-4">
          <div class="col-12 text-center">
            <h1>Dashboard de la cave <?php echo $id ?></h1>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-8">
            <?php
            //Affichage des relevés
            afficherRelevements($connexion, $id);
            //Bouton actualiser
            ?>
            <div class="row mt-4">
              <div class="col-6 d-flex justify-content-center">
                <div class="card w-100">
                  <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Statut porte :</h5>
                    <?php
                    $status = getStatusPorte($connexion, $id);
                    echo '<h5 class="mb-0 text-end" style="color:red"' . $status . ';">' . $status . '</h5>';
                    ?>
                  </div>
                </div>
              </div>

              <div class="col-6 d-flex justify-content-center">
                <div class="card w-100">
                  <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Relevés :</h5>
                    <button type="button" class="btn btn-primary" onclick="lancerScript()">Actualiser</button>
                  </div>
                </div>
              </div>
            </div>
            <?php
            // Affichage des notifications
            afficherNotifications($connexion, $id);
            ?>
          </div>
          <?php
          // Affichage des capteurs
          afficherCapteurs($connexion, $id);
          ?>
        </div>
      </section>
    </div>
  </main>



  <?php afficherInventaire($connexion, $id); ?>

  <div class="text-center mt-3 mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajoutProduitModal">
      Ajouter un produit
    </button>
  </div>

  <footer class="footer">
    <p>&copy; 2023 Petit Plaisir. Tous droits réservés.</p>
    <p><a href="mentions_legales.html">Mentions légales</a> | <a href="contact.html">Contactez-nous</a></p>
  </footer>

  <!-- Modal pour ajouter un produit -->
  <div class="modal fade" id="ajoutProduitModal" tabindex="-1" aria-labelledby="ajoutProduitLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content text-danger">
        <div class="modal-header">
          <h5 class="modal-title" id="ajoutProduitLabel">Ajouter un produit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <form id="formAjoutProduit">
            <div class="mb-3">
              <label for="nomProduit" class="form-label">Nom</label>
              <input type="text" class="form-control" id="nomProduit" required>
            </div>
            <div class="mb-3">
              <label for="typeProduit" class="form-label">Type</label>
              <input type="text" class="form-control" id="typeProduit" required>
            </div>
            <div class="mb-3">
              <label for="anneeProduit" class="form-label">Année</label>
              <input type="number" class="form-control" id="anneeProduit" required>
            </div>
            <div class="mb-3">
              <label for="quantiteProduit" class="form-label">Quantité</label>
              <input type="number" class="form-control" id="quantiteProduit" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-success" onclick="ajouterProduit(<?php echo $id; ?>)">Ajouter</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal pour ajouter une valeur souahité -->
  <div class="modal fade" id="ajoutValeurModal" tabindex="-1" aria-labelledby="ajoutValeurLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-danger">
      <div class="modal-header">
        <h5 class="modal-title" id="ajoutValeurLabel">Sélectionner une valeur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <div class="modal-body">
        <form id="formAjoutValeur" method="POST">
          <!-- Champ caché pour l’ID du capteur -->
          <input type="hidden" id="idCapteurInput" name="idCapteur">

          <div class="mb-3">
            <label for="Valeur" class="form-label">Valeur souhaitée</label>
            <input type="number" class="form-control" id="Valeur" name="valeur" required>
          </div>

          <!-- <p>L'ID est : <span id="id-affiche"></span></p> -->
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" form="formAjoutValeur" class="btn btn-success">Ajouter</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal pour afficher l'historique des capteurs -->
 <!-- Modal pour ajouter une valeur souahité -->
  
  <div class="modal fade" id="historiqueCapteur" tabindex="-1" aria-labelledby="historiqueCapteurLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-danger">
      <div class="modal-header">
        <h5 class="modal-title" id="historiqueCapteurLabel">Historique du capteur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <div class="modal-body" id="contenu-historique-capteur">
        <!-- Contenu chargé dynamiquement via AJAX -->
        <p>Chargement...</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>



<script>

  // Fonction pour envoyer la valeur choisie par l'utilisateur
  // et mettre à jour la base de données
  function envoyerValeurChoisie() {
    // Récupère le formulaire d'ajout de valeur
    const form = document.getElementById('formAjoutValeur');

    // Ajoute un écouteur d'événement pour intercepter la soumission du formulaire
    form.addEventListener('submit', function (e) {
      e.preventDefault(); // Empêche la soumission classique du formulaire

      // Récupère les données du formulaire
      const formData = new FormData(form);

      // Envoie les données au serveur via une requête POST
      fetch('traitementChoixUtilisateur.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.text()) // Traite la réponse en tant que texte
        .then(result => {
          console.log('Succès :', result); // Affiche le résultat dans la console

          // Ferme la modale Bootstrap après la mise à jour
          const modalElement = document.getElementById('ajoutValeurModal');
          const modalInstance = bootstrap.Modal.getInstance(modalElement);
          modalInstance.hide();

          // Rafraîchit la page pour refléter les changements
          window.location.reload();
        })
        .catch(error => {
          // Gère les erreurs en cas de problème avec la requête
          console.error('Erreur :', error);
          alert('Une erreur est survenue lors de la mise à jour.');
        });
    });
  }
  // Appelle la fonction au chargement de la page
  document.addEventListener('DOMContentLoaded', envoyerValeurChoisie);





    function initialiserModalCapteur() {
    const modal = document.getElementById('ajoutValeurModal');
    if (!modal) return;

    modal.addEventListener('show.bs.modal', function (event) {
      const bouton = event.relatedTarget;
      const idCapteur = bouton.getAttribute('data-id');

      // Injecte l’ID dans les bons éléments
      modal.querySelector('#idCapteurInput').value = idCapteur;
      modal.querySelector('#id-affiche').textContent = idCapteur;
    });
  }
  // Appelle la fonction pour initialiser le modal
  document.addEventListener('DOMContentLoaded', initialiserModalCapteur);




  function initialiserModalHistoriqueCapteur() {
  const modal = document.getElementById('historiqueCapteur');
  if (!modal) return;

  modal.addEventListener('show.bs.modal', function (event) {
    const bouton = event.relatedTarget;
    const idCapteur = bouton.getAttribute('data-id');

    // Met à jour dynamiquement le contenu via AJAX
    const contenu = modal.querySelector('#contenu-historique-capteur');
    contenu.innerHTML = 'Chargement...';

    fetch('afficherHistoriqueCapteur.php?id=' + encodeURIComponent(idCapteur))
      .then(response => response.text())
      .then(data => {
        contenu.innerHTML = data;
      })
      .catch(error => {
        contenu.innerHTML = 'Erreur de chargement.';
        console.error(error);
      });
  });
}

document.addEventListener('DOMContentLoaded', initialiserModalHistoriqueCapteur);
  




    function modifierQuantite(idProduit, action) {
      fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `ajax_action=modifier_quantite&id=${idProduit}&action=${action}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.getElementById('qte-' + idProduit).textContent = data.nouvelle_quantite;
        } else {
          alert("Erreur : " + data.message);
        }
      })
      .catch(error => console.error("Erreur réseau :", error));
    }

    function supprimerProduit(idProduit) {
      if (confirm("Voulez-vous vraiment supprimer ce produit ?")) {
        fetch('', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `ajax_action=supprimer_produit&idProduit=${idProduit}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            window.location.reload();
          } else {
            alert("Erreur lors de la suppression.");
          }
        });
      }
    }

    function afficherFormulaire() {
      document.getElementById('formAjout').style.display = 'block';
    }

    function ajouterProduit(idCave) {
      const nom = document.getElementById('nomProduit').value;
      const type = document.getElementById('typeProduit').value;
      const annee = document.getElementById('anneeProduit').value;
      const quantite = document.getElementById('quantiteProduit').value;

      fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `ajax_action=ajouter_produit&idCave=${idCave}&nom=${encodeURIComponent(nom)}&type=${encodeURIComponent(type)}&annee=${annee}&quantite=${quantite}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert("Produit ajouté !");
          window.location.reload();
        } else {
          alert("Erreur : " + data.message);
        }
      });
    }

    function supprimerNotification(idNotification) {
      if (confirm("Voulez-vous vraiment supprimer ce produit ?")) {
        fetch('', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `ajax_action=supprimer_notification&idNotification=${idNotification}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            window.location.reload();
          } else {
            alert("Erreur lors de la suppression de la notification.");
          }
        });
      }
    }

    function modifierStatusCapteur(idCapteur, status) {
      fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `ajax_action=modifier_status_capteur&idCapteur=${idCapteur}&status=${status}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        } else {
          alert("Erreur : " + data.message);
        }
      });
    }
  </script>
</body>
</html>
