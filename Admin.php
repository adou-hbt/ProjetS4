<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="auteur" content="Adou Humblot, Noam Edwards">
    <meta name="description" content="Site d'agence de voyage vers les pays scandinaves">
    <meta name="keywords" content="voyage, Scandinavie, agence">
    <link rel="stylesheet" href="Admin.css">
</head>
<body>
<div class="content">
<div class="admin-container">
    <h1 class ="h1-admin">Gestion des Utilisateurs</h1>
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
        <tr>
            <td>1</td>
            <td>Hafsa Farid</td>
            <td class="status user">Utilisateur</td>
            <td>
                <button class="vip">VIP</button>
                <button class="ban">Bannir</button>
                <button class="delete">Supprimer</button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Capucine Peligrino</td>
            <td class="status vip">VIP</td>
            <td>
                <button class="normal">Utilisateur</button>
                <button class="ban">Bannir</button>
                <button class="delete">Supprimer</button>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Nassim Izza</td>
            <td class="status banni">Banni</td>
            <td>
                <button class="normal">Utilisateur</button>
                <button class="vip">VIP</button>
                <button class="delete">Supprimer</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</div>
<footer>
    <a href="accueil.php">
        <button class="bouton-retour">Retour Accueil</button>   </a>
</footer>
<div class="div_image"></div>

</body>
</html>
