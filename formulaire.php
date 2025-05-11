<<?php
 $message = "";

 if ($_SERVER["REQUEST_METHOD"] === "POST") {
   $prenom = $_POST["fname"];
   $nom = $_POST["lname"];
   $email = $_POST["mail"];
   $telephone = $_POST["tel"];
   $genre = $_POST["genre"];
   $date_naissance = $_POST["date_naissance"];
   $mot_de_passe = $_POST["mdp"];
   $date_inscription = date("Y-m-d");
   $role = "utilisateur";

   $email_existe = false;
   if (file_exists("utilisateurs.csv")) {
     $fichier = fopen("utilisateurs.csv", "r");
     while (($ligne = fgetcsv($fichier, 0, ";")) !== false) {
       if (count($ligne) >= 3 && $ligne[2] === $email) {
         $email_existe = true;
         break;
       }
     }
     fclose($fichier);
   }

   if ($email_existe) {
     $message = "<span class='error'>❌ Cet e-mail est déjà utilisé.</span>";
   } else {
     $fichier = fopen("utilisateurs.csv", "a");
     fputcsv($fichier, [$prenom, $nom, $email, $telephone, $genre, $date_naissance, $date_inscription, $role, $mot_de_passe], ";");
     fclose($fichier);
     $message = "<span class='success'>✅ Inscription réussie !</span>";
   }
 }
 ?>

 <!DOCTYPE html>
 <html lang="fr">

 <head>
   <meta charset="utf-8">
   <title>Formulaire d'Inscription</title>
   <meta name="auteur" content="Adou Humblot, Noam Edwards">
   <meta name="description" content="Un site d'une agence de voyage avec des itinéraires déjà construits vers les pays scandinaves">
   <meta name="keywords" content="site de voyage, voyage en scandinavie, itinéraire">
   <link id="theme-style" rel="stylesheet" href="style.css">
   <script src="themeSwitcher.js" defer></script>
   <script src="formulaire.js" defer></script>
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
     <form method="POST" onsubmit="return validerFormulaire();">
       <h1 class="h1">Inscription</h1>

       <?php if (!empty($message)): ?>
         <div class="message"><?= $message ?></div>
       <?php endif; ?>

       <fieldset class="inscr_fieldset">
         <label for="fname">Prénom :</label><br>
         <input type="text" placeholder="Kiki" id="fname" name="fname" required><br>

         <label for="lname">Nom :</label><br>
         <input type="text" placeholder="Kouyaté" id="lname" name="lname" required><br>

         <label for="mail">E-mail :</label><br>
         <input type="email" placeholder="KikiKouyate@gmail.com" id="mail" name="mail" maxlength="100" required>
         <div class="char-counter" id="email-counter">0 / 100</div>

         <label for="tel">Téléphone :</label><br>
         <input type="tel" placeholder="0658042459" id="tel" name="tel" pattern="[0-9]{10}" required><br>

         <label for="date_naissance">Date de naissance :</label><br>
         <input type="date" id="date_naissance" name="date_naissance" required><br>

         <label>Genre :</label><br>
         <input type="radio" id="homme" name="genre" value="homme" checked>
         <label for="homme">Homme</label>
         <input type="radio" id="femme" name="genre" value="femme">
         <label for="femme">Femme</label>
         <br>

         <label for="mdp">Mot de passe :</label><br>
         <div class="password-container">
           <input type="password" id="mdp" name="mdp" maxlength="50" required>
           <span class="eye-icon" onclick="togglePassword()">👁️</span>
         </div>
         <div class="char-counter" id="mdp-counter">0 / 50</div>

         <button type="submit" class="bouton-singin">S'inscrire</button>
       </fieldset>
     </form>
   </div>
 </body>

 </html>