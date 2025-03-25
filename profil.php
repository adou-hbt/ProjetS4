<?php
 session_start();

 // Redirection si l'utilisateur n'est pas connecté
 if (!isset($_SESSION["utilisateur"])) {
     header("Location: Connexion.php");
     exit();
 }

 // Récupération des infos depuis la session
 $utilisateur = $_SESSION["utilisateur"];

 $prenom = isset($utilisateur['prenom']) ? $utilisateur['prenom'] : '';
 $nom = isset($utilisateur['nom']) ? $utilisateur['nom'] : '';
 $email = isset($utilisateur['email']) ? $utilisateur['email'] : '';
 $telephone = isset($utilisateur['telephone']) ? $utilisateur['telephone'] : '';
 $genre = isset($utilisateur['genre']) ? $utilisateur['genre'] : '';
 $mot_de_passe = isset($utilisateur['mot_de_passe']) ? $utilisateur['mot_de_passe'] : '';
 ?>
 <!DOCTYPE html>
 <html lang="fr">

 <head>
     <meta charset="UTF-8">
     <title>Profil</title>
     <meta name="auteur" content="Adou Humblot , Noam Edwards">
     <meta name="description" content="Un site d'une agence de voyage avec des itinéraires vers les pays scandinaves">
     <meta name="keywords" content="site de voyage, scandinavie, itinéraire">
     <link rel="stylesheet" href="style.css">
 </head>

 <body class="profil-body">

     <h1 class="h1">Profil</h1>

     <fieldset class="modif_fieldset">
         <div class="photo-container">
             <img src="photos du site/profil.jpg" alt="Photo de profil" id="photo-profil">
             <button type="button" class="btn-modifier-photo">Modifier la photo</button>
         </div>

         <label for="fname">Prénom :</label><br>
         <input style="width:90%" type="text" value="<?= $prenom ?>" disabled id="fname" name="fname"><br>

         <label for="lname">Nom :</label><br>
         <input style="width:90%" type="text" value="<?= $nom ?>" disabled id="lname" name="lname"><br>

         <label for="mail">E-mail :</label><br>
         <input style="width:90%" type="email" value="<?= $email ?>" disabled id="mail" name="mail"><br>

         <label for="tel">Téléphone :</label><br>
         <input style="width:90%" type="tel" value="<?= $telephone ?>" disabled id="tel" name="tel"><br>

         <label>Genre :</label><br>
         <input type="radio" id="homme" name="genre" value="homme" <?= ($genre === 'homme') ? 'checked' : '' ?> disabled> Homme
         <input type="radio" id="femme" name="genre" value="femme" <?= ($genre === 'femme') ? 'checked' : '' ?> disabled> Femme
         <br>

         <label for="mdp">Mot de passe :</label><br>
         <input style="width:90%" type="password" value="<?= $mot_de_passe ?>" disabled id="mdp" name="mdp"><br>

         <button type="submit">Modifier</button>

         <a href="accueil.php">
             <aside style="text-align: right; text-decoration: none; color: black;">
                 <button class="bouton-admin">Retour à l'accueil</button>
             </aside>
         </a>
     </fieldset>

     <div class="div_image"></div>

 </body>

 </html>
