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
            <td>Visite du Cercle d'Or</td>
            <td>Explorez les sites emblématiques de l'Islande comme le Geysir et la cascade Gullfoss.</td>
            <td><img src="photos du site/cercle-or.jpg" alt="Cercle d'Or" class="img-activite"></td>
            <td>150€</td>
            <td><input type="checkbox" class="activite-checkbox"></td>
        </tr>
        <tr>
            <td>Balade en traîneau à chiens</td>
            <td>Vivez une expérience inoubliable en traîneau à chiens à travers les paysages glacés.</td>
            <td><img src="photos du site/traineau.jpg" alt="Traîneau à chiens" class="img-activite"></td>
            <td>200€</td>
            <td><input type="checkbox" class="activite-checkbox"></td>
        </tr>
        <tr>
            <td>Excursion aux aurores boréales</td>
            <td>Un spectacle magique dans le ciel nocturne islandais.</td>
            <td><img src="photos du site/aurores.jpg" alt="Aurores boréales" class="img-activite"></td>
            <td>250€</td>
            <td><input type="checkbox" class="activite-checkbox"></td>
        </tr>
        <tr>
            <td>Randonnée sur glacier</td>
            <td>Explorez les glaciers islandais avec un guide expérimenté.</td>
            <td><img src="photos du site/glacier.jpg" alt="Randonnée sur glacier" class="img-activite"></td>
            <td>180€</td>
            <td><input type="checkbox" class="activite-checkbox"></td>
        </tr>
        <tr>
            <td>Découverte des sources chaudes</td>
            <td>Relaxez-vous dans les sources chaudes naturelles de l'Islande.</td>
            <td><img src="photos du site/sources-chaudes.jpg" alt="Sources chaudes" class="img-activite"></td>
            <td>120€</td>
            <td><input type="checkbox" class="activite-checkbox"></td>
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
        <a href="paiment.html" class="btn-regler">Régler la somme</a>

    </section>
</section>
<a href="Jevoyage.html" class="btn-retour">Retour aux offres</a>

</body>
</html>