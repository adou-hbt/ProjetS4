<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Voyage en Finlande</title>
  <meta charset="utf-8">
  <meta name="auteur" content="Adou Humblot, Noam Edwards">
  <meta name="description" content="Voyage organisé en Finlande avec diverses activités et options d'hébergement">
  <meta name="keywords" content="voyage, Finlande, Scandinavie, tourisme">
  <link rel="stylesheet" href="Choixvoyage.css">
</head>
<body class="voyage-finlande">

<h1>Voyage en Finlande</h1>


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
      <td>Visite du musée de Hanko</td>
      <td>Venez vous cultivez à propos de la Finlande.</td>
      <td><img src="photos%20du%20site/Hankomusee.jpg" alt="Motoneige" class="img-activite"></td>
      <td>200€</td>
      <td><input type="checkbox" class="activite-checkbox"></td>
    </tr>
    <tr>
      <td>Spa au bord de mer</td>
      <td>Profitez du meilleur au bord de mer de Finlande.</td>
      <td><img src="photos%20du%20site/Spahanko.jpg" alt="Randonnée en raquettes" class="img-activite"></td>
      <td>140€</td>
      <td><input type="checkbox" class="activite-checkbox"></td>
    </tr>
    <tr>
      <td>Baignade dans un lac gelé et sauna</td>
      <td>Expérience typiquement finlandaise entre chaleur et froid intense.</td>
      <td><img src="photos%20du%20site/sauna-finlandais.jpg" alt="Sauna finlandais" class="img-activite"></td>
      <td>160€</td>
      <td><input type="checkbox" class="activite-checkbox"></td>
    </tr>
    </tbody>
  </table>

  <section class="options">
    <h2>Options supplémentaires</h2>
    <p><strong>Billet d'avion</strong>: 380€ (vol aller-retour)</p>

    <div class ="nombre-personne">
      <h3>Nombre(s) de personne(s)</h3>
      <label for="nombre-personnes">Nombre(s) de personne(s)</label>
      <input id="nombre-personnes" name="nombre-personnes" type="number" min="1" max="10" value ="1" required>
    </div>

    <div class="choix-hebergement">
      <h3>Choisir votre hébergement</h3>
      <label for="hebergement-hotel">Hôtel 4 étoiles (275€)</label>
      <input type="radio" id="hebergement-hotel" name="hebergement" value="hotel" checked> <br>
      <label for="hebergement-habitant">Chez l'habitant (80€) </label>
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
<a href="JevoyageEnFinlande.php" class="btn-retour">Retour aux offres</a>

</body>
</html>
