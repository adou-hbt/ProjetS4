<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Profil</title>
  <meta charset="utf-8">
  <meta name ="auteur" content="Adou Humblot , Noam Edwards">
  <meta name ="description" content="un site d'une agence voyage avec des itinéraires deja construit vers les pays scandinaves ">
  <meta name ="keywords" content="site de voyage , voyage en scandinavie, itinéraire">
  <link rel="stylesheet" href="style.css">
</head>
<body class = "profil-body">

<h1 class ="h1">Profil</h1>


  <fieldset  class = "modif_fieldset">

    <div class="photo-container">
      <img src="photos du site/profil.jpg" alt="Photo de profil" id="photo-profil">
      <button type="button" class="btn-modifier-photo">Modifier la photo</button>
    </div>


    <label for="fname"> Prénom :</label>
    <br>

    <input style = "width:90% " type="text"  value ="Manu" disabled id="fname" name="fname">
    <br>

    <label for="lname"> Nom :</label>
    <br>

    <input style = "width:90% " type="text" value = "Agbavor" disabled  id="lname" name="lname">
    <br>

    <label for="mail"> E-mail :</label>
    <br>

    <input style = "width:90% " type="email" value ="JesuislepireBU@gmail.com" disabled id="mail" name="mail">
    <br>

    <label for="tel"> Téléphone :</label>
    <br>

    <input type="tel" value = "0656542156" disabled id="tel" name="tel">
    <br>

    <label> Genre :</label>
    <br>
    <input type="radio" id="homme" name="genre" value="homme" checked>Homme
    <label for="homme"></label>


    <input type="radio" id="femme" name="genre" value="femme">
    <label for="femme">Femme</label>
    <br>

    <label for="mdp"> Mot de passe :</label>
    <br>

    <input style = "width:90% " type="password" id="mdp" name="mdp">
    <br>

    <button type="submit">Modifier</button>
    <a href="accueil.php">
      <aside style ="text-align: right; text-decoration: none; color: black;">
        <button class="bouton-admin">  Retour a l'accueil</button></aside>
    </a>
  </fieldset>
<div class="div_image">
</div>
</body>
</html>