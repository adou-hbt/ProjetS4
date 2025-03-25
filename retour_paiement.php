<?php
require_once("getapikey.php");

$transaction = $_GET['transaction'] ?? '';
$montant = $_GET['montant'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$retour = $_GET['retour'] ?? '';
$control = $_GET['control'] ?? '';


if (!$transaction || !$montant || !$vendeur || !$retour || !$control) {
    die("Paramètres manquants dans le retour.");
}


$api_key = getAPIKey($vendeur);
if ($api_key === "zzzz") {
    die("Clé API inconnue pour le vendeur.");
}


$expected_control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");

$paiement_reussi = ($control === $expected_control);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Confirmation de paiement</title>
    <link rel="stylesheet" href="css/paiement.css">
</head>

<body>
    <div class="container">
        <?php if ($paiement_reussi): ?>
            <h1>Paiement validé ✅</h1>
            <p>Merci ! Votre paiement de <strong><?= htmlspecialchars($montant) ?> €</strong> a bien été reçu pour la transaction <strong><?= htmlspecialchars($transaction) ?></strong>.</p>
            <a href="accueil.php" class="btn-retour">Retour à l'accueil</a>
        <?php else: ?>
            <h1>Erreur de paiement ❌</h1>
            <p>Le contrôle du paiement a échoué. Veuillez contacter le support ou réessayer.</p>
            <a href="paiment.php" class="btn-retour">Retour au paiement</a>
        <?php endif; ?>
    </div>
</body>

</html>