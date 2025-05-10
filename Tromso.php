<?php $ville = 'Tromsø'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Voyage à Tromsø</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot, Noam Edwards">
    <meta name="description" content="Voyage organisé à Tromsø, Norvège, avec activités et options">
    <meta name="keywords" content="voyage, Tromsø, Norvège, Scandinavie">
    <link rel="stylesheet" href="Choixvoyage.css">
</head>

<body class="voyage-norvege">

    <h1>Voyage à Tromsø</h1>

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
                        <td>Découverte du soleil de minuit</td>
                        <td>Découvrez le phénomène du soleil de minuit sur les côtes norvégiennes.</td>
                        <td><img src="photos du site/soleil2.jpg" alt="Soleil minuit" class="img-activite"></td>
                        <td>180€</td>
                        <td><input type="checkbox" name="activites[]" value="Découverte du soleil de minuit" data-price="180"></td>
                    </tr>
                    <tr>
                        <td>Découverte des aurores</td>
                        <td>Admirez les aurores boréales au cœur de Tromsø.</td>
                        <td><img src="photos du site/tromso-aurores.webp" alt="Aurores" class="img-activite"></td>
                        <td>220€</td>
                        <td><input type="checkbox" name="activites[]" value="Découverte des aurores" data-price="220"></td>
                    </tr>
                    <tr>
                        <td>Randonnée dans les Alpes de Lyngen</td>
                        <td>Traversez les montagnes spectaculaires de la région.</td>
                        <td><img src="photos du site/lyngen-alpes.jpg" alt="Randonnée Lyngen" class="img-activite"></td>
                        <td>170€</td>
                        <td><input type="checkbox" name="activites[]" value="Randonnée dans les Alpes de Lyngen" data-price="170"></td>
                    </tr>
                </tbody>
            </table>


        <section class="options">
            <h2>Options supplémentaires</h2>
            <p><strong>Billet d'avion</strong> : <span id="prix-billet" data-price="350"> 350€</span></p>

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
            'Découverte du soleil de minuit' => 180,
            'Découverte des aurores' => 220,
            'Randonnée dans les Alpes de Lyngen' => 170
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
        fputcsv($fichier, $ligne_csv, ";");
        fclose($fichier);

        echo "<section class='recapitulatif'>";
        echo "<h2>Récapitulatif de la réservation</h2>";
        echo "<p>Date de départ : <strong>$date_debut</strong></p>";
        echo "<p>Nombre de personnes : <strong>$nb_personnes</strong></p>";
        echo "<p>Durée : <strong>$duree jours</strong></p>";
        echo "<p>Hébergement : <strong>$hebergement</strong> ({$prix_hebergements[$hebergement]} €/jour)</p>";
        echo "<p>Activités : <strong>" . (count($activites_choisies) ? implode(', ', $activites_choisies) : "Aucune") . "</strong></p>";
        echo "<p>Prix des activités : <strong>$prix_options €</strong></p>";
        echo "<p>Prix hébergement : <strong>$prix_hebergement_total €</strong></p>";
        echo "<p>Prix du billet : <strong>$billet €</strong></p>";
        echo "<p><strong>Total par personne : $prix_total_par_personne €</strong></p>";
        echo "<h3>Total groupe : $prix_total €</h3>";
        echo "</section>";
    }
    ?>

    <a href="paiment.php" class="btn-regler">Régler la somme</a>
    <a href="JevoyageEnNorvege.php" class="btn-retour">Retour aux offres</a>

</body>
<script src="calcul_prix.js" defer></script>
</html>