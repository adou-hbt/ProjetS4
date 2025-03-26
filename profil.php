<?php
session_start();

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION["utilisateur"])) {
    header("Location: Connexion.php");
    exit();
}

$csv_file = "utilisateurs.csv";
$utilisateur = $_SESSION["utilisateur"];

// Champs récupérés
$prenom = $utilisateur['prenom'];
$nom = $utilisateur['nom'];
$email = $utilisateur['email'];
$telephone = $utilisateur['telephone'];
$genre = $utilisateur['genre'];
$date_naissance = $utilisateur['date_naissance'];
$date_inscription = $utilisateur['date_inscription'];
$role = $utilisateur['role'];
$mot_de_passe = $utilisateur['mot_de_passe'];

// Traitement de la mise à jour
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirmer"])) {
    $nouveau_prenom = $_POST["prenom"];
    $nouveau_nom = $_POST["nom"];
    $nouveau_tel = $_POST["telephone"];
    $nouveau_genre = $_POST["genre"];
    $nouveau_mdp = $_POST["mot_de_passe"];

    $lignes = file($csv_file);
    $nouveau_contenu = [];

    foreach ($lignes as $ligne) {
        $colonnes = str_getcsv(trim($ligne), ";");

        if (count($colonnes) >= 9 && $colonnes[2] === $email) {
            // On remplace cette ligne
            $colonnes[0] = $nouveau_prenom;
            $colonnes[1] = $nouveau_nom;
            $colonnes[3] = $nouveau_tel;
            $colonnes[4] = $nouveau_genre;
            $colonnes[8] = $nouveau_mdp;
            $ligne = implode(";", $colonnes);
        }

        $nouveau_contenu[] = $ligne;
    }

    file_put_contents($csv_file, implode("\n", $nouveau_contenu));

    // Mise à jour de la session
    $_SESSION["utilisateur"]['prenom'] = $nouveau_prenom;
    $_SESSION["utilisateur"]['nom'] = $nouveau_nom;
    $_SESSION["utilisateur"]['telephone'] = $nouveau_tel;
    $_SESSION["utilisateur"]['genre'] = $nouveau_genre;
    $_SESSION["utilisateur"]['mot_de_passe'] = $nouveau_mdp;

    // Reload pour afficher les nouvelles données
    header("Location: profil.php");
    exit();
}
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
    <form method="POST">
        <fieldset class="modif_fieldset">
            <div class="photo-container">
                <img src="photos du site/profil.jpg" alt="Photo de profil" id="photo-profil">
                <button type="button" class="btn-modifier-photo">Modifier la photo</button>
            </div>

            <label for="fname">Prénom :</label><br>
            <input type="text" name="prenom" value="<?= $prenom ?>" id="prenom" disabled><br>


            <label for="lname">Nom :</label><br>
            <input type="text" name="nom" value="<?= $nom ?>" id="nom" disabled><br>

            <label for="mail">E-mail :</label><br>
            <input type="email" value="<?= $email ?>" disabled><br>

            <label for="tel">Téléphone :</label><br>
            <input type="tel" name="telephone" value="<?= $telephone ?>" id="telephone" disabled><br>

            <label>Genre :</label><br>
            <input type="radio" name="genre" value="homme" <?= $genre === "homme" ? "checked" : "" ?> disabled> Homme
            <input type="radio" name="genre" value="femme" <?= $genre === "femme" ? "checked" : "" ?> disabled> Femme
            <br><br>

            <label>Mot de passe :</label><br>
            <input type="password" name="mot_de_passe" value="<?= $mot_de_passe ?>" id="mot_de_passe" disabled><br><br>

            <button type="button" onclick="activerChamps()">Modifier</button>
            <button type="submit" name="confirmer" id="btn-confirmer" style="display:none;">Confirmer</button>


            <a href="accueil.php">
                <aside style="text-align: right; text-decoration: none; color: black;">
                    <button class="bouton-admin">Retour à l'accueil</button>
                </aside>
            </a>
        </fieldset>
    </form>
    <script>
        function activerChamps() {
            document.getElementById("prenom").disabled = false;
            document.getElementById("nom").disabled = false;
            document.getElementById("telephone").disabled = false;
            document.getElementsByName("genre")[0].disabled = false;
            document.getElementsByName("genre")[1].disabled = false;
            document.getElementById("mot_de_passe").disabled = false;
            document.getElementById("btn-confirmer").style.display = "inline-block";
        }
    </script>
    <div class="div_image"></div>

</body>

</html>