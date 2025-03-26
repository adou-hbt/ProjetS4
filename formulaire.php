<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $prenom = $_POST["fname"];
  $nom = $_POST["lname"];
  $email = $_POST["mail"];
  $telephone = $_POST["tel"];
  $genre = $_POST["genre"];
  $date_naissance = $_POST["date_naissance"];
  $date_inscription = date("Y-m-d");
  $role = "utilisateur";
  $mot_de_passe = $_POST["mdp"]; // PAS haché

  // Vérifie si l'email existe déjà
  $email_existe = false;
  if (($file = fopen("utilisateurs.csv", "r")) !== false) {
    while (($ligne = fgetcsv($file, 0, ";")) !== false) {
      if ($ligne[2] === $email) {
        $email_existe = true;
        break;
      }
    }
    fclose($file);
  }

  if (!$email_existe) {
    $file = fopen("utilisateurs.csv", "a");
    fputcsv($file, [$prenom, $nom, $email, $telephone, $genre, $date_naissance, $date_inscription, $role, $mot_de_passe], ";");
    fclose($file);
    echo "<p style='color: green;'>Inscription réussie !</p>";
  } else {
    echo "<p style='color: red;'>Un compte avec cet e-mail existe déjà.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Formulaire d'Inscription</title>
  <meta charset="utf-8">
  <meta name="auteur" content="Adou Humblot, Noam Edwards">
  <meta name="description" content="Un site d'une agence de voyage avec des itinéraires déjà construits vers les pays scandinaves">
  <meta name="keywords" content="site de voyage, voyage en scandinavie, itinéraire">
  <link rel="stylesheet" href="style.css">
</head>

<body class="inscription-page">
  <nav>
    <a class="bouton-ins" href="accueil.php">Accueil</a>
    <a class="bouton-ins" href="presentation.php">Qui sommes-nous ?</a>
    <a class="bouton-ins" href="formulaire.php">Inscription</a>
    <a class="bouton-ins" href="Connexion.php">Connexion</a>
  </nav>

  <div class="left-inscription"></div>
  <div class="right">
    <form method="POST" action="">
      <h1 class="h1">Inscription</h1>
      <fieldset class="inscr_fieldset">

        <label for="fname">Prénom :</label>
        <br>
        <input type="text" placeholder="Kiki" id="fname" name="fname" required>
        <br>

        <label for="lname">Nom :</label>
        <br>
        <input type="text" placeholder="Kouyaté" id="lname" name="lname" required>
        <br>

        <label for="mail">E-mail :</label>
        <br>
        <input type="email" placeholder="KikiKouyaté@gmail.com" id="mail" name="mail" required>
        <br>

        <label for="tel">Téléphone :</label>
        <br>
        <input type="tel" placeholder="0658042459" id="tel" name="tel" required>
        <br>

        <label for="date_naissance">Date de naissance :</label>
        <br>
        <input type="date" id="date_naissance" name="date_naissance" required>
        <br>

        <label>Genre :</label>
        <br>
        <input type="radio" id="homme" name="genre" value="homme" checked>
        <label for="homme">Homme</label>
        <input type="radio" id="femme" name="genre" value="femme">
        <label for="femme">Femme</label>
        <br>

        <label for="mdp">Mot de passe :</label>
        <br>
        <input type="password" id="mdp" name="mdp" required>
        <br>

        <button type="button" class="google-button">
          <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google Logo">
          Se connecter avec Google
        </button>

        <button type="submit" class="bouton-singin">S'inscrire</button>
      </fieldset>
    </form>
  </div>
</body>

</html>