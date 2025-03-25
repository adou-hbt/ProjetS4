<?php
$transaction = $_GET["transaction"] ?? '';
$montant = $_GET["montant"] ?? '';
$vendeur = $_GET["vendeur"] ?? '';
$status = $_GET["status"] ?? '';
$control_recu = $_GET["control"] ?? '';

$cles_api = ["MI-2_A" => "a1b2c3d4e5f6g7h"]; // Clé simulée
$api_key = $cles_api[$vendeur] ?? null;

if (!$api_key) {
  $securite_ok = false;
  $erreur = "Vendeur inconnu.";
} else {
  $control_attendu = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $status . "#");
  $securite_ok = ($control_recu === $control_attendu);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Accueil</title>
  <meta charset="utf-8">
  <meta name="auteur" content="Adou Humblot, Noam Edwards">
  <meta name="description" content="Site d'agence de voyage vers les pays scandinaves">
  <meta name="keywords" content="voyage, Scandinavie, agence">
  <link rel="stylesheet" href="retour_paiement.css">
</head>
</head>

<body>
  <div class="box">
    <?php if (isset($erreur)): ?>
      <h1 class="error">Erreur ❌</h1>
      <p><?= $erreur ?></p>
    <?php elseif (!$securite_ok): ?>
      <h1 class="error">Erreur de sécurité ⚠️</h1>
      <p>Les données reçues ne sont pas valides. Paiement annulé.</p>
    <?php elseif ($status === "accepted"): ?>
      <h1 class="accepted">Paiement accepté ✅</h1>
      <p>Merci ! Votre paiement de <strong><?= number_format($montant, 2, ',', ' ') ?> €</strong> a bien été validé.</p>
    <?php else: ?>
      <h1 class="refused">Paiement refusé ❌</h1>
      <p>Votre paiement n’a pas été accepté.</p>
    <?php endif; ?>
    <div class="secure">
      Contrôle de sécurité : <?= $securite_ok ? "valide ✅" : "non valide ❌" ?>
    </div>
  </div>
</body>

</html>