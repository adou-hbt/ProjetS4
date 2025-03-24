<?php
session_start();
require 'Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $prenom = htmlspecialchars($_POST["fname"]);
  $nom = htmlspecialchars($_POST["lname"]);
  $email = htmlspecialchars($_POST["mail"]);
  $telephone = htmlspecialchars($_POST["tel"]);
  $genre = htmlspecialchars($_POST["genre"]);
  $mot_de_passe = password_hash($_POST["mdp"], PASSWORD_DEFAULT); // Hachage du mot de passe


  $check = $bdd->prepare("SELECT id FROM utilisateurs WHERE email = ?");
  $check->execute([$email]);

  if ($check->rowCount() > 0) {
    die("Cet email est déjà utilisé. <a href='formulaire.php'>Retour</a>");
  }



  $insert = $bdd->prepare("INSERT INTO utilisateurs (prenom, nom, email, telephone, genre, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?)");

  if ($insert->execute([$prenom, $nom, $email, $telephone, $genre, $mot_de_passe])) {
    header("Location: connexion.php");
    exit();
  } else {
    die("Erreur lors de l'inscription. <a href='formulaire.php'>Réessayer</a>");
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Formulaire</title>
  <meta charset="utf-8">
  <meta name="auteur" content="Adou Humblot , Noam Edwards">
  <meta name="description" content="un site d'une agence voyage avec des itinéraires deja construit vers les pays scandinaves ">
  <meta name="keywords" content="site de voyage , voyage en scandinavie, itinéraire">
  <link rel="stylesheet" href="style.css">
</head>

<body class="inscription-page">
  <nav>
    <a class="bouton-ins" href="accueil.php"> Accueil</a>
    <a class="bouton-ins" href="presentation.php"> Qui sommes nous ?</a>
    <a class="bouton-ins" href="formulaire.php">Inscription</a>
    <a class="bouton-ins" href="Connexion.php">Connexion</a>
    <input id : class="input" placeholder="Rechercher" type="search" value="">
    <button class="search-button"></button>
  </nav>
  <div class="left-inscription"></div>
  <div class="right">
    <form method="POST">
      <h1 class="h1">Inscription</h1>
      <fieldset class="inscr_fieldset">


        <label for="fname"> Prénom :</label>
        <br>

        <input type="text" placeholder="Kiki" id="fname" name="fname" required>
        <br>

        <label for="lname"> Nom :</label>
        <br>

        <input type="text" placeholder="Kouyaté" id="lname" name="lname" required>
        <br>

        <label for="mail"> E-mail :</label>
        <br>

        <input type="email" placeholder="KikiKouyaté@gmail.com" id="mail" name="mail" required>
        <br>

        <label for="tel"> Téléphone :</label>
        <br>

        <input type="tel" placeholder="0658042459" id="tel" name="tel" required>
        <br>

        <label> Genre :</label>
        <br>
        <input type="radio" id="homme" name="genre" value="homme" checked>
        <label for="homme">Homme</label>


        <input type="radio" id="femme" name="genre" value="femme">
        <label for="femme">Femme</label>
        <br>

        <label for="mdp"> Mot de passe :</label>
        <br>

        <input type="password" id="mdp" name="mdp" required>
        <br>
        <button type="button" class="google-button">
          <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google Logo">
          Se connecter avec Google
        </button>
        <button type="submit" class="bouton-singin">Sign in</button>
      </fieldset>
    </form>
  </div>
</body>

</html>