<?php $ville = 'Akureyri'; ?>
<!DOCTYPE html>
<html lang="en">
<head><title>Voyage</title>
    <meta charset="utf-8">
    <meta name ="auteur" content="Adou Humblot , Noam Edwards">
    <meta name ="description" content="un site d'une agence voyage avec des itinéraires deja construit vers les pays scandinaves ">
    <meta name ="keywords" content="site de voyage , voyage en scandinavie, itinéraire">
    <link rel="stylesheet" href="Choixvoyage.css">
</head>
<body class="voyage-islande">

<h1>Voyage en Islande</h1>

<form method="POST">
<section class="activites">
    <h2>Nos offres d'activités</h2>

    <table class="tableau-activites">
        <thead>
        <tr>
            <th>Activité</th>
            <th>Description</th>
            <th>Image</th>
            <th>Prix (par activité)</th>
            <th>Sélectionner</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Visite des maisons de tourbe de Laufás</td>
            <td>Venez voir l'héritage de la vie d'antan d'Islande.</td>
            <td><img src="photos du site/laufas.jpg" alt="Cercle d'Or" class="img-activite"></td>
            <td>150€</td>
            <td><input type="checkbox" name="activites[]" value="Visite des maisons de tourbe de Laufás" class="activite-checkbox"></td>
        </tr>
        <tr>
            <td>Partir en balade à cheval</td>
            <td>A seulement 15 minutes de route d'Akureyri, vous arrivez à une ferme entourée de chevaux et de paysages islandais à couper le souffle.</td>
            <td><img src="photos du site/cheval-a-akureyri.webp" alt="Traîneau à chiens" class="img-activite"></td>
            <td>200€</td>
            <td><input type="checkbox" name="activites[]" value="Partir en balade à cheval" class="activite-checkbox"></td>
        </tr>
        <tr>
            <td>Visiter l'église d'Akureyri</td>
            <td>L’église et ses tours sont le symbole d’Akureyri. Montez à l’église en empruntant les escaliers : vous aurez depuis l’église, une vue imprenable sur la ville.</td>
            <td><img src="photos du site/photo-at-dusk.jpg" alt="Aurores boréales" class="img-activite"></td>
            <td>250€</td>
            <td><input type="checkbox" name="activites[]" value="Visiter léglise dAkureyri" class="activite-checkbox"></td>
        </tr>

        </tbody>
    </table>

    <section class="barème-prix">
        <h2>Prix total</h2>
        <p>Total des activités sélectionnées: <span id="prix-total">0</span>€</p>
    </section>

    <section class="options">
        <h2>Options supplémentaires</h2>
        <p><strong>Billet d'avion</strong>: 350€ (vol aller-retour)</p>

        <div class ="nombre-personne">
            <h3>Nombre(s) de personne(s)</h3>
            <label for="nombre-personnes">Nombre(s) de personne(s)</label>
            <input id="nombre-personnes" name="nombre-personnes" type="number" min="1" max="10" value ="1" required>
        </div>

        <div class="choix-hebergement">
            <h3>Choisir votre hébergement</h3>
            <label for="hebergement-hotel">Hôtel 4 étoiles (275€)</label>
            <input type="radio" id="hebergement-hotel" name="hebergement" value="hotel" checked> <br>
            <label for="hebergement-habitant">Chez l'habitant (80€)</label>
            <input type="radio" id="hebergement-habitant" name="hebergement" value="habitant">
        </div>

        <div class="choix-duree">
            <h3>Choisir la durée de votre séjour</h3>
            <label for="duree-sejour">Durée du séjour</label>
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
        <label for="date-depart">Date de départ:</label>
        <input type="date" id="date-depart">
    </section>

    <section class="total-complet">
        <h2>Total complet</h2>
        <p>Prix total des activités + options: <span id="total-complet">0</span>€</p>
        <button type="submit" class ="btn-regler">Valider ma réservation</button>
        </form>

        <?php
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  $activites = [
                      'Visite des maisons de tourbe de Laufás' => 150,
                      'Partir en balade à cheval' => 200,
                      'Visiter léglise dAkureyri' => 250
                  ];
                  $billet = 350;
                  $prix_hebergements = [
                      'hotel' => 275,
                      'habitant' => 80
                  ];

                  $activites_choisies = $_POST['activites'] ?? [];
                  $nb_personnes = intval($_POST['nombre-personnes'] ?? 1);
                  $duree = intval($_POST['duree'] ?? 1);
                  $hebergement = $_POST['hebergement'] ?? 'hotel';
                  $date_debut = $_POST['date_debut'] ?? date('Y-m-d');

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
                          implode(' | ', $activites_choisies),
                          $prix_options,
                          $prix_hebergement_total,
                          $billet,
                          $prix_total_par_personne,
                          $prix_total
                      ];

                      $fichier = fopen('reservations.csv', 'a');
                      fputcsv($fichier, $ligne_csv);
                      fclose($fichier);


                  echo "<section class='recapitulatif'>";
                  echo "<h2>Récapitulatif de la réservation</h2>";
                  echo "<p>Date de début du séjour : <strong>$date_debut</strong></p>";
                  echo "<p>Nombre de personnes : <strong>$nb_personnes</strong></p>";
                  echo "<p>Durée du séjour : <strong>$duree jours</strong></p>";
                  echo "<p>Hébergement choisi : <strong>$hebergement</strong> (" . $prix_hebergements[$hebergement] . " €/jour)</p>";
                  echo "<p>Activités sélectionnées : <strong>" . implode(', ', $activites_choisies) . "</strong></p>";
                  echo "<p>Prix total des activités : <strong>$prix_options €</strong></p>";
                  echo "<p>Prix total hébergement : <strong>$prix_hebergement_total €</strong></p>";
                  echo "<p>Prix du billet : <strong>$billet €</strong></p>";
                  echo "<p><strong>Total par personne : $prix_total_par_personne €</strong></p>";
                  echo "<h3>Total général : $prix_total €</h3>";
                  echo "</section>";
              }
              ?>
        <a href="paiment.php" class="btn-regler">Régler la somme</a>

    </section>
</section>
<a href="JevoyageEnIslande.php" class="btn-retour">Retour aux offres</a>

</body>
</html>