<?php $ville = 'Upssala'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Voyage en Suède</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot, Noam Edwards">
    <meta name="description" content="Voyage organisé en Suède avec diverses activités et options d'hébergement">
    <meta name="keywords" content="voyage, Suède, Scandinavie, tourisme">
    <link rel="stylesheet" href="Choixvoyage.css">
</head>

<body class="voyage-suede">

    <h1>Voyage en Suède - Uppsala</h1>

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
                        <td>Exploration d'un village Viking</td>
                        <td>Découvrez l'histoire des vikings suédois à travers une randonnée.</td>
                        <td><img src="photos%20du%20site/viking.jpg" alt="Village Viking" class="img-activite"></td>
                        <td>130€</td>
                        <td><input type="checkbox" name="activites[]" value="Exploration d'un village Viking" data-price="130"></td>
                    </tr>
                    <tr>
                        <td>Lancer de hache</td>
                        <td>Activité traditionnelle suédoise, testez votre adresse !</td>
                        <td><img src="photos%20du%20site/hache.webp" alt="Lancer de hache" class="img-activite"></td>
                        <td>220€</td>
                        <td><input type="checkbox" name="activites[]" value="Lancer de hache" data-price="220"></td>
                    </tr>
                    <tr>
                        <td>Visite du Cube of Art</td>
                        <td>Musée d'art contemporain de renom à Uppsala.</td>
                        <td><img src="photos%20du%20site/musee_uppsalla.jpg" alt="Cube of Art" class="img-activite"></td>
                        <td>190€</td>
                        <td><input type="checkbox" name="activites[]" value="Visite du Cube of Art" data-price="190"></td>
                    </tr>
                </tbody>
            </table>


        <section class="options">
            <h2>Options supplémentaires</h2>
            <p><strong>Billet d'avion :</strong> <span id="prix-billet" data-price="400">400€</span></p>

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

            <h3>Durée du séjour</h3>
            <select name="duree" id="duree-sejour">
                <option value="5">5 jours</option>
                <option value="6">6 jours</option>
                <option value="7">7 jours</option>
                <option value="8">8 jours</option>
                <option value="9">9 jours</option>
            </select>
        </section>

        <section class="date-depart">
            <h2>Date de départ</h2>
            <label for="date-depart">Choisissez une date :</label>
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
            "Exploration d'un village Viking" => 130,
            'Lancer de hache' => 220,
            'Visite du Cube of Art' => 190
        ];
        $billet = 400;
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
            implode(' | ', $activites_choisies),
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
        echo "<p>Durée du séjour : <strong>$duree jours</strong></p>";
        echo "<p>Hébergement : <strong>$hebergement</strong> ({$prix_hebergements[$hebergement]} €/jour)</p>";
        echo "<p>Activités : <strong>" . (count($activites_choisies) ? implode(', ', $activites_choisies) : "Aucune") . "</strong></p>";
        echo "<p>Prix activités : <strong>$prix_options €</strong></p>";
        echo "<p>Prix hébergement : <strong>$prix_hebergement_total €</strong></p>";
        echo "<p>Prix billet : <strong>$billet €</strong></p>";
        echo "<p><strong>Total par personne : $prix_total_par_personne €</strong></p>";
        echo "<h3>Total groupe : $prix_total €</h3>";
        echo "</section>";
    }
    ?>

    <a href="paiment.php" class="btn-regler">Régler la somme</a>
    <a href="JevoyageEnSuede.php" class="btn-retour">Retour aux offres</a>

</body>
<script src="calcul_prix.js" defer></script>
</html>