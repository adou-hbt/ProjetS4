<?php
session_start(); // Ajout de session_start() pour utiliser les sessions

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $mot_de_passe = $_POST['mdp'];

    $file = "utilisateurs.json";
    if (!file_exists($file)) {
        echo "Aucun utilisateur enregistré";
        exit();
    }

    $utilisateurs = json_decode(file_get_contents($file), true);

    foreach ($utilisateurs as $user) {
        if ($user['mail'] === $mail && password_verify($mot_de_passe, $user['mdp'])) {
            $_SESSION["utilisateur_id"] = $user["id"];
            $_SESSION["nom"] = $user["nom"];
            echo "Connexion réussie !";
            exit();
        }
    }

    echo "Email ou mot de passe incorrect.";
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Connexion</title>
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
    <div class="left-connexion"></div>
    <div class="right">
        <form method="POST">
            <h1 class="h1">Connexion</h1>
            <fieldset class="inscr_fieldset">

                <label for="mail"> E-mail :</label>
                <br>

                <input type="mail" id="mail" name="mail" required>
                <br>

                <label for="mdp"> Mot de passe :</label>
                <br>

                <input type="password" id="mdp" name="mdp" required>
                <br>

                <button type="submit">Sign in</button>
            </fieldset>
        </form>
    </div>

</body>

</html>