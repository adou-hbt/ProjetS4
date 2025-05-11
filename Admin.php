<?php
session_start();

if (!isset($_SESSION["utilisateur"]) || $_SESSION["utilisateur"]["role"] !== "admin") {
    header("Location: Connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"], $_POST["user_id"])) {
    $user_id = (int)$_POST["user_id"];
    $action = $_POST["action"];

    $rows = [];
    if (($file = fopen("utilisateurs.csv", "r")) !== false) {
        while (($data = fgetcsv($file, 0, ";")) !== false) {
            $rows[] = $data;
        }
        fclose($file);
    }

    if (isset($rows[$user_id])) {
        if ($action === "changer_role") {
            $actuel = $rows[$user_id][7];
            $rows[$user_id][7] = ($actuel === "admin") ? "utilisateur" : "admin";
        }

        if (($file = fopen("utilisateurs.csv", "w")) !== false) {
            foreach ($rows as $ligne) {
                fputcsv($file, $ligne, ";");
            }
            fclose($file);
        }

        header("Location: admin.php");
        exit();
    }
}

$utilisateurs = [];
if (($file = fopen("utilisateurs.csv", "r")) !== false) {
    $ligne_num = 0;
    while (($ligne = fgetcsv($file, 0, ";")) !== false) {
        if ($ligne_num++ === 0) continue;
        $utilisateurs[] = [
            "id" => $ligne_num - 1,
            "prenom" => $ligne[0],
            "nom" => $ligne[1],
            "role" => $ligne[7]
        ];
    }
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="auteur" content="Adou Humblot, Noam Edwards">
    <meta name="description" content="Site d'agence de voyage vers les pays scandinaves">
    <meta name="keywords" content="voyage, Scandinavie, agence">
    <link rel="stylesheet" href="Admin.css">
    <script src="admin.js" defer></script>
</head>

<body>
    <div class="content">
        <div class="admin-container">
            <h1 class="h1-admin">Gestion des Utilisateurs</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $user): ?>
                        <tr>
                            <td><?= $user["id"] ?></td>
                            <td><?= $user["prenom"] . " " . strtoupper($user["nom"]) ?></td>
                            <td class="status <?= $user["role"] ?>">
                                <?= ucfirst($user["role"]) ?>
                            </td>
                            <td>
                                <?php if ($user["prenom"] !== $_SESSION["utilisateur"]["prenom"] || $user["nom"] !== $_SESSION["utilisateur"]["nom"]): ?>
                                    <form method="POST">
                                        <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
                                        <input type="hidden" name="action" value="changer_role">
                                        <button type="submit" class="vip">Changer rÃ´le</button>
                                    </form>
                                <?php else: ?>
                                    <span>Moi (admin)</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <a href="accueil.php">
            <button class="bouton-retour">Retour Accueil</button>
        </a>
    </footer>

    <div class="div_image"></div>
</body>

</html>