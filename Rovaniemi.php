<?php $ville = 'Rovaniemi'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Voyage en Finlande</title>
  <meta charset="utf-8">
  <meta name="auteur" content="Adou Humblot, Noam Edwards">
  <meta name="description" content="Voyage organisé à Rovaniemi avec diverses activités nordiques.">
  <meta name="keywords" content="voyage, Finlande, Rovaniemi, Scandinavie, Laponie">
  <link id="theme-style" rel="stylesheet" href="Choixvoyage.css">
          <script src="themeSwitcher.js" defer></script>
</head>

<body class="voyage-finlande">

  <h1>Voyage à Rovaniemi</h1>

  <form method="POST">
    <section class="activites">
      <h2>Nos offres d'activités</h2>
      <table class="tableau-activites">
        <thead>
          <tr>
            <th>Activité</th>
            <th>Description</th>
            <th>Image</th>
            <th>Prix</th>
            <th>Sélectionner</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Safari en motoneige</td>
            <td>Traversez les paysages enneigés finlandais en motoneige.</td>
            <td><img src="photos du site/motoneige1.jpg" alt="Motoneige" class="img-activite"></td>
            <td>200€</td>
            <td><input type="checkbox" name="activites[]" value="Safari en motoneige" data-price="200"></td>
          </tr>
          <tr>
            <td>Observation des aurores boréales</td>
            <td>Profitez d'un spectacle naturel fascinant dans le ciel finlandais.</td>
            <td><img src="photos du site/boréale.png" alt="Aurores boréales" class="img-activite"></td>
            <td>250€</td>
            <td><input type="checkbox" name="activites[]" value="Observation des aurores boréales" data-price="250"></td>
          </tr>
          <tr>
            <td>Visite du village du Père Noël</td>
            <td>Rencontrez le Père Noël en Laponie et découvrez son village magique.</td>
            <td><img src="photos du site/chrsitmas-roros.png" alt="Village du Père Noël" class="img-activite"></td>
            <td>180€</td>
            <td><input type="checkbox" name="activites[]" value="Visite du village du Père Noël" data-price="180"></td>
          </tr>
        </tbody>
      </table>


    <section class="options">
      <h2>Options supplémentaires</h2>
      <p><strong>Billet d'avion</strong> : <span id="prix-billet" data-price="380"> 380€</span></p>

      <div class="nombre-personne">
        <label for="nombre-personnes">Nombre de personnes :</label>
        <input id="nombre-personnes" name="nombre-personnes" type="number" min="1" max="10" value="1" required>
      </div>

      <div class="choix-hebergement">
        <label>Hébergement :</label><br>
        <input type="radio" id="hebergement-hotel" name="hebergement" value="hotel" data-price="275" checked>
        <label for="hebergement-hotel">Hôtel 4 étoiles (275€)</label><br>
        <input type="radio" id="hebergement-habitant" name="hebergement" value="habitant" data-price ="80">
        <label for="hebergement-habitant">Chez l'habitant (80€)</label>
      </div>

      <div class="choix-duree">
        <label for="duree-sejour">Durée du séjour :</label>
        <select id="duree-sejour" name="duree">
          <option value="5">5 jours</option>
          <option value="6">6 jours</option>
          <option value="7">7 jours</option>
          <option value="8">8 jours</option>
          <option value="9">9 jours</option>
        </select>
      </div>
    </section>

    <section class="date-depart">
      <h2>Choisissez votre date de départ</h2>
      <label for="date-depart">Date de départ :</label>
      <input type="date" id="date-depart" name="date_debut" required>
    </section>

    <section class="total-complet">
      <h2>Total estimé</h2>
      <p>Prix total estimé : <span id="total-complet">0</span>€</p>
    </section>

    <button type="submit" class="btn-regler">Valider ma réservation</button>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activites = [
      'Safari en motoneige' => 200,
      'Observation des aurores boréales' => 250,
      'Visite du village du Père Noël' => 180
    ];
    $billet = 380;
    $prix_hebergements = [
      'hotel' => 275,
      'habitant' => 80
    ];

    $activites_choisies = $_POST['activites'] ?? [];
    $nb_personnes = intval($_POST['nombre-personnes']);
    $duree = intval($_POST['duree']);
    $hebergement = $_POST['hebergement'];
    $date_debut = $_POST['date_debut'];

    $prix_options = 0;
    foreach ($activites_choisies as $act) {
      if (isset($activites[$act])) {
        $prix_options += $activites[$act];
      }
    }

    $prix_hebergement_total = $prix_hebergements[$hebergement] * $duree;
    $prix_total_par_personne = $prix_options + $prix_hebergement_total + $billet;
    $prix_total = $prix_total_par_personne * $nb_personnes;

    $ligne_csv = [
      $ville,
      date('Y-m-d H:i:s'),
      $date_debut,
      $nb_personnes,
      $duree,
      $hebergement,
      $prix_options,
      $prix_hebergement_total,
      $billet,
      $prix_total_par_personne,
      $prix_total
    ];

    $fichier = fopen('reservations.csv', 'a');
    fputcsv($fichier, $ligne_csv, ";");
    fclose($fichier);

    echo "<section class='recapitulatif'>";
    echo "<h2>Récapitulatif de la réservation</h2>";
    echo "<p>Date de départ : <strong>$date_debut</strong></p>";
    echo "<p>Nombre de personnes : <strong>$nb_personnes</strong></p>";
    echo "<p>Durée : <strong>$duree jours</strong></p>";
    echo "<p>Hébergement : <strong>$hebergement</strong> ({$prix_hebergements[$hebergement]} €/jour)</p>";
    echo "<p>Activités : <strong>" . (!empty($activites_choisies) ? implode(', ', $activites_choisies) : "Aucune") . "</strong></p>";
    echo "<p>Activités : <strong>$prix_options €</strong></p>";
    echo "<p>Hébergement : <strong>$prix_hebergement_total €</strong></p>";
    echo "<p>Billet : <strong>$billet €</strong></p>";
    echo "<p><strong>Total par personne : $prix_total_par_personne €</strong></p>";
    echo "<h3>Total groupe : $prix_total €</h3>";
    echo "</section>";
  }
  ?>

  <a href="paiment.php" class="btn-regler">Régler la somme</a>
  <a href="JevoyageEnFinlande.php" class="btn-retour">Retour aux offres</a>

</body>
<script src="calcul_prix.js" defer></script>
</html>