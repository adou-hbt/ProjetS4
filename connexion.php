<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["mail"];
    $mot_de_passe = $_POST["mdp"];
    $trouve = false;

    if (($file = fopen("utilisateurs.csv", "r")) !== false) {
        while (($ligne = fgetcsv($file, 0, ";")) !== false) {
            if ($ligne[2] === $email && $ligne[8] === $mot_de_passe) {
                $_SESSION["utilisateur"] = [
                    "prenom" => $ligne[0],
                    "nom" => $ligne[1],
                    "email" => $ligne[2],
                    "telephone" => $ligne[3],
                    "genre" => $ligne[4],
                    "date_naissance" => $ligne[5],
                    "date_inscription" => $ligne[6],
                    "role" => $ligne[7],
                    "mot_de_passe" => $ligne[8]
                ];
                $_SESSION["login"] = $ligne[2];
                file_put_contents("debug_session.txt", "SESSION définie à : " . $_SESSION["login"] . "\n", FILE_APPEND);
                $trouve = true;
                break;
            }
        }
        fclose($file);
    }

    if ($trouve) {
        header("Location: profil.php");
        exit();
    } else {
        echo "<p style='color: red;'>Identifiants incorrects.</p>";
    }
}
?>

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot , Noam Edwards">
    <meta name="description" content="un site d'une agence voyage avec des itinéraires déjà construits vers les pays scandinaves">
    <meta name="keywords" content="site de voyage , voyage en scandinavie, itinéraire">
    <link id="theme-style" rel="stylesheet" href="style.css">
      <script src="themeSwitcher.js" defer></script>
</head>

<body class="inscription-page">
    <nav>
        <a class="bouton-ins" href="accueil.php">Accueil</a>
        <a class="bouton-ins" href="presentation.php">Qui sommes-nous ?</a>
        <a class="bouton-ins" href="formulaire.php">Inscription</a>
        <a class="bouton-ins" href="Connexion.php">Connexion</a>

        
    </nav>

    <div class="left-connexion"></div>
    <div class="right">
        <form method="POST" action="">
            <h1 class="h1">Connexion</h1>
            <fieldset class="inscr_fieldset">

                <label for="mail">E-mail :</label>
                <br>
                <input type="email" id="mail" name="mail" required>
                <br>

                <label for="mdp">Mot de passe :</label>
                <br>
                <input type="password" id="mdp" name="mdp" required>
                <br>

                <button type="submit">Se connecter</button>
            </fieldset>
        </form>
    </div>

</body>

</html>