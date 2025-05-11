<?php $ville = 'Inari'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Voyage à Inari</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot, Noam Edwards">
    <meta name="description" content="Voyage organisé à Inari avec activités nordiques.">
    <meta name="keywords" content="voyage, Islande, Inari, Scandinave, nature">
    <link id="theme-style" rel="stylesheet" href="Choixvoyage.css">
            <script src="themeSwitcher.js" defer></script>
</head>

<body class="voyage-islande">

    <h1>Voyage à Inari (Islande)</h1>

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
                        <td>Visite du Cercle d'Or</td>
                        <td>Explorez les merveilles naturelles du Geysir à Gullfoss.</td>
                        <td><img src="photos du site/cercle-or.jpg" alt="Cercle d'Or" class="img-activite"></td>
                        <td>140€</td>
                        <td><input type="checkbox" name="activites[]" value="Visite du Cercle dOr" data-price ="140"></td>
                    </tr>
                    <tr>
                        <td>Balade en traîneau à chiens</td>
                        <td>Traversez les plaines glacées avec un attelage de chiens huskies.</td>
                        <td><img src="photos du site/traineau.jpg" alt="Traîneau" class="img-activite"></td>
                        <td>200€</td>
                        <td><input type="checkbox" name="activites[]" value="Balade en traîneau à chiens" data-price="200"></td>
                    </tr>
                    <tr>
                        <td>Excursion aux aurores boréales</td>
                        <td>Observez les aurores boréales dans un cadre spectaculaire.</td>
                        <td><img src="photos du site/aurores.jpg" alt="Aurores" class="img-activite"></td>
                        <td>250€</td>
                        <td><input type="checkbox" name="activites[]" value="Excursion aux aurores boréales" data-price="250"></td>
                    </tr>
                </tbody>
            </table>


        <section class="options">
            <h2>Options supplémentaires</h2>
            <p><strong>Billet d'avion</strong> : <span id="prix-billet" data-price="350">350€</span></p>

            <div class="nombre-personne">
                <label for="nombre-personnes">Nombre de personnes :</label>
                <input type="number" name="nombre-personnes" id="nombre-personnes" min="1" value="1" required>
            </div>

            <div class="choix-hebergement">
                <label>Hébergement :</label><br>
                <input type="radio" id="hebergement-hotel" name="hebergement" value="hotel" data-price="275" checked>
                <label for="hebergement-hotel">Hôtel 4 étoiles (275€)</label><br>
                <input type="radio" id="hebergement-habitant" name="hebergement" value="habitant" data-price="80">
                <label for="hebergement-habitant">Chez l'habitant (80€)</label>
            </div>

            <div class="choix-duree">
                <label for="duree-sejour">Durée du séjour :</label>
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
            <input type="date" name="date_debut" required>
        </section>

        <section class="total-complet">
            <h2>Total</h2>
            <p>Prix total estimé : <span id="total-complet">0</span>€</p>
        </section>
        <button type="submit" class="btn-regler">Valider ma réservation</button>
    </form>


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $activites = [
            'Visite du Cercle dOr' => 140,
            'Balade en traîneau à chiens' => 200,
            'Excursion aux aurores boréales' => 250
        ];
        $billet = 350;
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

        $prix_logement = $prix_hebergements[$hebergement] * $duree;
        $prix_par_personne = $prix_options + $prix_logement + $billet;
        $total = $prix_par_personne * $nb_personnes;

        $ligne_csv = [
            $ville,
            date('Y-m-d H:i:s'),
            $date_debut,
            $nb_personnes,
            $duree,
            $hebergement,
            $prix_options,
            $prix_logement,
            $billet,
            $prix_par_personne,
            $total
        ];

        $fichier = fopen('reservations.csv', 'a');
        fputcsv($fichier, $ligne_csv, ";");
        fclose($fichier);

        echo "<section class='recapitulatif'>";
        echo "<h2>Récapitulatif</h2>";
        echo "<p>Date de départ : <strong>$date_debut</strong></p>";
        echo "<p>Personnes : <strong>$nb_personnes</strong></p>";
        echo "<p>Durée : <strong>$duree jours</strong></p>";
        echo "<p>Hébergement : <strong>$hebergement</strong> ({$prix_hebergements[$hebergement]} €/jour)</p>";
        echo "<p>Activités : <strong>" . (!empty($activites_choisies) ? implode(', ', $activites_choisies) : "Aucune") . "</strong></p>";
        echo "<p>Activités : <strong>$prix_options €</strong></p>";
        echo "<p>Hébergement : <strong>$prix_logement €</strong></p>";
        echo "<p>Billet : <strong>$billet €</strong></p>";
        echo "<p><strong>Total par personne : $prix_par_personne €</strong></p>";
        echo "<h3>Total groupe : $total €</h3>";
        echo "</section>";
    }
    ?>

    <a href="paiment.php" class="btn-regler">Régler la somme</a>
    <a href="JevoyageEnIslande.php" class="btn-retour">Retour aux offres</a>

</body>
<script src="calcul_prix.js" defer></script
</html>