<?php
session_start();

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION["utilisateur"])) {
    header("Location: Connexion.php");
    exit();
}

$csv_file = "utilisateurs.csv";
$utilisateur = $_SESSION["utilisateur"];

// Données de session
$prenom = $utilisateur['prenom'];
$nom = $utilisateur['nom'];
$email = $utilisateur['email'];
$telephone = $utilisateur['telephone'];
$genre = $utilisateur['genre'];
$date_naissance = $utilisateur['date_naissance'];
$date_inscription = $utilisateur['date_inscription'];
$role = $utilisateur['role'];
$mot_de_passe = $utilisateur['mot_de_passe'];

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ancien_email = $_POST["ancien_email"] ?? $email;

    $nouveau_prenom = $_POST["prenom"] ?? $prenom;
    $nouveau_nom = $_POST["nom"] ?? $nom;
    $nouvel_email = $_POST["email"] ?? $email;
    $nouveau_tel = $_POST["telephone"] ?? $telephone;
    $nouveau_genre = $_POST["genre"] ?? $genre;
    $nouveau_mdp = empty($_POST["mot_de_passe"]) ? $mot_de_passe : $_POST["mot_de_passe"];

    // Vérification de champs obligatoires
    if (empty($nouveau_prenom) || empty($nouveau_nom) || empty($nouvel_email) || empty($nouveau_tel)) {
        die("Veuillez remplir tous les champs obligatoires.");
    }

    $lignes = file($csv_file, FILE_IGNORE_NEW_LINES);
    $nouveau_contenu = [];

    foreach ($lignes as $ligne) {
        if (trim($ligne) === "") continue;

        $colonnes = str_getcsv($ligne, ";");
        if (count($colonnes) >= 9 && $colonnes[2] === $ancien_email) {
            $colonnes[0] = $nouveau_prenom;
            $colonnes[1] = $nouveau_nom;
            $colonnes[2] = $nouvel_email;
            $colonnes[3] = $nouveau_tel;
            $colonnes[4] = $nouveau_genre;
            $colonnes[8] = $nouveau_mdp;
            $ligne = implode(";", $colonnes);
        }
        $nouveau_contenu[] = $ligne;
    }

    file_put_contents($csv_file, implode("\n", $nouveau_contenu));

    $_SESSION["utilisateur"] = [
        'prenom' => $nouveau_prenom,
        'nom' => $nouveau_nom,
        'email' => $nouvel_email,
        'telephone' => $nouveau_tel,
        'genre' => $nouveau_genre,
        'date_naissance' => $date_naissance,
        'date_inscription' => $date_inscription,
        'role' => $role,
        'mot_de_passe' => $nouveau_mdp
    ];

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
    <link id="theme-style" rel="stylesheet" href="style.css">
    <script src="themeSwitcher.js" defer></script>
</head>

<body class="profil-body">
    <h1 class="h1">Mon Profil</h1>
    <form method="POST">
        <fieldset class="modif_fieldset">
            <div class="photo-container">
                <img src="photos du site/profil.jpg" alt="Photo de profil">
            </div>

            <input type="hidden" name="ancien_email" value="<?= $email ?>">

            <?php
            $champs = [
                'prenom' => ['label' => 'Prénom', 'type' => 'text', 'valeur' => $prenom],
                'nom' => ['label' => 'Nom', 'type' => 'text', 'valeur' => $nom],
                'email' => ['label' => 'Email', 'type' => 'email', 'valeur' => $email],
                'telephone' => ['label' => 'Téléphone', 'type' => 'tel', 'valeur' => $telephone],
                'mot_de_passe' => ['label' => 'Mot de passe', 'type' => 'password', 'valeur' => $mot_de_passe]

            ];

            foreach ($champs as $id => $info) {
                echo "<label for='$id'>{$info['label']} :</label><br>";
                echo "<input type='{$info['type']}' id='$id' name='$id' value='{$info['valeur']}' disabled><br>";
                echo "<button type='button' onclick='modifier(\"$id\")'>Modifier</button>";
                echo "<button type='button' onclick='annuler(\"$id\")'>Annuler</button><br><br>";
            }
            ?>

            <label>Genre :</label><br>
            <input type="radio" name="genre" id="homme" value="homme" <?= $genre === "homme" ? "checked" : "" ?> disabled> Homme
            <input type="radio" name="genre" id="femme" value="femme" <?= $genre === "femme" ? "checked" : "" ?> disabled> Femme
            <br>
            <button type="button" onclick="modifierGenre()">Modifier</button>
            <button type="button" onclick="annulerGenre()">Annuler</button><br><br>

            <button type="submit">Confirmer les modifications</button>

            <a class="bouton-admin" href="accueil.php">
                <aside>Retour à l'accueil</aside>
            </a>
        </fieldset>
    </form>

    <div class="div_image"></div>

    <script>
        const valeursInitiales = {};

        function modifier(id) {
            const champ = document.getElementById(id);
            if (!(id in valeursInitiales)) {
                valeursInitiales[id] = champ.value;
            }
            champ.disabled = false;
        }

        function annuler(id) {
            const champ = document.getElementById(id);
            if (id in valeursInitiales) {
                champ.value = valeursInitiales[id];
            }
            champ.disabled = true;
        }

        function modifierGenre() {
            const radioChecked = document.querySelector('input[name="genre"]:checked');
            if (radioChecked) {
                valeursInitiales['genre'] = radioChecked.value;
            }
            document.getElementById('homme').disabled = false;
            document.getElementById('femme').disabled = false;
        }

        function annulerGenre() {
            const ancien = valeursInitiales['genre'];
            if (ancien === "homme") document.getElementById('homme').checked = true;
            if (ancien === "femme") document.getElementById('femme').checked = true;
            document.getElementById('homme').disabled = true;
            document.getElementById('femme').disabled = true;
        }
    </script>
</body>

</html>
