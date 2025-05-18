
<?php
session_start();
file_put_contents("debug_session.txt", "LOGIN en session : " . ($_SESSION['login'] ?? 'non défini') . "\n", FILE_APPEND);
header('Content-Type: application/json');

if (!isset($_SESSION['login'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté']);
    exit;
}

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

$login = $_SESSION['login'];
$csvFile = 'utilisateurs.csv'; // adapte ce chemin si besoin
$tempFile = 'utilisateurs_temp.csv';

if (!file_exists($csvFile)) {
    echo json_encode(['success' => false, 'message' => 'Fichier utilisateur introuvable']);
    exit;
}

$updated = false;
$input = fopen($csvFile, 'r');
$output = fopen($tempFile, 'w');

while (($ligne = fgetcsv($input, 1000, ';')) !== false) {
    // Supposons que login est en position 0, puis nom, prenom, email, genre ...
    if (trim($ligne[2]) === trim($login)) {
        $ligne[1] = $data['nom'] ?? $ligne[1];
        $ligne[2] = $data['prenom'] ?? $ligne[2];
        $ligne[3] = $data['email'] ?? $ligne[3];
        $ligne[4] = $data['genre'] ?? $ligne[4];

        $_SESSION['login'] = $ligne[2];
        $updated = true;
    }
    fputcsv($output, $ligne, ';');
}

fclose($input);
fclose($output);

if ($updated) {
    rename($tempFile, $csvFile);
    echo json_encode(['success' => true]);
} else {
    unlink($tempFile);
    echo json_encode(['success' => false, 'message' => 'Utilisateur non trouvé dans le fichier CSV']);
}

?>
