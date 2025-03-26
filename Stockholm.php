<?php $ville = 'Stockholm'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Voyage en Suède</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot, Noam Edwards">
    <meta name="description" content="Voyage organisé à Stockholm avec diverses activités">
    <meta name="keywords" content="voyage, Suède, Stockholm, Scandinavie, tourisme">
    <link rel="stylesheet" href="Choixvoyage.css">
</head>

<body class="voyage-suede">

    <h1>Voyage à Stockholm</h1>

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
                        <td>Exploration de Stockholm</td>
                        <td>Découvrez la capitale suédoise avec ses monuments et musées emblématiques.</td>
                        <td><img src="photos du site/stockholm.jpg" alt="Stockholm" class="img-activite"></td>
                        <td>130€</td>
                        <td><input type="checkbox" name="activites[]" value="Exploration de Stockholm"></td>
                    </tr>
                    <tr>
                        <td>Croisière dans l'archipel de Stockholm</td>
                        <td>Profitez d'une balade en bateau à travers les îles suédoises.</td>
                        <td><img src="photos du site/archipel.jpg" alt="Archipel de Stockholm" class="img-activite"></td>
                        <td>160€</td>
                        <td><input type="checkbox" name="activites[]" value="Croisière dans larchipel de Stockholm"></td>
                    </tr>
                    <tr>
                        <td>Testez la vie nocturne de Stockholm</td>
                        <td>Découvrez les meilleurs clubs de Stockholm.</td>
                        <td><img src="photos du site/v-wall-stockholm.webp" alt="Vie nocturne" class="img-activite"></td>
                        <td>250€</td>
                        <td><input type="checkbox" name="activites[]" value="Testez la vie nocturne de Stockholm"></td>
                    </tr>
                </tbody>
            </table>


        <section class="options">
            <h2>Options supplémentaires</h2>
            <p><strong>Billet d'avion</strong> : 400€</p>

            <label for="nombre-personnes">Nombre de personnes :</label>
            <input id="nombre-personnes" name="nombre-personnes" type="number" min="1" max="10" value="1" required>

            <h3>Hébergement</h3>
            <label><input type="radio" name="hebergement" value="hotel" checked> Hôtel 4 étoiles (275€)</label><br>
            <label><input type="radio" name="hebergement" value="habitant"> Chez l'habitant (80€)</label>

            <h3>Durée du séjour</h3>
            <label for="duree-sejour">Durée :</label>
            <select id="duree-sejour" name="duree">
                <option value="5">5 jours</option>
                <option value="6">6 jours</option>
                <option value="7">7 jours</option>
                <option value="8">8 jours</option>
                <option value="9">9 jours</option>
            </select>
        </section>

        <section class="date-depart">
            <h2>Date de départ</h2>
            <label for="date-depart">Choisissez votre date :</label>
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
            'Exploration de Stockholm' => 130,
            'Croisière dans larchipel de Stockholm' => 160,
            'Testez la vie nocturne de Stockholm' => 250
        ];
        $billet = 400;
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
        echo "<p>Activités : <strong>" . (count($activites_choisies) ? implode(', ', $activites_choisies) : "Aucune") . "</strong></p>";
        echo "<p>Activités : <strong>$prix_options €</strong></p>";
        echo "<p>Hébergement : <strong>$prix_hebergement_total €</strong></p>";
        echo "<p>Billet : <strong>$billet €</strong></p>";
        echo "<p><strong>Total par personne : $prix_total_par_personne €</strong></p>";
        echo "<h3>Total groupe : $prix_total €</h3>";
        echo "</section>";
    }
    ?>

    <a href="paiment.php" class="btn-regler">Régler la somme</a>
    <a href="JevoyageEnSuede.php" class="btn-retour">Retour aux offres</a>

</body>

</html>