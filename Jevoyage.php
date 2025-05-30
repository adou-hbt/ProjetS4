<!DOCTYPE html>
<html lang="fr">
  <head><title>Voyage</title>
    <meta charset="utf-8">
    <meta name ="auteur" content="Adou Humblot , Noam Edwards">
    <meta name ="description" content="un site d'une agence voyage avec des itinéraires deja construit vers les pays scandinaves ">
    <meta name ="keywords" content="site de voyage , voyage en scandinavie, itinéraire">
    <link id="theme-style" rel="stylesheet" href="Voyage.css">
    <script src="themeSwitcher.js" defer></script>
  </head>

<body>
<div class="div_fond"></div>
<table width="100%">
  <tr>
    <td><h1 class="h1">Découvrez Nos Voyages</h1></td>
    <td align="right"><a href="accueil.php" style ="font-size:150%; color: white; text-decoration: none" >
      <bouton class="bouton-retour"> Retour à l'accueil</bouton></a><button class ="bouton-retour" onclick="switchTheme()">️☀</button></td>

  </tr>
</table>
<section class="voyage">
  <a></a>
  <a href="JevoyageEnNorvege.php" class="voyage-card">
    <img src="photos du site/rando-norvege.jpg" alt="Voyage dans le froid Norvégien"  style ="height: 50%; width: 100%;" class = "voyage-img">
    <img src="photos du site/norvege.png" alt="Norvege" class="flag-img">

    <h2 class="voyage-title">Voyage en Norvege</h2>
    <p class="voyage-description">Découvrez la grandeur des fjords majestueux et ressentez la magie du Nord en naviguant entre falaises vertigineuses et eaux cristallines.</p>

  <a href="JevoyageEnSuede.php" class="voyage-card">
    <img src="photos du site/suede%20ville.jpg" alt="Voyage dans le froid Suedois" class="voyage-img" style ="height: 50%; width: 100%;">
    <img src="photos du site/suede.png" alt="Norvege" class="flag-img">
    <h2 class="voyage-title">Voyage en Suède</h2>
    <p class="voyage-description">Explorez l’immensité des forêts boréales et laissez-vous envoûter par le silence des lacs scintillants, où la nature règne en maître.</p>
  </a>

  <a href="JevoyageEnIslande.php" class="voyage-card">
    <img src="photos du site/Isl-paysa.jpg" alt="Voyage dans le paradis Islandais" class="voyage-img" style ="height: 50%; width: 100%;">
    <img src="photos du site/islande.png" alt="Islande" class="flag-img">
    <h2 class="voyage-title">Voyage en Islande</h2>
    <p class="voyage-description">Vivez l’intensité des terres volcaniques et ressentez la puissance de la nature en marchant entre glaciers étincelants et geysers bouillonnants.</p>
  </a>
  <a href="JevoyageEnFinlande.php" class="voyage-card">
    <img src="photos du site/FinlandeLoup.webp" alt="Voyage dans le monde Finlandais" class="voyage-img" style ="height: 50%; width: 100%;">
    <img src="photos du site/finlande.png" alt="Norvege" class="flag-img">
    <h2 class="voyage-title">Voyage en Finlande</h2>
    <p class="voyage-description">Plongez au cœur des paysages enneigés et savourez la sérénité des nuitées sous les aurores boréales, dans un décor digne d’un conte nordique</p>
  </a>
   </a>
  </section>
</body>
</html>