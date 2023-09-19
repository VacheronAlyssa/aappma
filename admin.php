<?php
session_start();

// Vérifiez si l'administrateur est authentifié
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php"); // Redirigez vers la page de connexion si l'administrateur n'est pas authentifié
    exit;
}

// Vous pouvez maintenant afficher les actualités et permettre à l'administrateur de les modifier
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Administration</title>
</head>
<body>
    <h1>Page d'Administration</h1>
    
    <!-- Affichez les actualités et ajoutez des formulaires pour les modifier -->
    
    <a href="deconnexion.php">Se Déconnecter</a>
</body>
</html>
