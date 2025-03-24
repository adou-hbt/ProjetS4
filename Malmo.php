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

<h1>Voyage en Suède</h1>


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
            <td>Cours de planche a voile.</td>
            <td>Prennez des cours de planche a voile sur les plages de Malmo</td>
            <td><img src="photos%20du%20site/planche_a_voile.avif" alt="Stockholm" class="img-activite"></td>
            <td>130€</td>
            <td><input type="checkbox" class="activite-checkbox"></td>
        </tr>
        <tr>
            <td>Disgusting Food Museum</td>
            <td>Visitez le Disgusting Food Museum , attraction phare de Malmo</td>
            <td><img src="photos%20du%20site/Disgusting-Food-Museum.webp" alt="Laponie" class="img-activite"></td>
            <td>220€</td>
            <td><input type="checkbox" class="activite-checkbox"></td>
        </tr>
        <tr>
            <td>Visite de la cathédrale de Saint Petri</td>
            <td>Venez visiter l'incroyable cathédrale de Saint Petri (Saint peter) </td>
            <td><img src="photos%20du%20site/st-petri-malmo.jpg" alt="Hôtel de glace" class="img-activite"></td>
            <td>190€</td>
            <td><input type="checkbox" class="activite-checkbox"></td>
        </tr>


        </tbody>
    </table>

    <section class="options">
        <h2>Options supplémentaires</h2>
        <p><strong>Billet d'avion</strong>: 400€ (vol aller-retour)</p>

        <div class ="nombre-personne">
            <h3>Nombre(s) de personne(s)</h3>
            <label for="nombre-personnes">Nombre(s) de personne(s)</label>
            <input id="nombre-personnes" name="nombre-personnes" type="number" min="1" max="10" value="1" required>
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
            <select id="duree-sejour">
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
    </section>

    <a href="paiment.php" class="btn-regler">Régler la somme</a>
</section>
<a href="JevoyageEnSuede.php" class="btn-retour">Retour aux offres</a>

</body>
</html>
