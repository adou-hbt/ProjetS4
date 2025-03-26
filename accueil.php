<?php

$destinations = [
  "norvege" => "JevoyageEnNorvege.php",
  "suede" => "JevoyageEnSuede.php",
  "islande" => "JevoyageEnIslande.php",
  "finlande" => "JevoyageEnFinlande.php",
  "oslo" => "oslo.php",
  "tromso" => "tromso.php",
  "stockholm" => "stockholm.php",
  "vik" => "vik.php",
  "malmo" => "malmo.php",
  "helsinki" => "helsinki.php",
  "hanko" => "hanko.php",
  "inari" => "inari.php",
  "husavik" => "husavik.php",
  "uppsala" => "uppsala.php",
  "rovaniemi" => "rovaniemi.php"
];

$search_result = '';
if (isset($_GET['search'])) {
  $search = strtolower(trim($_GET['search']));
  foreach ($destinations as $nom => $lien) {
    if (str_starts_with(strtolower($nom), $search)) {
      header("Location: $lien");
      exit;
    }
  }
  $search_result = "Aucune destination trouvée.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Accueil</title>
  <meta charset="utf-8">
  <meta name="auteur" content="Adou Humblot, Noam Edwards">
  <meta name="description" content="Site d'agence de voyage vers les pays scandinaves">
  <meta name="keywords" content="voyage, Scandinavie, agence">
  <link rel="stylesheet" href="style.css">
</head>

<body class="acceuil-body">

  <h1 class="h1">Nordika Voyages</h1>
  <a href="profil.php">
    <img class="photo-profil" src="photos du site/profil.jpg" alt="Photo de profil">
  </a>

  <div class="break"></div>
  <div class="break"></div>

  <nav class="navbar">
    <a class="bouton" href="accueil.php">Accueil</a>
    <a class="bouton" href="presentation.php">Qui sommes-nous ?</a>
    <a class="bouton" href="formulaire.php">Inscription</a>
    <a class="bouton" href="Connexion.php">Connexion</a>

    <form method="GET" action="accueil.php" style="display:inline;">
      <input class="input" name="search" placeholder="Rechercher" type="search" required>
      <button type="submit">🔍</button>
    </form>
  </nav>

  <?php if ($search_result): ?>
    <p style="text-align:center; color:red;"><?= $search_result ?></p>
  <?php endif; ?>

  <div class="div_image"></div>
  <div class="break"></div>

  <h2 class="text">Voyagez en Scandinavie</h2>
  <div class="break"></div>
  <div class="break"></div>

  <iframe class="video-accueil" height="400"
    src="https://www.youtube.com/embed/f5rZ6VYHAgo?autoplay=1&mute=1"
    frameborder="0"
    allow="autoplay; encrypted-media"
    allowfullscreen>
  </iframe>

  <div class="break"></div>
  <div class="break"></div>

  <fieldset class="fieldset-voyage">
    <a class="bouton-voyage" href="Jevoyage.php">Découvrir nos offres</a>
  </fieldset>

  <footer>
    <p>© 2025 Nordika Voyages - Tous droits réservés</p>
    <a href="Admin.php" class="bouton-admin">Page Administrateur</a>
  </footer>

</body>

</html>