<?php
session_start();
require 'Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["mail"]);
    $mot_de_passe = $_POST["mdp"];

    // Vérifier si l'utilisateur existe
    $query = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch();

    if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
        $_SESSION["utilisateur_id"] = $user["id"];
        $_SESSION["nom"] = $user["nom"];
        echo "<script>alert('Connexion réussie !'); window.location.href='../profil.php';</script>";
        exit();
    } else {
        echo "<script>alert('Email ou mot de passe incorrect.');</script>";
    }
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