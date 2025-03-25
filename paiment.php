<?php
require_once("getapikey.php"); 


$fichier_csv = "reservations.csv";
$handle = fopen($fichier_csv, "r");

if (!$handle) {
  die("Impossible d'ouvrir le fichier CSV.");
}


$header = fgetcsv($handle, 0, ";");


$lastLine = [];
while (($data = fgetcsv($handle, 0, ";")) !== false) {
  if (count(array_filter($data)) > 0) {
    $lastLine = $data;
  }
}
fclose($handle);


if (count($lastLine) < 11) {
  die("Ligne de réservation invalide.");
}


$montant = $lastLine[10] ?? '0.00';


$ville = $lastLine[0] ?? '';
$date = $lastLine[2] ?? '';


$transaction = uniqid("TX");
$vendeur = "MI-2_A";
$retour = "http://localhost/retour_paiement.php?session=xyz123";


$api_key = getAPIKey($vendeur);

if (!$api_key || $api_key === "zzzz") {
  die("Clé API invalide ou non reconnue.");
}


$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Validation du Paiement</title>
  <link rel="stylesheet" href="css/paiement.css">
</head>

<body>
  <div class="container">
    <h1>Prêt à payer ?</h1>
    <p>Vous avez réservé un voyage à <strong><?= htmlspecialchars($ville) ?></strong> à partir du <strong><?= htmlspecialchars($date) ?></strong>.</p>
    <p>Montant total à régler : <strong><?= number_format((float)$montant, 2, ',', ' ') ?> €</strong></p>

    <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
      <input type="hidden" name="transaction" value="<?= $transaction ?>">
      <input type="hidden" name="montant" value="<?= $montant ?>">
      <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
      <input type="hidden" name="retour" value="<?= $retour ?>">
      <input type="hidden" name="control" value="<?= $control ?>">
      <button type="submit" class="pay-btn">Procéder au paiement sécurisé</button>
    </form>

    <a href="accueil.php" class="btn-retour">Retour à l'accueil</a>
  </div>
</body>

</html>