<?php
$host = "localhost"; // Adresse du serveur PostgreSQL
$port = "5432"; // Port du serveur PostgreSQL
$dbname = "aappma"; // Nom de la base de données
$username = "admin"; // Nom d'utilisateur de la base de données
$password = "admin"; // Mot de passe de la base de données

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Vous pouvez également définir d'autres options PDO ici si nécessaire
} catch (PDOException $e) {
    // En cas d'échec de la connexion, affichez une erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
