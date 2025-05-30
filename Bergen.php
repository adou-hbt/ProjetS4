<?php $ville = 'Bergen'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Voyage en Norvège - Bergen</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot , Noam Edwards">
    <meta name="description" content="Un site d'une agence de voyage avec des itinéraires déjà construits vers les pays scandinaves">
    <meta name="keywords" content="site de voyage , voyage en Scandinavie, itinéraire">
    <link id="theme-style" rel="stylesheet" href="Choixvoyage.css">
            <script src="themeSwitcher.js" defer></script>
</head>

<body class="voyage-norvege">

    <h1>Voyage à Bergen</h1>

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
                        <td>Croisière dans les fjords</td>
                        <td>Explorez les fjords majestueux de la Norvège lors d'une croisière inoubliable.</td>
                        <td><img src="photos du site/fjord-norvege.jpg" alt="Fjord" class="img-activite"></td>
                        <td>200€</td>
                        <td><input type="checkbox" name="activites[]" value="Croisière dans les fjords" class="activite-checkbox" data-price="200"></td>
                    </tr>
                    <tr>
                        <td>Visite de l'aquarium de Bergen</td>
                        <td>Visitez l'exceptionnel aquarium de Bergen avec ses créatures marines uniques.</td>
                        <td><img src="photos du site/aquarium_bergen.webp" alt="Aquarium" class="img-activite"></td>
                        <td>150€</td>
                        <td><input type="checkbox" name="activites[]" value="Visite de l'aquarium de Bergen" class="activite-checkbox " data-price="150"></td>
                    </tr>
                    <tr>
                        <td>Visite des chutes de Hardangerfjord</td>
                        <td>Participez à une excursion au cœur des spectaculaires chutes d'eau du Hardangerfjord.</td>
                        <td><img src="photos du site/hardangerfjord.jpg" alt="Chutes Hardangerfjord" class="img-activite"></td>
                        <td>180€</td>
                        <td><input type="checkbox" name="activites[]" value="Visite des chutes de Hardangerfjord" class="activite-checkbox" data-price="180"></td>
                    </tr>
                </tbody>
            </table>

            <section class="options">
                <h2>Options supplémentaires</h2>
                <p><strong>Billet d'avion</strong> : <span id="prix-billet" data-price="350"> 350€ (vol aller-retour)</span></p>

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
                <h2>Total complet</h2>
                <p>Prix total des activités + options : <span id="total-complet">0</span>€</p>

            </section>
        <button type="submit" class="btn-regler">Valider ma réservation</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $activites = [
            'Croisière dans les fjords' => 200,
            'Visite de l\'aquarium de Bergen' => 150,
            'Visite des chutes de Hardangerfjord' => 180
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
        echo "<p>Activités sélectionnées : <strong>" . (!empty($activites_choisies) ? implode(', ', $activites_choisies) : "Aucune") . "</strong></p>";
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
<script src="calcul_prix.js" defer></script>>
</html>