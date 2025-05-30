<?php $ville = 'Oslo'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Voyage en Norvège</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot, Noam Edwards">
    <meta name="description" content="Voyage organisé en Norvège avec diverses activités et options d'hébergement">
    <meta name="keywords" content="voyage, Norvège, Scandinavie, tourisme">
    <link id="theme-style" rel="stylesheet" href="Choixvoyage.css">
        <script src="themeSwitcher.js" defer></script>
</head>

<body class="voyage-norvege">

    <h1>Voyage en Norvège</h1>

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
                        <td>Safari en raquettes</td>
                        <td>Vivez une aventure unique à travers les paysages enneigés de la Norvège en raquettes.</td>
                        <td><img src="photos du site/safari-raquettes.jpg" alt="Safari en raquettes" class="img-activite"></td>
                        <td>150€</td>
                        <td><input type="checkbox" name="activites[]" value="Safari en raquettes" class="activite-checkbox" data-price="150"></td>
                    </tr>
                    <tr>
                        <td>Visite du musée d'Oslo</td>
                        <td>Laissez-vous guider dans la culture norvégienne au musée d'Oslo.</td>
                        <td><img src="photos du site/musee.jpg" alt="Musée d'Oslo" class="img-activite"></td>
                        <td>80€</td>
                        <td><input type="checkbox" name="activites[]" value="Visite du musée dOslo" class="activite-checkbox" data-price="80"></td>
                    </tr>
                    <tr>
                        <td>La vie nocturne de la capitale</td>
                        <td>Profitez des meilleures boîtes de la capitale norvégienne.</td>
                        <td><img src="photos du site/boite_oslo.jpeg" alt="Vie nocturne Oslo" class="img-activite"></td>
                        <td>220€</td>
                        <td><input type="checkbox" name="activites[]" value="La vie nocturne de la capital" class="activite-checkbox" data-price="220"></td>
                    </tr>
                </tbody>
            </table>

            <section class="options">
                <h2>Options supplémentaires</h2>
                <p><strong>Billet d'avion</strong> : <span id="prix-billet" data-price="350"> 350€ </span> (vol aller-retour)</p>

                <div class="nombre-personne">
                    <h3>Nombre(s) de personne(s)</h3>
                    <label for="nombre-personnes">Nombre(s) de personne(s)</label>
                    <input id="nombre-personnes" name="nombre-personnes" type="number" min="1" max="10" value="1" required>
                </div>

                <div class="choix-hebergement">
                    <h3>Choisir votre hébergement</h3>
                    <label for="hebergement-hotel">Hôtel 4 étoiles (275€)</label>
                    <input type="radio" id="hebergement-hotel" name="hebergement" value="hotel" data-price="275" checked> <br>
                    <label for="hebergement-habitant">Chez l'habitant (80€)</label>
                    <input type="radio" id="hebergement-habitant" name="hebergement" value="habitant" data-price="80">
                </div>

                <div class="choix-duree">
                    <h3>Choisir la durée de votre séjour</h3>
                    <label for="duree-sejour">Durée du séjour</label>
                    <select name="duree" id="duree-sejour">
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
                <h2>Total complet</h2>
                <p>Prix total des activités + options : <span id="total-complet">0</span>€</p>
            </section>
            <button type="submit" class="btn-regler">Valider ma réservation</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $activites = [
            'Safari en raquettes' => 150,
            'Visite du musée dOslo' => 80,
            'La vie nocturne de la capital' => 220
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
        echo "<p>Date de début du séjour : <strong>$date_debut</strong></p>";
        echo "<p>Nombre de personnes : <strong>$nb_personnes</strong></p>";
        echo "<p>Durée du séjour : <strong>$duree jours</strong></p>";
        echo "<p>Hébergement choisi : <strong>$hebergement</strong> (" . $prix_hebergements[$hebergement] . " €/jour)</p>";
        echo "<p>Prix total des activités : <strong>$prix_options €</strong></p>";
        echo "<p>Prix total hébergement : <strong>$prix_hebergement_total €</strong></p>";
        echo "<p>Prix du billet : <strong>$billet €</strong></p>";
        echo "<p><strong>Total par personne : $prix_total_par_personne €</strong></p>";
        echo "<h3>Total général : $prix_total €</h3>";
        echo "</section>";
    }
    ?>

    <a href="paiment.php" class="btn-regler">Régler la somme</a>
    <a href="JevoyageEnNorvege.php" class="btn-retour">Retour aux offres</a>

</body>
<script src="calcul_prix.js" defer></script>
</html>