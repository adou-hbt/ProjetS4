<?php $ville = 'Husavik'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Voyage à Husavik - Islande</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot, Noam Edwards">
    <meta name="description" content="Voyage organisé en Islande avec activités et options d'hébergement">
    <meta name="keywords" content="voyage, Islande, Husavik, tourisme">
    <link id="theme-style" rel="stylesheet" href="Choixvoyage.css">
            <script src="themeSwitcher.js" defer></script>
</head>

<body class="voyage-islande">

    <h1>Voyage à Husavik</h1>

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
                        <td>Croisière à la découverte des baleines</td>
                        <td>Venez observer les baleines au cours de nos croisières.</td>
                        <td><img src="photos du site/baleine.jpg" alt="Baleines" class="img-activite"></td>
                        <td>150€</td>
                        <td><input type="checkbox" name="activites[]" value="Croisière à la découverte des baleines" data-price="150"></td>
                    </tr>
                    <tr>
                        <td>Randonnée sur glacier</td>
                        <td>Explorez les glaciers islandais avec un guide expérimenté.</td>
                        <td><img src="photos du site/glacier.jpg" alt="Glacier" class="img-activite"></td>
                        <td>180€</td>
                        <td><input type="checkbox" name="activites[]" value="Randonnée sur glacier" data-price="180"></td>
                    </tr>
                    <tr>
                        <td>Découverte des sources chaudes</td>
                        <td>Relaxez-vous dans les sources chaudes naturelles de l'Islande.</td>
                        <td><img src="photos du site/sources-chaudes.jpg" alt="Sources chaudes" class="img-activite"></td>
                        <td>120€</td>
                        <td><input type="checkbox" name="activites[]" value="Découverte des sources chaudes" data-price="120"></td>
                    </tr>
                </tbody>
            </table>

            <section class="options">
                <h2>Options supplémentaires</h2>
                <p><strong>Billet d'avion</strong> : <span id="prix-billet" data-price="350"> 350€</span> </p>

                <div class="nombre-personne">
                    <h3>Nombre de personnes</h3>
                     <label for="nombre-personnes">Nombre(s) de personne(s)</label>
                    <input id="nombre-personnes" type="number" name="nombre-personnes" min="1" max="10" value="1" required>
                </div>

                <div class="choix-hebergement">
                    <h3>Hébergement</h3>
                    <input type="radio" id="hebergement-hotel" name="hebergement" value="hotel" data-price="275" checked>
                    <label for="hebergement-hotel">Hôtel 4 étoiles (275€)</label><br>
                    <input type="radio" id="hebergement-habitant" name="hebergement" value="habitant" data-price="80">
                    <label for="hebergement-habitant">Chez l'habitant (80€)</label>
                </div>

                <div class="choix-duree">
                    <h3>Durée du séjour</h3>
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
                <h2>Date de départ</h2>
                 <label for="date-depart">Date de départ :</label>
                <input type="date" name="date_debut" required>
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
            'Croisière à la découverte des baleines' => 150,
            'Randonnée sur glacier' => 180,
            'Découverte des sources chaudes' => 120
        ];

        $billet = 350;
        $prix_hebergements = ['hotel' => 275, 'habitant' => 80];

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
        echo "<p>Date de début : <strong>$date_debut</strong></p>";
        echo "<p>Nombre de personnes : <strong>$nb_personnes</strong></p>";
        echo "<p>Durée : <strong>$duree jours</strong></p>";
        echo "<p>Hébergement : <strong>$hebergement</strong> (" . $prix_hebergements[$hebergement] . "€/jour)</p>";
        echo "<p>Activités : <strong>" . (!empty($activites_choisies) ? implode(', ', $activites_choisies) : 'Aucune') . "</strong></p>";
        echo "<p>Prix activités : <strong>$prix_options €</strong></p>";
        echo "<p>Prix hébergement : <strong>$prix_hebergement_total €</strong></p>";
        echo "<p>Billet d'avion : <strong>$billet €</strong></p>";
        echo "<p>Total par personne : <strong>$prix_total_par_personne €</strong></p>";
        echo "<h3>Total général : $prix_total €</h3>";
        echo "</section>";
    }
    ?>

    <a href="paiment.php" class="btn-regler">Régler la somme</a>
    <a href="JevoyageEnIslande.php" class="btn-retour">Retour aux offres</a>

</body>
<script src="calcul_prix.js" defer></script>
</html>